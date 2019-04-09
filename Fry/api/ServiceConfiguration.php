<?php declare(strict_types=1);

use Fry\Controller\Relay;
use Fry\Io\Device\Relay as RelayDevice;
use Fry\Io\GPIO\Command\Pulse;
use Fry\Io\GPIO\PulseStateMap;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\InputPinInterface;
use bitExpert\Disco\Annotations\Alias;
use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use bitExpert\Disco\Annotations\Parameter;

/**
 * @Configuration
 */
class ServiceConfiguration
{
    /**
     * @Bean({
     *   "aliases"={
     *      @Alias({"type" = true})
     *   }
     * })
     */
    public function pulseStateMap() : PulseStateMap
    {
        return new PulseStateMap([
            Pulse::ON => InputPinInterface::VALUE_LOW,
            Pulse::OFF => InputPinInterface::VALUE_HIGH,
        ]);
    }

    /**
     * @Bean({
     *   "aliases"={
     *      @Alias({"type" = true})
     *   }
     * })
     */
    public function pulse() : Pulse
    {
        return new Pulse(
            $this->pulseStateMap()
        );
    }

    /**
     * @Bean({
     *   "aliases"={
     *      @Alias({"type" = true})
     *   }
     * })
     */
    public function relayController() : Relay
    {
        return new Relay(
            [
                'IN1' => $this->relay1(),
            ],
            $this->pulse()
        );
    }

    /**
     * @Bean({
     *   "aliases"={
     *      @Alias({"type" = true})
     *   }
     * })
     */
    public function gpio() : GPIO
    {
        return new GPIO();
    }

    /**
     * @Bean({
     *   "parameters"={
     *      @Parameter({"name" = "relay.IN1"})
     *   },
     *   "aliases"={
     *      @Alias({"name" = "IN1"})
     *   }
     * })
     */
    public function relay1(int $pin) : RelayDevice
    {
        return new RelayDevice($this->gpio()->getOutputPin($pin));
    }
}
