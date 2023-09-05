<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Notifications\TestMail;
use App\Jobs\updateHargaJualJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;

class SettingsController extends Controller
{
    public function index()
    {
        $env = $this->getDataEnv();
        $dataEnv = [];
        foreach ($env as $key => $value) {
            $dataEnv[$key] = str_replace(['"', '\\'], '', $value);
        }

        $data = Settings::findOrFail(1);

        $mergedData = (object) array_merge($data->toArray(), $dataEnv);

        return view('admin.settings.index', [
            'title' => 'Settings',
            'subtitle' => 'Web Settings',
            'data' => $mergedData,
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'app_slogan' => ['required', 'string', 'max:255'],
            'app_url' => ['required', 'string', 'max:255'],
            'footer_text' => ['required', 'string', 'max:255'],
            'app_detail' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048', 'mimes:png,jpg,jpeg,gif,svg,webp,bmp'],
            'favicon' => ['nullable', 'max:2048', 'mimes:ico'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'max:50', 'email'],
            'office_address' => ['nullable', 'string', 'max:255'],
        ]);

        $data = Settings::findOrFail($id);
        $data->app_name = $request->app_name;
        $data->app_slogan = $request->app_slogan;
        $data->app_url = $request->app_url;
        $data->footer_text = $request->footer_text;
        $data->app_detail = $request->app_detail;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->office_address = $request->office_address;

        if ($request->hasFile('logo')) {
            $data->deleteLogo();
            $data->updateLogo($request->file('logo'), 'logo');
        }

        if ($request->hasFile('favicon')) {
            $data->deleteFavicon();
            $data->updateFavicon($request->file('favicon'), '/');
        }

        $this->updateEnv($request);
        $data->update();

        return redirect()->back()->with('success', 'Settings has been updated!');
    }

    public function hargaJual($id, Request $request)
    {
        $request->validate([
            'markup_harga' => ['required', 'numeric', 'min:0'],
        ]);

        dispatch(new updateHargaJualJob($request->markup_harga));

        return response()->json([
            'message' => 'Berhasil mengupdate markup harga jual, harga produk akan tersikron dengan harga terbaru.',
        ]);
    }

    public function emailSetting(Request $request)
    {
        $request->validate([
            'MAIL_HOST' => ['required', 'string', 'max:255'],
            'MAIL_PORT' => ['required', 'string', 'max:255'],
            'MAIL_USERNAME' => ['required', 'string', 'max:255'],
            'MAIL_PASSWORD' => ['required', 'string', 'max:255'],
            'MAIL_ENCRYPTION' => ['required', 'string', 'max:255'],
            'MAIL_FROM_ADDRESS' => ['required', 'string', 'max:255'],
            'MAIL_FROM_NAME' => ['required', 'string', 'max:255'],
        ]);


        $this->updateEnv($request);
        Artisan::call('config:clear');

        return redirect()->back()->with('success', 'Email settings has been updated!');
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'GOOGLE_CLIENT_ID' => ['required', 'string', 'max:255'],
            'GOOGLE_CLIENT_SECRET' => ['required', 'string', 'max:255'],
        ]);

        $this->updateEnv($request);
        Artisan::call('config:clear');

        return redirect()->back()->with('success', 'Social login settings has been updated!');
    }

    public function googleLogin($id)
    {
        $data = Settings::findOrFail($id);
        $data->google_login = $data->google_login == 1 ? 0 : 1;
        $data->update();

        return response()->json([
            'message' => 'Berhasil mengupdate status google login.',
        ]);
    }

    public function updateEnv($request)
    {
        $envFile = base_path('.env');
        $envData = File::get($envFile);

        foreach ($request->except('_token') as $key => $value) {
            $key = strtoupper($key);
            if (strpos($envData, $key . '=') !== false) {
                $envData = preg_replace('/^' . $key . '=.*/m', $key . '=' . $this->quoteValue($value), $envData);
            }
        }

        File::put($envFile, $envData);
        Artisan::call('config:clear');
    }

    public function getDataEnv()
    {
        $envFile = base_path('.env');
        $envData = File::get($envFile);

        $envData = explode("\n", $envData);
        $envData = array_filter($envData, function ($line) {
            return strpos(trim($line), '#') !== 0 && strpos(trim($line), '=') !== false;
        });

        $env = [];
        foreach ($envData as $line) {
            list($key, $value) = explode('=', $line, 2);
            $env[$key] = $this->quoteValue($value);
        }

        return $env;
    }

    protected function quoteValue($value)
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return '"' . addcslashes($value, '"') . '"';
    }

    public function testMail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'max:255', 'email'],
        ]);

        $email = $request->input('email');

        Notification::route('mail', $email) // Use \Notification instead of notify()
            ->notify(new TestMail());

        return response()->json([
            'message' => 'Email test has been sent!',
        ]);
    }
}
