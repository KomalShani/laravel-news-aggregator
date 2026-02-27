<?php

namespace App\Jobs;

use App\Models\Article;
use App\Services\GuardianService;
use App\Services\NewsApiService;
use App\Services\NytService;
use App\Transformers\ArticleTransformer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchArticlesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $sources = [
            app(NewsApiService::class),
            app(GuardianService::class),
            app(NytService::class),
        ];

        foreach ($sources as $service) {
            $articles = $service->fetch();

            foreach ($articles as $article) {
                $data = ArticleTransformer::transform($article, get_class($service));

                Article::updateOrCreate(
                    ['url' => $data['url']],
                    $data
                );
            }
        }
    }
}
