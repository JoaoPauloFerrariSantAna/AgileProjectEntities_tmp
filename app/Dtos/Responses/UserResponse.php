<?php

namespace App\Dtos\Responses;

require_once __DIR__ . "/../../Contracts/IBaseResponse.php";

use App\Contracts\IBaseResponse;

class UserResponse implements IBaseResponse
{
	private string $name;
	private string $password;
	private string $email;
	private string $role;

	public function __construct(string $name, string $password, string $email, string $role)
	{
		$this->name = $name;
		$this->password = $password;
		$this->email = $email;
		$this->role = $role;
	}

	public function getResponse(): array
	{
		return array(
			"name" => $this->name,
			"password" => $this->password,
			"email" => $this->email,
			"role" => $this->role
		);
	}
}
