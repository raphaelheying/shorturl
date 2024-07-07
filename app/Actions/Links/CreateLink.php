<?php

namespace App\Actions\Links;

use App\Models\Link;
use Exception;
use Illuminate\Support\Str;

class CreateLink
{
    public function handle(string $longUrl, int $retries = 10): string
    {
        $link           = new Link();
        $link->long_url = $longUrl;
        $link->user_id  = auth()->user()->id;

        $link->short_url = Str::random(7);

        while (Link::where('short_url', $link->short_url)->exists() && $retries > 0) {
            $link->short_url = Str::random(7);
            $retries--;
        }

        if ($retries === 0) {
            throw new Exception('Failed to generate a unique short_url');
        }

        $link->save();

        return $link->short_url;
    }
}
