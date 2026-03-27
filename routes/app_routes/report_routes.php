<?php

namespace Routes\AppRoutes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Report;
use App\Enums\RoutesDefaultNames;

Route::get("/reports/".RoutesDefaultNames::GET_ALL_ROUTE->value, function(Request $req) {
    return response()->json(array(
        "status" => 200,
        "data" => Report::all()
    ));
});

Route::post("/reports/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$report = new Report();

	$report->user_id = $req->input("uid");
	$report->contents = $req->input("content");

	$report->save();

	return response()->json(array(
			"status" => 201,
			"data" => array("content" => $report->contents)
		)
	);
});