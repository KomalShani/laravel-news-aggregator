<?php

namespace App\Services;

use App\Contracts\NewsSourceInterface;
use Illuminate\Support\Facades\Http;


class NewsApiService implements NewsSourceInterface
{
    public function fetch(array $params = []): array
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'apiKey' => config('services.newsapi.key'),
            'category' => $params['category'] ?? null,
        ]);

        return $response->json()['articles'] ?? [];
    }
}