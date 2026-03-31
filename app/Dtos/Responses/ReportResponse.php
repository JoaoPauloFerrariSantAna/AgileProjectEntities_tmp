<?php

namespace App\Dtos\Responses;

require_once __DIR__ . "/../../Contracts/IBaseResponse.php";

use App\Contracts\IBaseResponse;

class ReportResponse implements IBaseResponse
{
	private int $userId;
	private string $contents;

	public function __construct(int $userId, string $contents)
	{
		$this->userId = $userId;
		$this->contents = $contents;
	}

	public function getResponse(): array
	{
		return array("userId" => $this->userId, "content" => $this->contents);
	}
}
