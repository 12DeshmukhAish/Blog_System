<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $post = Post::factory()->create();
        
        $this->assertInstanceOf(User::class, $post->user);
    }

    /** @test */
    public function it_has_many_comments()
    {
        $post = Post::factory()->create();
        Comment::factory()->count(3)->create([
            'post_id' => $post->id
        ]);

        $this->assertCount(3, $post->comments);
        $this->assertInstanceOf(Comment::class, $post->comments->first());
    }
}