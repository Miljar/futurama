<?php declare(strict_types=1);

namespace Fry\Io;

use InvalidArgumentException;

interface StateMap
{
    /**
     * Determines if given $key is available
     * in the map
     */
    public function has(string $key) : bool;

    /**
     * Returns the mapped value for given key
     * or throws an exception
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function get(string $key);
}
