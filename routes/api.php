<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Report;
use App\Models\Sale;
use App\Models\User;
use App\Enums\RoutesDefaultNames;
use App\Enums\UserRoles;

// TODO: while not making connection (migrations) to the DB
// no GETS nor PATCHES
// TODO: make connection to database using stuff from the prototype
// TODO: add controllers
// TODO: make the crud work (at least)
// TODO: add services
// TODO: add repositories
// TODO: add requests
// TODO: add responses
// TODO: add validators
// TODO: simplify code

Route::post("/users/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$user = new User();

	$user->name = $req->input("uname");
	$user->password = $req->input("passwd");
	$user->email = $req->input("email");
	$user->role = $req->input("role", UserRoles::ADM->value);

	return response()->json(array(
		"status" => 201,
		"data" => array(
			"name" => $user->name,
			"password" => $user->password,
			"email" => $user->email,
			"role" => $user->role
		)
	));
});

Route::post("/products/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$product = new Product();

	$product->name = $req->input("name");
	$product->stock = $req->input("stock", 5);
	$product->price = $req->input("price");

	return response()->json(array(
		"status" => 201,
		"data" => array(
			"name" => $product->name,
			"stock" => $product->stock,
			"price" => $product->price
		)
	));
});

Route::post("/sales/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$sale = new Sale();

	$sale->user_id = $req->input("uid");
	$sale->product_id = $req->input("pid");
	$sale->quantity_sold = $req->input("solds");

	return response()->json(array(
		"status" => 201,
		"data" => array("pid" => $sale->product_id, "solds" => $sale->quantity_sold)
	));
});

Route::post("/reports/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$report = new Report();

	$report->user_id = $req->input("uid");
	$report->contents = $req->input("content");

	return response()->json(array(
			"status" => 201,
			"data" => array("content" => $report->contents)
		)
	);
});
