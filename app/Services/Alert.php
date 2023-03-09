<?php

namespace App\Services;

class Alert
{
	public function success(string $message, int $duration = 5): void
	{
		$this->build($message, "success", $duration);
	}

	public function info(string $message, int $duration = 5): void
	{
		$this->build($message, "success", $duration);
	}

	public function alert(string $message, int $duration = 5): void
	{
		$this->build($message, "alert", $duration);
	}

	public function warning(string $message, int $duration = 5): void
	{
		$this->build($message, "warning", $duration);
	}

	private function build(string $message, string $type = "info", int $duration = 5): void
	{
		session()->flash("messages", [
			"duration" => $duration * 1000,
			"body" => $message,
			"type" => $type,
		]);
	}
}
