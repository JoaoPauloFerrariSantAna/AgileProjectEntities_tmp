<?php

namespace App\Dtos\Responses;

require_once __DIR__ . "/../../Contracts/IBaseResponse.php";

use App\Contracts\IBaseResponse;

class ProductResponse implements IBaseResponse
{
	private string $name;
	private float $price;
	private int $stock;

	public function __construct(string $name, int $stock, float $price)
	{
		$this->name = $name;
		$this->stock = $stock;
		$this->price = $price;
	}

	public function getResponse(): array
	{
		return array(
			"name" => $this->name,
			"stock" => $this->stock,
			"price" => $this->price
		);
	}
}

