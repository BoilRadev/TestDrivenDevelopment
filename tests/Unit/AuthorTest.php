<?php

namespace Tests\Unit;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorTest extends TestCase
{
	use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_birth_date_is_nullable(): void
    {
		Author::firstOrCreate(['name' => 'John Doe']);

		$this->assertCount(1, Author::all());
    }
}
