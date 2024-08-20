<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
		$data = [
			'title' => 'Some Book',
			'author' => 'Boil'
		];

		$response = $this->post('/books', $data);
		$response->assertOk();
		$this->assertCount(1, Book::all());
    }

	/** @test */
	public function a_book_without_title()
	{
		$data = [
			'title' => '',
			'author' => 'Boil'
		];

		$response = $this->post('/books', $data);
		$response->assertSessionHasErrors('title');
	}

	/** @test */
	public function a_book_without_author()
	{
		$data = [
			'title' => 'Some Book',
			'author' => ''
		];

		$response = $this->post('/books', $data);
		$response->assertSessionHasErrors('author');
	}

	/** @test */
	public function a_book_can_be_updated_in_the_library()
	{
		$this->withoutExceptionHandling();
		$postData = [
			'title' => 'Old Book',
			'author' => 'Boil'
		];

		$this->post('/books', $postData);

		$book = Book::first();

		$patchData = [
			'id' => $book->id,
			'title' => 'New Book',
			'author' => 'New Boil'
		];

		$response = $this->patch('/books/' . $book->id, $patchData);
		$response->assertOk();
		$this->assertEquals('New Book', Book::first()->title);
		$this->assertEquals('New Boil', Book::first()->author);
		$this->assertCount(1, Book::all());
	}
}
