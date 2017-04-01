<?php

namespace Ramsey\Uuid\Codec;

use Ramsey\Uuid\LazyUuid;
use Ramsey\Uuid\UuidInterface;

/**
 * LazyStringCodec lazily encodes and decodes RFC 4122 UUIDs
 */
class LazyStringCodec extends StringCodec
{

    /**
     * Decodes a string representation of a UUID into a UuidInterface object instance
     *
     * @param string $encodedUuid
     * @return UuidInterface
     */
    public function decode($encodedUuid)
    {
        return new LazyUuid($encodedUuid);
    }

}
