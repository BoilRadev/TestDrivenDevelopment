<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Members
 *
 * @property int $id
 * @property string $title
 * @property string $author_id

 * @method static Builder|Book newModelQuery()
 * @method static Builder|Book newQuery()
 * @method static Builder|Book query()
 * @method static Builder|Book whereTitle($value)
 * @method static Builder|Book whereAuthorId($value)
 * @method static Builder|Book whereId($value)

 * @mixin \Eloquent
 */
class Book extends Model
{
	protected $guarded = [];

	public function setAuthorIdAttribute($author): void
	{
		$this->attributes['author_id'] = Author::firstOrCreate(['name' => $author])->id;
	}
    use HasFactory;
}
