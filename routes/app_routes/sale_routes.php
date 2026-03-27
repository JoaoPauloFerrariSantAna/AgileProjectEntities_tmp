<?php

namespace Routes\AppRoutes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Sale;
use App\Enums\RoutesDefaultNames;

Route::get("/sales/".RoutesDefaultNames::GET_ALL_ROUTE->value, function(Request $req) {
    return response()->json(array(
        "status" => 200,
        "data" => Sale::all()
    ));
});

Route::post("/sales/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$sale = new Sale();

	$sale->user_id = $req->input("uid");
	$sale->product_id = $req->input("pid");
	$sale->quantity_sold = $req->input("solds");

	$sale->save();

	return response()->json(array(
		"status" => 201,
		"data" => array("pid" => $sale->product_id, "solds" => $sale->quantity_sold)
	));
});