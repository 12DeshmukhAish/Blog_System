<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_comment_on_posts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)
            ->post("/posts/{$post->id}/comments", [
                'content' => 'Test Comment'
            ]);

        $this->assertDatabaseHas('comments', [
            'content' => 'Test Comment',
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $response->assertRedirect();
    }

    /** @test */
    public function unauthenticated_users_cannot_comment()
    {
        $post = Post::factory()->create();

        $response = $this->post("/posts/{$post->id}/comments", [
            'content' => 'Test Comment'
        ]);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_delete_their_own_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($user)
            ->delete("/comments/{$comment->id}");

        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
        $response->assertRedirect();
    }

    /** @test */
    public function users_cannot_delete_others_comments()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $post = Post::factory()->create();
        
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($anotherUser)
            ->delete("/comments/{$comment->id}");

        $response->assertStatus(403);
    }
}


