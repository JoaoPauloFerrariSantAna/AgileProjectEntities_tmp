<?php

namespace App\Enums;

enum UserRoles: string
{
	case ADM = "ADM";
	case GERENTE = "GERENTE";
	case ANALISTA = "ANALISTA";
}
