<?php

require_once __DIR__ . "/../../app/Dtos/Responses/UserResponse.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Dtos\Responses\UserResponse;
use App\Enums\RoutesDefaultNames;
use App\Enums\UserRoles;
use App\Models\User;

Route::post("/users/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$user = new User();

	$user->name = $req->input("uname");
	$user->password = $req->input("passwd");
	$user->email = $req->input("email");
	$user->role = $req->input("role", UserRoles::ADM->value);
	$user->save();

	$resp = new UserResponse($user->name,$user->password,$user->email,$user->role);

	return response()->json(array("status" => 201, "data" => $resp->getResponse()));
});
