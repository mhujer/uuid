<?php

declare(strict_types = 1);

use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

$data = require __DIR__ . '/dataset.php';

foreach ($data as $uuidString) {
	$uuid = Uuid::fromString($uuidString);
	if ($uuidString !== $uuid->toString()) {
		die($uuidString . ' vs ' . $uuid->toString());
	}
}
