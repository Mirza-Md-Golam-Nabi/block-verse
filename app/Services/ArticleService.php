<?php
namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Collection;

class ArticleService
{
    public function getAllPublishedArticle(): Collection
    {
        return Article::where('is_published', true)->get();
    }

    public function storeArticle(array $data): Article
    {
        $data['user_id'] = authUser()->id;
        return Article::create($data);
    }

    public function getAllMineArticle()
    {
        return Article::where('user_id', authUser()->id)->get();
    }

    public function updateArticle(Article $article, array $data): bool
    {
        return $article->update($data);
    }

    public function deleteArticle(Article $article): bool
    {
        return $article->delete();
    }

    public function publishedArticle(Article $article): bool
    {
        $article->is_published = true;
        return $article->save();
    }
}
