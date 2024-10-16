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
            'title' => 'AI music suno',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                       Mauris maximus suscipit turpis vitae dictum. Cras ac mauris
                       et felis molestie pretium nec rhoncus libero.',
            'category_id' => 5
                    
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', [
            'title' => 'AI music suno',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                       Mauris maximus suscipit turpis vitae dictum. Cras ac mauris
                       et felis molestie pretium nec rhoncus libero.',
            'category_id' => 5
                    
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
            'title' => 'mbappe is a raper',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris maximus suscipit turpis vitae dictum. Cras ac mauris et felis molestie pretium nec rhoncus libero.',
            'category_id' => 1
        ]);
    }

    /**
     * Article update feature test
     */
    public function test_article_update()
    {
        $response = $this->put('/api/article/1', [
            'title' => 'Mbappe signed Real Madrid',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                       Mauris maximus suscipit turpis vitae dictum. Cras ac mauris
                       et felis molestie pretium nec rhoncus libero.',
            'category_id' => 1             
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', [
            'title' => 'Mbappe signed Real Madrid',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                       Mauris maximus suscipit turpis vitae dictum. Cras ac mauris
                       et felis molestie pretium nec rhoncus libero.',
            'category_id' => 1             
        ]);
    }

    /**
     * Article delete feature test
     */
    public function test_article_delete()
    {
        $response = $this->delete('/api/article/7');

        $response->assertStatus(200);
        $this->assertDatabaseMissing('articles', ['id' => 7]);
    }
}
