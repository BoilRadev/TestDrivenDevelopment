<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'id' => 'int',
			'title' => 'required|string',
			'author' => 'required|string'
		];
	}
}