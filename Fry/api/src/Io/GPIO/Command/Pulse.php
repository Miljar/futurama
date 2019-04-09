<?php declare(strict_types=1);

namespace Fry\Io\GPIO\Command;

use Fry\Io\GPIO\Command;
use Fry\Io\StateMap;
use PiPHP\GPIO\Pin\OutputPinInterface;

/**
 * Class: Pulse
 *
 * Simpulates a single press
 *
 * @see Command
 * @final
 */
final class Pulse implements Command
{
    public const ON = 'on';
    public const OFF = 'off';

    /**
     * @var StateMap
     */
    private $stateMap;

    public function __construct(
        StateMap $stateMap
    ) {
        $this->stateMap = $stateMap;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        OutputPinInterface $gpioPin
    ) : void {
        $gpioPin->setValue(
            $this->stateMap->get(self::ON)
        );

        usleep(250000);

        $gpioPin->setValue(
            $this->stateMap->get(self::OFF)
        );
    }
}
