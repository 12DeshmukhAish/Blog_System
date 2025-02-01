<?php
// app/Services/CacheService.php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Post;
use App\Models\Comment;

class CacheService
{
    const POST_CACHE_KEY = 'posts.';
    const CACHE_DURATION = 3600; // 1 hour

    public function getCachedPost($id)
    {
        return Cache::remember(self::POST_CACHE_KEY . $id, self::CACHE_DURATION, function () use ($id) {
            return Post::with(['user', 'comments.user'])->find($id);
        });
    }

    public function getCachedPosts($page = 1, $perPage = 15)
    {
        $cacheKey = 'posts.page.' . $page;
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($perPage) {
            return Post::with(['user', 'comments' => function($query) {
                $query->latest()->take(5);
            }])
            ->latest()
            ->paginate($perPage);
        });
    }

    public function clearPostCache($id)
    {
        Cache::forget(self::POST_CACHE_KEY . $id);
    }
}