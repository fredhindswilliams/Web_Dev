<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ImageFetcher
{
    /**
     * Fetch a random image and save it to storage.
     * Returns the stored local path.
     */
    public function fetchRandomImage(): string
    {
        $response = Http::get('https://picsum.photos/600/600')->body();

        $filename = 'post_images/' . uniqid() . '.jpg';

        \Storage::disk('public')->put($filename, $response);

        return $filename;
    }
}
