<?php

namespace App\Http\Controllers;

use App\Models\Book;

class CheckoutBookController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store(Book $book): void
	{
		$book->checkout(auth()->user());
	}
}