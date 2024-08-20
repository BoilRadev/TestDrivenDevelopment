<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Members
 *
 * @property int $id
 * @property string $title
 * @property string $author

 * @method static \Illuminate\Database\Eloquent\Builder|Members newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Members newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Members query()
 * @method static \Illuminate\Database\Eloquent\Builder|Members whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Members whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Members whereId($value)

 * @mixin \Eloquent
 */
class Book extends Model
{
	protected $fillable = [
		'title',
		'author'
	];

    use HasFactory;
}
