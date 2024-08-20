<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function an_author_can_be_created(): void
	{
		$this->withoutExceptionHandling();
		$data = [
			'name' => 'Boil Radev',
			'birth_date' => '05/15/1999',
		];

		$response = $this->post('/author', $data);

		$author = Author::all();
		$response->assertOk();
		$this->assertCount(1, $author);
		$this->assertInstanceOf(Carbon::class, $author->first()->birth_date);
		$this->assertEquals('1999/15/05', $author->first()->birth_date->format('Y/d/m'));
	}
}
