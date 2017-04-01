<?php

declare(strict_types = 1);

use Ramsey\Uuid\Codec\LazyStringCodec;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$data = require __DIR__ . '/dataset.php';

$f = Uuid::getFactory();
if ($f instanceof UuidFactory) {
	$f->setCodec(new LazyStringCodec());
}

foreach ($data as $uuidString) {
	$uuid = Uuid::fromString($uuidString);
	if ($uuidString !== $uuid->toString()) {
		die($uuidString . ' vs ' . $uuid->toString());
	}
}
