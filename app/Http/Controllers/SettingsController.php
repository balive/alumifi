<?php

namespace App\Http\Controllers;

use App\Events\FeedEngineEvent;
use App\Integrations\WeaviateAPI;
use App\Models\File;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;

class SettingsController extends Controller
{
    public function index()
    {
        return view('dashboard.settings');
    }

    public function store(Request $request)
    {
        $request->validate( ['file'=> 'required']);

        if(request()->hasFile('file')) {
            $file        = $request->file('file');
            $fileType    = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file);
            $fileName    = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move(public_path('uploads/') , $fileName);

            event(new FeedEngineEvent($fileName));

            return response()->json([
                'message' => "$fileName uploaded successfully!",
            ]);
        }
    }


    public function getTxtContent()
    {
        $file  = public_path('feed.txt'); // Replace with the actual path to your proxy file

        $textContent = file_get_contents($file);

        return $textContent;
    }

    public function convertPdfToText()
    {
        $pdfPath = public_path('/feed.pdf');

        $content = Pdf::getText($pdfPath, env('PDFTOTEXT_PATH') );

        return $content;

    }

    public function chunkContent($content)
    {
        $tokensPerCharacter = 0.4;
        $tokenLimit = 500;
        $chunkCharacterLimit = $tokenLimit / $tokensPerCharacter;

        // Split the input string into an array of sentences
        $sentences = collect(preg_split('/(?<=[.?!])\s?(?=[a-z])/i', $content));

        $chunks = $sentences->chunkWhile(function ($sentence, $key, $chunk) use ($chunkCharacterLimit) {
            return $chunk->sum(function ($sentence) {
                    return mb_strlen($sentence, 'UTF-8');
                }) < $chunkCharacterLimit;
        })->map(function ($chunk) {
            $value = $chunk->implode(' ');
            $checksum = md5($value);

            return [
                'chunk_id' => $checksum,
                'value' => $value,
            ];
        });

        return $chunks->all();
    }

}
