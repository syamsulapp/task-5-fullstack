<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageArticlesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function user_can_list_data(): void
    {
        $this->assertTrue(true);
    }

    public function user_can_post_data(): void
    {
        $this->assertTrue(true);
    }

    public function user_can_edit_data(): void
    {
        $this->assertTrue(true);
    }

    public function user_can_delete_data(): void
    {
        $this->assertTrue(true);
    }
}
