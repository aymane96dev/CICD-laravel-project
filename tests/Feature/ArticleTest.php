<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{

    /**
     * Article creation feature test
     */
    public function test_article_creation()
    {
        $response = $this->post('/api/article', [
            'title' => 'The new economy model in 2024',
            'body' => 'Has no body',
            'category_id' => 2
                    
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', [
            'title' => 'The new economy model in 2024',
            'body' => 'Has no body',
            'category_id' => 2
                    
        ]);
    }

    /**
     * Article index feature test
     */
    public function test_article_index()
    {
        $response = $this->get('/api/article');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    /**
     * Article show feature test
     */
    public function test_article_show()
    {
        $response = $this->get('/api/article/1');

        $response->assertStatus(200);
        $response->assertJson([
            'title' => 'The new economy model in 2024',
            'body' => 'Has no body',
            'category_id' => 2
        ]);
    }

    /**
     * Article update feature test
     */
    public function test_article_update()
    {
        $response = $this->put('/api/article/1', [
            'title' => 'Kylian Mbappe signed Real Madrid in 2024',
            'body' => 'Has no body',
            'category_id' => 2            
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', [
            'title' => 'Kylian Mbappe signed Real Madrid in 2024',
            'body' => 'Has no body',
            'category_id' => 2           
        ]);
    }

    /**
     * Article delete feature test
     */
    public function test_article_delete()
    {
        $response = $this->delete('/api/article/1');

        $response->assertStatus(200);
        $this->assertDatabaseMissing('articles', ['id' => 1]);
    }
}
