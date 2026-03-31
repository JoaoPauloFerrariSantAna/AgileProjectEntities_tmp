<?php

namespace App\Dtos\Responses;

require_once __DIR__ . "/../../Contracts/IBaseResponse.php";

use App\Contracts\IBaseResponse;

class SalesResponse implements IBaseResponse
{
	private int $productId;
	private int $quantitySold;

	public function __construct(int $productId, int $quantitySold)
	{
		$this->productId = $productId;
		$this->quantitySold = $quantitySold;
	}

	public function getResponse(): array
	{
		return array("pid" => $this->productId, "solds" => $this->quantitySold);
	}
}
