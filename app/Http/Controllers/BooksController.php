<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
	public function store(StoreBookRequest $request)
	{
		$book = Book::create($this->getRequestData($request));

		return redirect('/books/' . $book->id);
	}

	public function update(UpdateBookRequest $request)
	{
		$book = Book::whereId($request->id);

		$book->update($this->getRequestData($request));

		return redirect('/books/' . $request->id);
	}

	public function delete($id)
	{
		Book::whereId($id)->delete();

		return redirect('/books');
	}

	public function getRequestData($request): array
	{
		return[
			'title' => $request->title,
			'author_id' => $request->author_id
			];
	}
}
