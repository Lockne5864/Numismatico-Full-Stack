<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $table = "collections";
	protected $fillable = [
		'name',
		'observation',
		'url_img',
	];

	// If you have relations defined in your database, you can also define them here.
	// For example, if 'money' belongs to a 'user', you might have something like this:
  public function moneys()
	{
		return $this->belongsTo(Money::class);
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
