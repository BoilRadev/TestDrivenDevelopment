<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
	public function store(StoreRequest $request): void
	{
		Book::create($this->getRequestData($request));
	}

	public function update(UpdateRequest $request): void
	{
		$book = Book::whereId($request->id);

		$book->update($this->getRequestData($request));
	}

	public function getRequestData($request): array
	{
		return[
			'title' => $request->title,
			'author' => $request->author
			];
	}
}
