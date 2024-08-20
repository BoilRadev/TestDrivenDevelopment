<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    public function create(CreateAuthorRequest $request)
	{
		Author::create($this->getRequestData($request));
	}

	private function getRequestData(CreateAuthorRequest $request)
	{
		return[
			'name' => $request->name,
			'birth_date' => $request->birth_date
		];
	}
}
