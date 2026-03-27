<?php

namespace Routes\AppRoutes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Enums\RoutesDefaultNames;

Route::get("/products/".RoutesDefaultNames::GET_ALL_ROUTE->value, function(Request $req) {
    return response()->json(array(
        "status" => 200,
        "data" => Product::all()
    ));
});

Route::post("/products/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$product = new Product();

	$product->name = $req->input("name");
	$product->stock = $req->input("stock", 5);
	$product->price = $req->input("price");

	$product->save();

	return response()->json(array(
		"status" => 201,
		"data" => array(
			"name" => $product->name,
			"stock" => $product->stock,
			"price" => $product->price
		)
	));
});