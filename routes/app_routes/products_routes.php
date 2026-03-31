<?php

require_once __DIR__ . "/../../app/Dtos/Responses/ProductResponse.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Dtos\Responses\ProductResponse;
use App\Models\Product;
use App\Enums\RoutesDefaultNames;

Route::post("/products/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$product = new Product();

	$product->name = $req->input("name");
	$product->stock = $req->input("stock", 5);
	$product->price = $req->input("price");
	$product->save();

	$resp = new ProductResponse($product->name, $product->price, $product->stock);

	return response()->json(array("status" => 201, "data" => $resp->getResponse()));
});


