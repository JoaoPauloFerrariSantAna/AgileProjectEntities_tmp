<?php

require_once __DIR__ . "/../../app/Dtos/Responses/UserResponse.php";
require_once __DIR__ . "/../../app/Utils/utils.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Dtos\Responses\UserResponse;
use App\Enums\RoutesDefaultNames;
use App\Enums\UserRoles;
use App\Models\User;
use App\Utils\prepareBadResponse;
use App\Utils\prepareOkResponse;

Route::get("/users/".RoutesDefaultNames::GET_ALL->value, function () {
	return prepareOkResponse(200, User::all());
});

Route::get("/users/".RoutesDefaultNames::GET_BY_ID->value."/{id}", function(int $id) {
	$user = User::find($id);

	if($user == null)
	{
		return prepareBadResponse(404);
	}

	return $user;
});

Route::delete("/users/".RoutesDefaultNames::DELETE->value."/{id}", function(int $id) {
	$user = User::find($id);

	if($user == null)
	{
		return prepareBadResponse(404);
	}

	$user->delete();

	$resp = new UserResponse($user->name,$user->password,$user->email,$user->role);

	return prepareOkResponse(200, $resp->getResponse());
});

Route::post("/users/".RoutesDefaultNames::POST->value, function(Request $req) {
	$user = new User();

	$user->name = $req->input("uname");
	$user->password = $req->input("passwd");
	$user->email = $req->input("email");
	$user->role = $req->input("role", UserRoles::ADM->value);

	if(User::where("name", '=', $user->name)->first())
	{
		return prepareBadResponse(400);
	}

	$user->save();

	$resp = new UserResponse($user->name,$user->password,$user->email,$user->role);

	return prepareOkResponse(201, $resp->getResponse());
});
