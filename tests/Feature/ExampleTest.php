<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertEquals;

class ExampleTest extends TestCase
{
    public function test_example()
    {
        $this->get('/')
            ->assertSeeText('hei');
    }
}
