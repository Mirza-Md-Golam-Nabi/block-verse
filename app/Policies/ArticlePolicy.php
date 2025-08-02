<?php
namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Article $article): bool
    {
        return $article->is_published || $user->id === $article->user_id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('author');
    }

    public function update(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->hasRole('admin');
    }

    public function publish(User $user, Article $article)
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }
}
