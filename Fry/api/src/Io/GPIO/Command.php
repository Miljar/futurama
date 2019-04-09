<?php declare(strict_types=1);

namespace Fry\Io\GPIO;

use PiPHP\GPIO\Pin\OutputPinInterface;

interface Command
{
    /**
     * Invokes the command
     */
    public function __invoke(
        OutputPinInterface $gpioPin
    ) : void;
}
