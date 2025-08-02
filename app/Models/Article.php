<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'is_published', 'published_at'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
