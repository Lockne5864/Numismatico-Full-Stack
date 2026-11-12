<?php

namespace App\Helpers;

use App\Models\User;

class Helper
{
	public static function isDitador(String $name): bool
	{
		return strtolower($name) === 'ditador';
	}
}
