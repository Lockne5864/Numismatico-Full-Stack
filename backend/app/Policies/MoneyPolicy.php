<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Models\Money;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MoneyPolicy
{

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		if (
			Helper::isDitador($user->name)
		) {
			return true;
		}
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Money $money): bool
	{

		if (
			Helper::isDitador($user->name)
		) {
			return true;
		}
		return true;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{

		if (
			Helper::isDitador($user->name)
		) {
			return true;
		}
		return true;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Money $money): bool
	{

		if (
			Helper::isDitador($user->name)
		) {
			return true;
		}
		return $user->id === $money->user_id;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Money $money): bool
	{

		if (
			Helper::isDitador($user->name)
		) {
			return true;
		}
		return  $user->id === $money->user_id;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Money $money): bool
	{

		if (
			Helper::isDitador($user->name)
		) {
			return true;
		}
		return  $user->id === $money->user_id;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Money $money): bool
	{

		if (
			Helper::isDitador($user->name)
		) {
			return true;
		}
		return false;
	}
}
