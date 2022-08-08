<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

trait IsUser
{
	public function password(): Attribute
	{
		return new Attribute(
			set: fn(?string $value): string => (Hash::needsRehash($value)) ? bcrypt($value) : $value,
		);
	}
}