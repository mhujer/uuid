<?php

declare(strict_types = 1);

use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

$uuids = [];
for ($i = 0; $i < 200000; $i++) {
	$uuids[] = Uuid::uuid4()->toString();
}

file_put_contents(
	__DIR__ . '/dataset.php',
	'<?php return ' . var_export($uuids, true) . ';'
);
