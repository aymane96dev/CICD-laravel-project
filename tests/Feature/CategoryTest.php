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
            'name' => 'Economy',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'Economy']);
    }

    /**
     * Category index feature test
     */
    public function test_category_index()
    {
        $response = $this->get('/api/category');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    /**
     * Category show feature test
     */
    public function test_category_show()
    {
        $response = $this->get('/api/category/1');

        $response->assertStatus(200);
        $response->assertJson(['name' => 'Economy']);
    }

    /**
     * Category update feature test
     */
    public function test_category_update()
    {
        $response = $this->put('/api/category/1', [
            'name' => 'Industry',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'Industry']);
    }

    /**
     * Category delete feature test
     */
    public function test_category_delete()
    {
        $this->post('/api/category', [
            'name' => 'Industry',
        ]);
        $response = $this->delete('/api/category/1');

        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => 1]);
        $this->assertDatabaseMissing('articles', ['category_id' => 1]);
    }
}
