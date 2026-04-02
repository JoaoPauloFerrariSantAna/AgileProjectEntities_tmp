<?php

require_once __DIR__ . "/../../app/Dtos/Responses/ReportResponse.php";
require_once __DIR__ . "/../../app/Utils/utils.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Dtos\Responses\ReportResponse;
use App\Models\Report;
use App\Enums\RoutesDefaultNames;
use App\Utils\prepareBadResponse;
use App\Utils\prepareOkResponse;

Route::get("/reports/".RoutesDefaultNames::GET_ALL->value, function () {
	return prepareOkResponse(200, Report::all());
});

Route::get("/reports/".RoutesDefaultNames::GET_BY_ID->value."/{id}", function(int $id) {
	$rep = Sale::find($id);

	if($rep == null)
	{
		return prepareBadResponse(404);
	}

	return $rep;
});

Route::delete("/reports/".RoutesDefaultNames::DELETE->value."/{id}", function(int $id) {
	$rep = Report::find($id);

	if($rep == null)
	{
		return prepareBadResponse(404);
	}

	$rep->delete();

	$resp = new ReportResponse($rep->user_id, $rep->contents);

	return prepareOkResponse(200, $resp->getResponse());
});

Route::post("/reports/".RoutesDefaultNames::POST->value, function(Request $req) {
	$rep = new Report();

	$rep->user_id = $req->input("uid");
	$rep->contents = $req->input("content", "");

	if(Report::where("contents", '=', $rep->contents)->first())
	{
		return prepareBadResponse(400);
	}

	$rep->save();

	$resp = new ReportResponse($rep->user_id, $rep->contents);

	return response()->json(array("status" => 201, "data" => $resp->getResponse()));
});
