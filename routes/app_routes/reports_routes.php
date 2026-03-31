<?php

require_once __DIR__ . "/../../app/Dtos/Responses/ReportResponse.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Dtos\Responses\ReportResponse;
use App\Models\Report;
use App\Enums\RoutesDefaultNames;

Route::post("/reports/".RoutesDefaultNames::POST_ROUTE->value, function(Request $req) {
	$report = new Report();

	$report->user_id = $req->input("uid");
	$report->contents = $req->input("content", "");
	$report->save();

	$resp = new ReportResponse($report->user_id, $report->contents);

	return response()->json(array("status" => 201, "data" => $resp->getResponse()));
});
