<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tabelao extends Model
{
	use HasFactory;
	protected $table = "tabelao";
	protected $fillable = [
		"money_id",
		"collection_id",
		"user_id",
	];
	public function money()
	{
		return $this->belongsTo(Money::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function collection()
	{
		return $this->belongsTo(Collection::class);
	}

}
