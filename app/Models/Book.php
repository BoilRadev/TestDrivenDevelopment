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

	public function checkout(User $user)
	{
		$this->reservations()->create([
			'user_id' => $user->id,
			'checked_out_at' => now()
		]);
	}

	public function return(User $user)
	{
		$reservation = $this->reservations()
			->where('user_id', $user->id)
			->whereNotNull('checked_out_at')
			->whereNull('return_at')
			->first();

		if (is_null($reservation))
		{
			throw new \Exception();
		}
		$reservation->update([
			'return_at' => now()
		]);
	}

	private function reservations()
	{
		return $this->hasMany(Reservation::class);
	}

	use HasFactory;
}
