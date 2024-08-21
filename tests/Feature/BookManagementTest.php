<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
	{
		$response = $this->post('/books', $this->data());
		$book = Book::first();

		$response->assertFound();
		$this->assertCount(1, Book::all());
		$response->assertRedirect('/books/' . $book->id );;
    }

	/** @test */
	public function a_book_without_title()
	{
		$response = $this->post('/books',  array_merge($this->data(), ['title' => '']));
		$response->assertSessionHasErrors('title');
	}

	/** @test */
	public function a_book_without_author()
	{
		$response = $this->post('/books', array_merge($this->data(), ['author_id' => '']));
		$response->assertSessionHasErrors('author_id');
	}

	/** @test */
	public function a_book_can_be_updated_in_the_library()
	{
		$this->post('/books',  $this->data());

		$book = Book::first();

		$patchData = [
			'id' => $book->id,
			'title' => 'New Book',
			'author_id' => 'New Boil'
		];

		$response = $this->patch('/books/' . $book->id, $patchData);
		$response->assertFound();
		$this->assertEquals('New Book', Book::first()->title);
		$this->assertEquals('New Boil', Book::first()->author_id);
		$this->assertCount(1, Book::all());
		$response->assertRedirect('/books/' . $book->id );;
	}

	/** @test */
	public function a_book_can_be_deleted()
	{
		$this->post('/books', $this->data());

		$book = Book::first();

		$response = $this->delete('/books/' . $book->id);

		$response->assertFound();
		$this->assertCount(0, Book::all());
		$response->assertRedirect('/books');
	}

	/** @test */
	public function a_new_author_is_automatically_added()
	{
		$this->post('/books', $this->data());

		$book = Book::first();
		$author = Author::first();

		$this->assertEquals($author->id, $book->author_id);
		$this->assertCount(1, Author::all());

	}

	private function data(): array
	{
		return [
			'title' => 'Some Book',
			'author_id' => 'Boil'
		];
	}
}
