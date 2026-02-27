<?php

namespace App\Transformers;

class ArticleTransformer
{
    public static function transform(array $article, string $source): array
    {
        return [
            'external_id' => $article['id'] ?? $article['_id'] ?? null,
            'source' => $source,
            'author' => $article['author'] ?? $article['byline'] ?? null,
            'title' => $article['title'] ?? $article['webTitle'] ?? $article['headline']['main'] ?? '',
            'description' => $article['description'] ?? $article['abstract'] ?? null,
            'content' => $article['content'] ?? null,
            'url' => $article['url'] ?? $article['webUrl'] ?? $article['web_url'] ?? '',
            'image_url' => $article['urlToImage'] ?? null,
            'category' => $article['sectionName'] ?? $article['section_name'] ?? null,
            'published_at' => $article['publishedAt'] ?? $article['webPublicationDate'] ?? $article['pub_date'] ?? null,
        ];
    }
}