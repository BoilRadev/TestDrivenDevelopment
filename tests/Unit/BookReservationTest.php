<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function a_book_can_be_checked_out(): void
    {
		$book = Book::factory()->create();
		$user = User::factory()->create();

		$book->checkout($user);

		$this->assertCount(1, Reservation::all());
		$this->assertEquals($user->id, Reservation::first()->user_id);
		$this->assertEquals($book->id, Reservation::first()->book_id);
		$this->assertEquals(now(), Reservation::first()->checked_out_at);
    }

	/** @test */
	public function a_book_can_be_returned(): void
	{
		$book = Book::factory()->create();
		$user = User::factory()->create();

		$book->checkout($user);

		$book->return($user);

		$this->assertCount(1, Reservation::all());
		$this->assertEquals($user->id, Reservation::first()->user_id);
		$this->assertEquals($book->id, Reservation::first()->book_id);
		$this->assertNotNull(Reservation::first()->return_at);
		$this->assertEquals(now(), Reservation::first()->return_at);
	}

	/** @test */
	public function a_book_can_be_check_out_twice(): void
	{
		$book = Book::factory()->create();
		$user = User::factory()->create();

		$book->checkout($user);
		$book->return($user);
		$book->checkout($user);

		$this->assertCount(2, Reservation::all());
		$this->assertEquals($user->id, Reservation::find(2)->user_id);
		$this->assertEquals($book->id, Reservation::find(2)->book_id);
		$this->assertNotNull(Reservation::find(2)->checked_out_at);
		$this->assertNull(Reservation::find(2)->return_at);
		$this->assertEquals(now(), Reservation::find(2)->checked_out_at);

		$book->return($user);

		$this->assertCount(2, Reservation::all());
		$this->assertEquals($user->id, Reservation::find(2)->user_id);
		$this->assertEquals($book->id, Reservation::find(2)->book_id);
		$this->assertNotNull(Reservation::find(2)->return_at);
		$this->assertEquals(now(), Reservation::find(2)->return_at);
	}

	/** @test */
	public function a_book_can_be_return_without_check_out(): void
	{
		$this->expectException(\Exception::class);
		$book = Book::factory()->create();
		$user = User::factory()->create();

		$book->return($user);
	}
}
