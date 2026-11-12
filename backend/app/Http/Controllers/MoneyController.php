<?php

namespace App\Http\Controllers;

use App\Models\Money;
use App\Http\Requests\StoreMoneyRequest;
use App\Http\Requests\UpdateMoneyRequest;
use App\Models\marketplace;
use Inertia\Inertia;

class MoneyController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$user	= auth()->user();
		$money = Money::all();
		return Inertia::render('Money', [
			'moneys' => $money,
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
	public function store(StoreMoneyRequest $request)
	{
		// Crie uma instância do modelo Money e preencha os campos diretamente a partir do pedido.
		$money = Money::create([
			'name' => $request->input('name'),
			'year' => $request->input('year'),
			'country' => $request->input('country'),
			'condition' => $request->input('condition'),
			'price' => $request->input('price'),
			'observation' => $request->input('observation'),
			'type' => $request->input('type'),
			'material' => $request->input('material'),
			'available_sell' => isset($request->available_sell) ? 1 : 0,
			'user_id' => auth()->user()->id,
			'url_img' => $request->input('url_img'),
		]);

		// Verifique se o campo 'available_sell' está definido como verdadeiro.
		if ($money->available_sell === 1) {
			$money->marketplace()->create();
		}

		// Retorne uma resposta adequada, como um redirecionamento ou uma resposta JSON.
		// Por exemplo:
		return redirect()->route('banknotes')->with('success', 'Money saved successfully');
	}

	/*
	 * Display the specified resource.
	 */
	public function show(Money $money)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Money $money)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateMoneyRequest $request, Money $money)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Money $money)
	{
		//
	}
}
