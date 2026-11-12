<?php

namespace App\Http\Controllers;

use App\Models\marketplace;
use App\Http\Requests\StoremarketplaceRequest;
use App\Http\Requests\UpdatemarketplaceRequest;
use Inertia\Inertia;

class MarketplaceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$user = auth()->user();
		$marketplace = Marketplace::with('money')->get();
		return Inertia::render('Marketplace', [
			'marketplace' => $marketplace,
			'user' => $user

		]);
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoremarketplaceRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(marketplace $marketplace)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(marketplace $marketplace)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatemarketplaceRequest $request, marketplace $marketplace)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(marketplace $marketplace)
	{
		dd($marketplace);
	}
}
