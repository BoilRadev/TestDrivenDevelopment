<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuthorRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name' => 'required|string',
			'birth_date' => 'required|date'
		];
	}
}