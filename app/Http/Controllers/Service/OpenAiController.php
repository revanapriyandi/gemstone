<?php

namespace App\Http\Controllers\Service;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Controllers\Controller;

class OpenAiController extends Controller
{
    public function completions(Request $request)
    {
        $prompt = $request->prompt;
        $metaType = $request->type_data;

        $data = null;
        switch ($metaType) {
            case 'meta':
                $data = $this->generateMeta($prompt);
                break;
            default:
                $data = null;
                break;
        }

        return response()->json([
            'message' => 'Success',
            'status' => 'success',
            'data' => $data,
        ]);
    }


    private function generateMeta($brandName)
    {
        $appName = config('app.name');
        // $prompt = "Buatkan meta title, meta keywords, dan meta description untuk web $appName dengan nama produk $brandName.  pastikan menyebutkan nama produk. Judul meta, kata kunci meta, dan deskripsi meta harus sesuai untuk web top up game dan pulsa dengan nama $appName. kirimkan dalam format: meta title, meta keywords, meta description. dan pastikan meta title, meta keywords, dan meta description untuk web top up game dan pulsa dengan nama $appName sudah sesuai. dan memiliki $brandName di dalamnya. pastikan menyebutkan nama produk $brandName di meta title, meta keywords, dan meta description.";

        $prompt = "buat meta title, meta keywords, dan meta description untuk $brandName yang berfokus pada layanan top up game dan pulsa dengan merek $brandName. Pastikan untuk mencantumkan nama produk tersebut. kirimkan dalam format berikut: meta title, meta keywords, dan meta description. Harap pastikan bahwa meta title, meta keywords, dan meta description untuk situs top up game dan pulsa $appName telah disesuaikan dan mencakup merek $brandName. Jangan lupa untuk menyebutkan nama produk $brandName dalam meta title, meta keywords, dan meta description.";

        $generatedData = $this->openAi($prompt);
        return $this->parseGeneratedData($generatedData);
    }

    private function parseGeneratedData($generatedData)
    {
        $parsedData = [];

        $lines = explode("\n", $generatedData);
        foreach ($lines as $line) {
            $parts = explode(": ", $line);
            if (count($parts) === 2) {
                $key = Str::slug(strtolower(trim($parts[0])), '_');
                $value = trim($parts[1]);
                $parsedData[$key] = $value;
            }
        }

        return $parsedData;
    }

    private function openAi($prompt)
    {
        try {
            $completion = OpenAI::completions()->create([
                'model' => config('openai.model'),
                'prompt' => $prompt,
                'temperature' => 0.7,
                'max_tokens' => 1064,
            ]);

            $generatedContent = trim($completion->choices[0]->text);

            return $generatedContent;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
