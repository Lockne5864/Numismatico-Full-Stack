<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
	use HasFactory;
protected $table = "money";
	protected $fillable = [
		'name',
		'user_id',
		'year',
		'country',
		'condition',
		'price',
		'observation',
		'type',
		'material', // Added this based on your migration
		'available_sell', // Added this based on your migration
		'url_img',
	];

	// If you have relations defined in your database, you can also define them here.
	// For example, if 'money' belongs to a 'user', you might have something like this:
  public function collections()
	{
		return $this->belongsTo(Collection::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function marketplace()
	{
		return $this->hasMany(Marketplace::class);
	}
}
