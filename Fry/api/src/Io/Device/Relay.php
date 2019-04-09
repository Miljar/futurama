<?php declare(strict_types=1);

namespace Fry\Io\Device;

use Fry\Io\GPIO\Command;
use PiPHP\GPIO\Pin\OutputPinInterface;

/**
 * Class: Relay
 *
 * @final
 */
final class Relay
{
    /**
     * @var OutputPinInterface
     */
    private $pin;

    public function __construct(OutputPinInterface $pin)
    {
        $this->pin = $pin;
    }

    public function send(Command $command) : void
    {
        ($command)($this->pin);
    }
}
