<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Author extends Model
{
	protected $guarded = [];

	protected $dates = [
		'birth_date'
	];

	public function setBirthDateAttribute($birthDate)
	{
		$this->attributes['birth_date'] = Carbon::parse($birthDate);
	}

//	public function setAuthorAttribute($author)
//	{
//		$this->attributes['author_id'] = Author::firstOrCreate(['name' => $author]);
//	}

    use HasFactory;
}
