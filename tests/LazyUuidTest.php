<?php

namespace Ramsey\Uuid\Test;

use Ramsey\Uuid\Codec\LazyStringCodec;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;

class LazyUuidTest extends UuidTest
{

    protected function setUp()
    {
        $uuidFactory = new UuidFactory();
        $uuidFactory->setCodec(new LazyStringCodec($uuidFactory->getUuidBuilder()));
        Uuid::setFactory($uuidFactory);
    }
}
