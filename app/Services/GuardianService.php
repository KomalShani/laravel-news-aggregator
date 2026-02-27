<?php

namespace App\Services;
use App\Contracts\NewsSourceInterface;
use Illuminate\Support\Facades\Http;

class GuardianService implements NewsSourceInterface
{
    public function fetch(array $params = []): array
    {
        $response = Http::get('https://content.guardianapis.com/search', [
            'api-key' => config('services.guardian.key'),
            'show-fields' => 'all',
            'page-size' => 50
        ]);

        return $response->json()['response']['results'] ?? [];
    }
}