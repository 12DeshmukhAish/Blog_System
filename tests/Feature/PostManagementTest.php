<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_post()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)
            ->post('/posts', [
                'title' => 'Test Post',
                'content' => 'Test Content'
            ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'content' => 'Test Content',
            'author_id' => $user->id
        ]);

        $post = Post::first();
        $response->assertRedirect(route('posts.show', $post));
    }

    /** @test */
    public function a_post_requires_a_title_and_content()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/posts', [
                'title' => '',
                'content' => ''
            ]);

        $response->assertSessionHasErrors(['title', 'content']);
    }

    /** @test */
    public function only_the_author_can_update_their_post()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        
        $post = Post::factory()->create([
            'author_id' => $user->id
        ]);

        $response = $this->actingAs($anotherUser)
            ->put("/posts/{$post->id}", [
                'title' => 'Updated Title',
                'content' => 'Updated Content'
            ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_update_any_post()
    {
        $user = User::factory()->create();
        $admin = User::factory()->create(['role' => 'admin']);
        
        $post = Post::factory()->create([
            'author_id' => $user->id
        ]);

        $response = $this->actingAs($admin)
            ->put("/posts/{$post->id}", [
                'title' => 'Updated Title',
                'content' => 'Updated Content'
            ]);

        $response->assertRedirect(route('posts.show', $post));
        $this->assertEquals('Updated Title', $post->fresh()->title);
    }
}