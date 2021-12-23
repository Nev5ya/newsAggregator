<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PagesAvailability extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function index_user_page()
    {
        $response = $this->get('/');

        $response->assertViewIs('news.index');
    }

    public function index_contact_page()
    {
        $response = $this->get('/contact');

        $response->assertViewIs('contact');
    }

    public function news_show_page()
    {
        $response = $this->get('/news/{id}');

        $response->assertViewIs('news.show');
    }
}
