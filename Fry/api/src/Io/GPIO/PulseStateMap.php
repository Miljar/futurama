<?php declare(strict_types=1);

namespace Fry\Io\GPIO;

use Fry\Io\StateMap;
use InvalidArgumentException;

/**
 * Class: PulseStateMap
 *
 * @see StateMap
 * @final
 */
final class PulseStateMap implements StateMap
{
    /**
     * @var array
     */
    private $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $key) : bool
    {
        return array_key_exists($key, $this->map);
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key)
    {
        if (! $this->has($key)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Could not find key "%1$s" in the map',
                    $key
                )
            );
        }

        return $this->map[$key];
    }
}
