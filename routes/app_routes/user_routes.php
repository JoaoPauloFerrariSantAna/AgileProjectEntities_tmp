<?php

namespace Routes\AppRoutes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Enums\UserRoles;
use App\Enums\RoutesDefaultNames;

Route::get("/users/".RoutesDefaultNames::GET_ALL_ROUTE->value, function(Request $req) {
    return response()->json(array(
        "status" => 200,
        "data" => User::all()
    ));
});

Route::post("/users/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$user = new User();

	$user->name = $req->input("uname");
	$user->password = $req->input("passwd");
	$user->email = $req->input("email");
	$user->role = $req->input("role", UserRoles::ADM->value);

	$user->save();

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