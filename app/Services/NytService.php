<?php

namespace App\Services;

use App\Contracts\NewsSourceInterface;
use Illuminate\Support\Facades\Http;

class NytService implements NewsSourceInterface
{
    public function fetch(array $params = []): array
    {
        $response = Http::get('https://api.nytimes.com/svc/search/v2/articlesearch.json', [
            'api-key' => config('services.nyt.key'),
        ]);

        return $response->json()['response']['docs'] ?? [];
    }
}