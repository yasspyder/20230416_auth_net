<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
  
    public function testIndexNewsPage()
    {
        $response = $this->get('/news/');

        $response->assertStatus(200);
        $response->assertSeeText('Все новости');
    }

    public function testNewsCategoryPage()
    {
        $response = $this->get('/news/category/1');

        $response->assertStatus(200);
        $response->assertSeeText('Культура');
    }

    public function testNewsMessagePage()
    {
        $response = $this->get('/news/category/message/1');

        $response->assertStatus(200);
        $response->assertSeeText('Шарлиз Терон');
    }
}
