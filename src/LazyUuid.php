<?php

declare(strict_types = 1);

namespace Ramsey\Uuid;

use Ramsey\Uuid\Converter\NumberConverterInterface;
use Ramsey\Uuid\Exception\UnsupportedOperationException;

class LazyUuid implements UuidInterface
{

	/** @var string */
	private $uuidString;

	/** @var Uuid */
    private $uuid;

    /**
	 * @param string $uuidString
	 */
	public function __construct($uuidString)
	{
		$this->uuidString = $uuidString;
	}

	/**
	 * Converts this UUID into a string representation.
	 *
	 * @return string
	 */
	public function toString()
	{
		return $this->uuidString;
	}

	private function ensureInternalUuidExists()
    {
        if ($this->uuid === null) {
            $this->uuid = Uuid::fromString($this->uuidString);
        }
    }

	/**
	 * String representation of object
	 * @link http://php.net/manual/en/serializable.serialize.php
	 * @return string the string representation of the object or null
	 * @since 5.1.0
	 */
	public function serialize()
	{
        return $this->toString();
	}

    public function jsonSerialize()
    {
        return $this->toString();
    }

    /**
	 * Constructs the object
	 * @link http://php.net/manual/en/serializable.unserialize.php
	 * @param string $serialized <p>
	 * The string representation of the object.
	 * </p>
	 * @return void
	 * @since 5.1.0
	 */
	public function unserialize($serialized)
	{
	    $this->ensureInternalUuidExists();
	    $this->uuid->unserialize($serialized);
	}

	/**
	 * Compares this UUID to the specified UUID.
	 *
	 * The first of two UUIDs is greater than the second if the most
	 * significant field in which the UUIDs differ is greater for the first
	 * UUID.
	 *
	 * * Q. What's the value of being able to sort UUIDs?
	 * * A. Use them as keys in a B-Tree or similar mapping.
	 *
	 * @param UuidInterface $other UUID to which this UUID is compared
	 * @return int -1, 0 or 1 as this UUID is less than, equal to, or greater than `$uuid`
	 */
	public function compareTo(UuidInterface $other)
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->compareTo($other);
	}

	/**
	 * Compares this object to the specified object.
	 *
	 * The result is true if and only if the argument is not null, is a UUID
	 * object, has the same variant, and contains the same value, bit for bit,
	 * as this UUID.
	 *
	 * @param object $other
	 * @return bool True if `$other` is equal to this UUID
	 */
	public function equals($other)
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->equals($other);
	}

	/**
	 * Returns the UUID as a 16-byte string (containing the six integer fields
	 * in big-endian byte order).
	 *
	 * @return string
	 */
	public function getBytes()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getBytes();
	}

	/**
	 * Returns the number converter to use for converting hex values to/from integers.
	 *
	 * @return NumberConverterInterface
	 */
	public function getNumberConverter()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getNumberConverter();
	}

	/**
	 * Returns the hexadecimal value of the UUID.
	 *
	 * @return string
	 */
	public function getHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getHex();
	}

	/**
	 * Returns an array of the fields of this UUID, with keys named according
	 * to the RFC 4122 names for the fields.
	 *
	 * * **time_low**: The low field of the timestamp, an unsigned 32-bit integer
	 * * **time_mid**: The middle field of the timestamp, an unsigned 16-bit integer
	 * * **time_hi_and_version**: The high field of the timestamp multiplexed with
	 *   the version number, an unsigned 16-bit integer
	 * * **clock_seq_hi_and_reserved**: The high field of the clock sequence
	 *   multiplexed with the variant, an unsigned 8-bit integer
	 * * **clock_seq_low**: The low field of the clock sequence, an unsigned
	 *   8-bit integer
	 * * **node**: The spatially unique node identifier, an unsigned 48-bit
	 *   integer
	 *
	 * @return array The UUID fields represented as hexadecimal values
	 */
	public function getFieldsHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getFieldsHex();
	}

	/**
	 * Returns the high field of the clock sequence multiplexed with the variant
	 * (bits 65-72 of the UUID).
	 *
	 * @return string Hexadecimal value of clock_seq_hi_and_reserved
	 */
	public function getClockSeqHiAndReservedHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getClockSeqHiAndReservedHex();
	}

	/**
	 * Returns the low field of the clock sequence (bits 73-80 of the UUID).
	 *
	 * @return string Hexadecimal value of clock_seq_low
	 */
	public function getClockSeqLowHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getClockSeqLowHex();
	}

	/**
	 * Returns the clock sequence value associated with this UUID.
	 *
	 * @return string Hexadecimal value of clock sequence
	 */
	public function getClockSequenceHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getClockSequenceHex();
	}

	/**
	 * Returns a PHP `DateTime` object representing the timestamp associated
	 * with this UUID.
	 *
	 * The timestamp value is only meaningful in a time-based UUID, which
	 * has version type 1. If this UUID is not a time-based UUID then
	 * this method throws `UnsupportedOperationException`.
	 *
	 * @return \DateTime A PHP DateTime representation of the date
	 * @throws UnsupportedOperationException If this UUID is not a version 1 UUID
	 */
	public function getDateTime()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getDateTime();
	}

	/**
	 * Returns the integer value of the UUID, converted to an appropriate number
	 * representation.
	 *
	 * @return mixed Converted representation of the unsigned 128-bit integer value
	 */
	public function getInteger()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getInteger();
	}

	/**
	 * Returns the least significant 64 bits of this UUID's 128 bit value.
	 *
	 * @return string Hexadecimal value of least significant bits
	 */
	public function getLeastSignificantBitsHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getLeastSignificantBitsHex();
	}

	/**
	 * Returns the most significant 64 bits of this UUID's 128 bit value.
	 *
	 * @return string Hexadecimal value of most significant bits
	 */
	public function getMostSignificantBitsHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getMostSignificantBitsHex();
	}

	/**
	 * Returns the node value associated with this UUID
	 *
	 * For UUID version 1, the node field consists of an IEEE 802 MAC
	 * address, usually the host address. For systems with multiple IEEE
	 * 802 addresses, any available one can be used. The lowest addressed
	 * octet (octet number 10) contains the global/local bit and the
	 * unicast/multicast bit, and is the first octet of the address
	 * transmitted on an 802.3 LAN.
	 *
	 * For systems with no IEEE address, a randomly or pseudo-randomly
	 * generated value may be used; see RFC 4122, Section 4.5. The
	 * multicast bit must be set in such addresses, in order that they
	 * will never conflict with addresses obtained from network cards.
	 *
	 * For UUID version 3 or 5, the node field is a 48-bit value constructed
	 * from a name as described in RFC 4122, Section 4.3.
	 *
	 * For UUID version 4, the node field is a randomly or pseudo-randomly
	 * generated 48-bit value as described in RFC 4122, Section 4.4.
	 *
	 * @return string Hexadecimal value of node
	 * @link http://tools.ietf.org/html/rfc4122#section-4.1.6
	 */
	public function getNodeHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getNodeHex();
	}

	/**
	 * Returns the high field of the timestamp multiplexed with the version
	 * number (bits 49-64 of the UUID).
	 *
	 * @return string Hexadecimal value of time_hi_and_version
	 */
	public function getTimeHiAndVersionHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getTimeHiAndVersionHex();
	}

	/**
	 * Returns the low field of the timestamp (the first 32 bits of the UUID).
	 *
	 * @return string Hexadecimal value of time_low
	 */
	public function getTimeLowHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getTimeLowHex();
	}

	/**
	 * Returns the middle field of the timestamp (bits 33-48 of the UUID).
	 *
	 * @return string Hexadecimal value of time_mid
	 */
	public function getTimeMidHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getTimeMidHex();
	}

	/**
	 * Returns the timestamp value associated with this UUID.
	 *
	 * The 60 bit timestamp value is constructed from the time_low,
	 * time_mid, and time_hi fields of this UUID. The resulting
	 * timestamp is measured in 100-nanosecond units since midnight,
	 * October 15, 1582 UTC.
	 *
	 * The timestamp value is only meaningful in a time-based UUID, which
	 * has version type 1. If this UUID is not a time-based UUID then
	 * this method throws UnsupportedOperationException.
	 *
	 * @return string Hexadecimal value of the timestamp
	 * @throws UnsupportedOperationException If this UUID is not a version 1 UUID
	 * @link http://tools.ietf.org/html/rfc4122#section-4.1.4
	 */
	public function getTimestampHex()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getTimestampHex();
	}

	/**
	 * Returns the string representation of the UUID as a URN.
	 *
	 * @return string
	 * @link http://en.wikipedia.org/wiki/Uniform_Resource_Name
	 */
	public function getUrn()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getUrn();
	}

	/**
	 * Returns the variant number associated with this UUID.
	 *
	 * The variant number describes the layout of the UUID. The variant
	 * number has the following meaning:
	 *
	 * * 0 - Reserved for NCS backward compatibility
	 * * 2 - The RFC 4122 variant (used by this class)
	 * * 6 - Reserved, Microsoft Corporation backward compatibility
	 * * 7 - Reserved for future definition
	 *
	 * @return int
	 * @link http://tools.ietf.org/html/rfc4122#section-4.1.1
	 */
	public function getVariant()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getVariant();
	}

	/**
	 * Returns the version number associated with this UUID.
	 *
	 * The version number describes how this UUID was generated and has the
	 * following meaning:
	 *
	 * * 1 - Time-based UUID
	 * * 2 - DCE security UUID
	 * * 3 - Name-based UUID hashed with MD5
	 * * 4 - Randomly generated UUID
	 * * 5 - Name-based UUID hashed with SHA-1
	 *
	 * Returns null if this UUID is not an RFC 4122 variant, since version
	 * is only meaningful for this variant.
	 *
	 * @return int|null
	 * @link http://tools.ietf.org/html/rfc4122#section-4.1.3
	 */
	public function getVersion()
	{
        $this->ensureInternalUuidExists();
        return $this->uuid->getVersion();
	}

}
