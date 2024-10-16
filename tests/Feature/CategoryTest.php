<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Category creation feature test
     */
    public function test_category_creation()
    {
        $response = $this->post('/api/category', [
            'name' => 'Cinema',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'Cinema']);
    }

    /**
     * Category index feature test
     */
    public function test_category_index()
    {
        $response = $this->get('/api/category');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /**
     * Category show feature test
     */
    public function test_category_show()
    {
        $response = $this->get('/api/category/5');

        $response->assertStatus(200);
        $response->assertJson(['name' => 'Music and Arts']);
    }

    /**
     * Category update feature test
     */
    public function test_category_update()
    {
        $response = $this->put('/api/category/1', [
            'name' => 'Sport',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'Sport']);
    }

    /**
     * Category delete feature test
     */
    public function test_category_delete()
    {
        $response = $this->delete('/api/category/5');

        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => 5]);
        $this->assertDatabaseMissing('articles', ['category_id' => 5]);
    }
}
