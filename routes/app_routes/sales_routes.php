<?php

require_once __DIR__ . "/../../app/Dtos/Responses/SalesResponse.php";
require_once __DIR__ . "/../../app/Utils/utils.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Sale;
use App\Enums\RoutesDefaultNames;
use App\Dtos\Responses\SalesResponse;
use App\Utils\prepareBadResponse;
use App\Utils\prepareOkResponse;

Route::get("/sales/".RoutesDefaultNames::GET_ALL->value, function () {
	return prepareOkResponse(200, Sale::all());
});

Route::get("/sales/".RoutesDefaultNames::GET_BY_ID->value."/{id}", function(int $id) {
	$sale = Sale::find($id);

	if($sale == null)
	{
		return prepareBadResponse(404);
	}

	return $sale;
});

Route::delete("/sales/".RoutesDefaultNames::DELETE->value."/{id}", function(int $id) {
	$sale = Sale::find($id);

	if($sale == null)
	{
		return prepareBadResponse(404);
	}

	$sale->delete();

	$resp = new SalesResponse($sale->product_id, $sale->quantity_sold);

	return prepareOkResponse(200, $resp->getResponse());
});

Route::post("/sales/".RoutesDefaultNames::POST->value, function(Request $req) {
	$sale = new Sale();

	$sale->user_id = $req->input("uid");
	$sale->product_id = $req->input("pid");
	$sale->quantity_sold = $req->input("solds");

	// TODO: validate

	$sale->save();

	$resp = new SalesResponse($sale->product_id, $sale->quantity_sold);

	return response()->json(array("status" => 201,"data" => $resp->getResponse()));
});
