<?php

require_once __DIR__ . "/../../app/Dtos/Responses/SalesResponse.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Sale;
use App\Enums\RoutesDefaultNames;
use App\Dtos\Responses\SalesResponse;

Route::post("/sales/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$sale = new Sale();

	$sale->user_id = $req->input("uid");
	$sale->product_id = $req->input("pid");
	$sale->quantity_sold = $req->input("solds");
	$sale->save();

	$resp = new SalesResponse($sale->product_id, $sale->quantity_sold);

	return response()->json(array("status" => 201,"data" => $resp->getResponse()));
});


