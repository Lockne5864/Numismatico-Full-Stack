<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marketplace extends Model
{
	use HasFactory;

	public function money()
	{
		return $this->belongsTo(Money::class);
	}
}
