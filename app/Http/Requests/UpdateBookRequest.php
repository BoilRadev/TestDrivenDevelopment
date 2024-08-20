<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'id' => 'int',
			'title' => 'required|string',
			'author' => 'required|string|exists:author,name'
		];
	}
}