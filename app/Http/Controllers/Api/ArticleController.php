<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\StoreArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(private ArticleService $service)
    {
        $this->articleService = $service;
    }

    public function index()
    {
        return formatResponse(0, 200, 'Articles fetched successfully', $this->articleService->getAllPublishedArticle());
    }

    public function store(StoreArticleRequest $request)
    {
        return formatResponse(0, 200, 'Article stored successfully', $this->articleService->storeArticle($request->validated()));
    }

    public function mine()
    {
        return formatResponse(0, 200, 'Articles fetched successfully', $this->articleService->getAllMineArticle());
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->articleService->updateArticle($article, $request->validated());

        return formatResponse(0, 200, 'Articles updated successfully', $article);
    }

    public function destroy(Article $article)
    {
        $this->articleService->deleteArticle($article);

        return formatResponse(0, 200, 'Articles deleted successfully', null);
    }

    public function publish(Article $article)
    {
        $this->articleService->publishedArticle($article);

        return formatResponse(0, 200, 'Articles published successfully', $article);
    }

}
