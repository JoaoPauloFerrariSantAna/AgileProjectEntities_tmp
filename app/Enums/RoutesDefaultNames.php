<?php

namespace App\Enums;

enum RoutesDefaultNames: string
{
	case POST = "postData";
	case GET_ALL = "getAll";
	case GET_BY_ID = "getById";
	case DELETE = "deleteById";
}
