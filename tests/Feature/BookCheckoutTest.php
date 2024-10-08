<?php

use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCheckoutTest extends TestCase
{
	use RefreshDatabase;

	public function test_if_a_book_can_be_checked_out_by_a_signed_in_user()
	{
		$book = Book::factory()->create();
		$user = User::factory()->create();

		$this->actingAs($user)
			->post('/checkout/' . $book->id);

		$this->assertCount(1, Reservation::all());
		$this->assertEquals($user->id, Reservation::first()->user_id);
		$this->assertEquals($book->id, Reservation::first()->book_id);
		$this->assertEquals(now(), Reservation::first()->checked_out_at);
	}

	public function test_only_signed_in_user_can_checkout_book()
	{
		$this->withoutExceptionHandling();
		$book = Book::factory()->create();

		$this->post('/checkout/' . $book->id)
			->assertRedirect('/login');

		$this->assertCount(0, Reservation::all());
	}
}