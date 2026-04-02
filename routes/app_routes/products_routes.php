<?php

require_once __DIR__ . "/../../app/Dtos/Responses/ProductResponse.php";
require_once __DIR__ . "/../../app/Utils/utils.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Dtos\Responses\ProductResponse;
use App\Models\Product;
use App\Enums\RoutesDefaultNames;
use App\Utils\prepareBadResponse;
use App\Utils\prepareOkResponse;

Route::get("/products/".RoutesDefaultNames::GET_ALL->value, function () {
	return prepareOkResponse(200, User::all());
});

Route::get("/products/".RoutesDefaultNames::GET_BY_ID->value."/{id}", function(int $id) {
	$prod = Product::find($id);

	if($prod == null)
	{
		return prepareBadResponse(404);
	}

	return prepareOkResponse(200, $prod);
});

Route::delete("/products/".RoutesDefaultNames::DELETE->value."/{id}", function(int $id) {
	$prod = Product::find($id);

	if($prod == null)
	{
		return prepareBadResponse(404);
	}

	$prod->delete();

	$resp = new UserResponse($prod->name, $prod->password, $prod->email, $prod->role);

	return prepareOkResponse(200, $resp->getResponse());
});


Route::post("/products/".RoutesDefaultNames::POST->value, function(Request $req) {
	$prod = new Product();

	$prod->name = $req->input("name");
	$prod->stock = $req->input("stock");
	$prod->price = $req->input("price");

	if((Product::where("name", '=', $prod->name) != null) && (Product::where("stock", '=', $prod->stock != null)))
	{
		return prepareBadResponse(400);
	}

	$prod->save();

	$resp = new ProductResponse($prod->name, $prod->price, $prod->stock);

	return prepareOkResponse(201, $resp->getResponse());
});
