<?php

namespace AxeTools\Traits\BitFlag;

use AxeTools\Traits\Tests\BitFlagTraitTest;

/**
 * Use the bitwise operators to set, get and toggle to the state of a given flag in a set of flags.  Using
 * bitwise flags are a method to set true/false states for a set of distinct statuses that are contained in an integer value
 *
 * The trait is to be implemented in an utilizing class.  The trait should include class constants
 * to define the flags that are contained in the flag set.  The flags are integer values, there are
 * a few different ways in php to define these flags depending on your usage.
 *
 * Direct setting of values, this should be set as distinct bit values which are 2^x values
 *
 * <pre>
 * const FLAG_RECEIVED = 1; // BIT #1 of has the value 2^0
 * const FLAG_REVIEWED = 2; // BIT #2 of has the value 2^1
 * const FLAG_PREPARED = 4; // BIT #3 of has the value 2^2
 * const FLAG_QUEUES   = 8; // BIT #4 of has the value 2^3
 * const FLAG_SHIPPED  = 16; // BIT #5 of has the value 2^4
 *
 * </pre>
 *
 * Using the left Shift operator assignment to ensure unique values
 *
 * <pre>
 * const FLAG_RECEIVED = 1 << 0; // BIT #1 of has the value 1 2^0
 * const FLAG_REVIEWED = 1 << 1; // BIT #2 of has the value 2 2^1
 * const FLAG_PREPARED = 1 << 2; // BIT #3 of has the value 4 2^2
 * const FLAG_QUEUES   = 1 << 3; // BIT #4 of has the value 8 2^3
 * const FLAG_SHIPPED  = 1 << 4; // BIT #5 of has the value 16 2^4
 *
 * </pre>
 *
 * Using direct binary representation to explicitly define the bit values that are involved with the constant's
 * definition depending on the use case this may be the most readable version if there are multiple states involved.
 *
 * <pre>
 * const FLAG_RECEIVED = 0b00001;
 * const FLAG_REVIEWED = 0b00010;
 * const FLAG_PREPARED = 0b00100;
 * const FLAG_QUEUES   = 0b01000;
 * const FLAG_SHIPPED  = 0b10000;
 *
 * </pre>
 *
 * @package AxeTools\BitFlagTrait
 * @since 1.0.0
 * @see BitFlagTraitTest
 */
trait BitFlagTrait {

    /**
     * Get the current set status of the flag that is requested from the flagSet
     *
     * @param int $flagSet The current state of the flag set
     * @param int $flag The individual flag to set in the flag set
     *
     * @return bool The set value in the flag set of the flag
     * @since 1.0.0
     */
    protected static function getFlag($flagSet, $flag) {
        return ($flagSet & $flag) === $flag;
    }

    /**
     * Set the flag to the specified value in the flag set
     *
     * @param int  $flagSet The current state of the flag set
     * @param int  $flag The individual flag to set in the flag set
     * @param bool $value The value to update the flag position in the flag set
     *
     * @return void
     * @since 1.0.0
     */
    protected static function setFlag(&$flagSet, $flag, $value) {
        if ($value) {
            $flagSet |= $flag;
        } else {
            $flagSet &= ~$flag;
        }
    }

    /**
     * Toggle the state of the flag in the flag set
     *
     * @param int $flagSet The current state of the flag set
     * @param int $flag The individual flag to set in the flag set
     *
     * @return void
     * @since 1.0.0
     */
    protected static function toggleFlag(&$flagSet, $flag) {
        $flagSet ^= $flag;
    }

}