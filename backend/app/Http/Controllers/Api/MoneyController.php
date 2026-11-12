<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\marketplace;
use App\Models\Money;

class MoneyController extends Controller
{
	public function index()
	{
		// $money = Money::all();
		return response()->json([
			'money' => Money::with(["user:id,name"])->where([
				"available_sell" => 1
			])->get()
		], 200);
	}

	public function show($userId)
	{
        abort_unless((int) $userId === auth()->id(), 403);
		//  return response()->json([
		//   'message' => $request->available_sell ? 1 : 0,
		// ], 200);
		$money = Money::where([
			"user_id" => (int) $userId,
		])->get();
		return response()->json(['money' => $money], 200);
	}

	public function store(Request $request)
	{
        abort_unless((int) $request->input("user_id") === $request->user()->id, 403);
		// Crie uma instância do modelo Money e preencha os campos diretamente a partir do pedido.
		$money = Money::create([
			'name' => $request->input('name'),
			'year' => (int) $request->input('year'),
			'country' => $request->input('country'),
			'condition' => $request->input('condition'),
			'price' => (float) $request->input('price'),
			'observation' => $request->input('observation'),
			'type' => $request->input('type'),
			'material' => $request->input('material'),
			'available_sell' => $request->available_sell ? 1 : 0,
			'user_id' => $request->user()->id,
			'url_img' => $request->input('url_img'),
		]);

		// Verifique se o campo 'available_sell' está definido como verdadeiro.
		if ($money->available_sell) {
			$money->marketplace()->create();
		}
		// Retorne uma resposta adequada, como um redirecionamento ou uma resposta JSON.
		// Por exemplo:
		return response()->json($money, 200);
	}
	public function changeToMarcketplace($cedulaId)
	{
		$id = (int) $cedulaId; 
		$money = Money::findOrFail($id);
        abort_unless($money->user_id === auth()->id(), 403);
		$money->update([
			'available_sell' => $money->available_sell === 0 ? 1 : 0,
		]);
		$money->save();
		

		return response()->json(["status" => "OK"], 200);
	}
}
