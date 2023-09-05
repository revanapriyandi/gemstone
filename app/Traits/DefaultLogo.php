<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait DefaultLogo
{
    public function updateLogo(UploadedFile $logo, $storagePath = 'logo')
    {
        $image = Image::make($logo)->fit(200, 200);
        $fileName = Str::random(40) . '.' . $logo->getClientOriginalExtension();
        $filePath = $storagePath . '/' . $fileName;

        Storage::disk($this->LogoDisk())->put($filePath, $image->encode());

        if ($this->logo) {
            Storage::disk($this->LogoDisk())->delete($this->logo);
        }

        $this->logo = $filePath;
        $this->save();
    }

    public function updateBanner(UploadedFile $banner, $storagePath = 'banner')
    {
        $image = Image::make($banner)->fit(1280, 300);
        $fileName = Str::random(40) . '.' . $banner->getClientOriginalExtension();
        $filePath = $storagePath . '/' . $fileName;

        Storage::disk($this->LogoDisk())->put($filePath, $image->encode());

        if ($this->banner) {
            Storage::disk($this->LogoDisk())->delete($this->banner);
        }

        $this->banner = $filePath;
        $this->save();
    }


    public function updateFavicon(UploadedFile $favicon, $storagePath)
    {
        tap($this->favicon, function ($previous) use ($favicon, $storagePath) {
            $fileName = 'favicon.ico';
            $this->forceFill([
                'favicon' => $favicon->storeAs(
                    $storagePath,
                    $fileName,
                    ['disk' => $this->LogoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->LogoDisk())->delete($previous);
            }
        });
    }


    public function deleteLogo()
    {
        if (is_null($this->logo)) {
            return;
        }

        Storage::disk($this->LogoDisk())->delete($this->logo);

        $this->forceFill([
            'logo' => null,
        ])->save();
    }

    public function deleteFavicon()
    {
        if (is_null($this->favicon)) {
            return;
        }

        Storage::disk($this->LogoDisk())->delete($this->favicon);

        $this->forceFill([
            'favicon' => null,
        ])->save();
    }


    public function LogoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->logo
                ? Storage::disk($this->LogoDisk())->url($this->logo)
                : $this->defaultLogoUrl();
        });
    }

    public function bannerUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->banner
                ? Storage::disk($this->LogoDisk())->url($this->banner)
                : 'https://www.chestnutgrove.org.uk/MainFolder/default-banner/default-banner-mobile.jpg';
        });
    }

    public function faviconUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->favicon
                ? Storage::disk($this->LogoDisk())->url($this->favicon)
                : null;
        });
    }

    protected function defaultLogoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return Storage::disk($this->LogoDisk())->url('logo/default.jpg');
    }

    protected function LogoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
