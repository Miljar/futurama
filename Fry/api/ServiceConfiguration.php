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
                'IN2' => $this->relay2(),
                'IN3' => $this->relay3(),
                'IN4' => $this->relay4(),
                'IN5' => $this->relay5(),
                'IN6' => $this->relay6(),
                'IN7' => $this->relay7(),
                'IN8' => $this->relay8(),
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

    /**
     * @Bean({
     *   "parameters"={
     *      @Parameter({"name" = "relay.IN2"})
     *   },
     *   "aliases"={
     *      @Alias({"name" = "IN2"})
     *   }
     * })
     */
    public function relay2(int $pin) : RelayDevice
    {
        return new RelayDevice($this->gpio()->getOutputPin($pin));
    }

    /**
     * @Bean({
     *   "parameters"={
     *      @Parameter({"name" = "relay.IN3"})
     *   },
     *   "aliases"={
     *      @Alias({"name" = "IN3"})
     *   }
     * })
     */
    public function relay3(int $pin) : RelayDevice
    {
        return new RelayDevice($this->gpio()->getOutputPin($pin));
    }

    /**
     * @Bean({
     *   "parameters"={
     *      @Parameter({"name" = "relay.IN4"})
     *   },
     *   "aliases"={
     *      @Alias({"name" = "IN4"})
     *   }
     * })
     */
    public function relay4(int $pin) : RelayDevice
    {
        return new RelayDevice($this->gpio()->getOutputPin($pin));
    }

    /**
     * @Bean({
     *   "parameters"={
     *      @Parameter({"name" = "relay.IN5"})
     *   },
     *   "aliases"={
     *      @Alias({"name" = "IN5"})
     *   }
     * })
     */
    public function relay5(int $pin) : RelayDevice
    {
        return new RelayDevice($this->gpio()->getOutputPin($pin));
    }

    /**
     * @Bean({
     *   "parameters"={
     *      @Parameter({"name" = "relay.IN6"})
     *   },
     *   "aliases"={
     *      @Alias({"name" = "IN6"})
     *   }
     * })
     */
    public function relay6(int $pin) : RelayDevice
    {
        return new RelayDevice($this->gpio()->getOutputPin($pin));
    }

    /**
     * @Bean({
     *   "parameters"={
     *      @Parameter({"name" = "relay.IN7"})
     *   },
     *   "aliases"={
     *      @Alias({"name" = "IN7"})
     *   }
     * })
     */
    public function relay7(int $pin) : RelayDevice
    {
        return new RelayDevice($this->gpio()->getOutputPin($pin));
    }

    /**
     * @Bean({
     *   "parameters"={
     *      @Parameter({"name" = "relay.IN8"})
     *   },
     *   "aliases"={
     *      @Alias({"name" = "IN8"})
     *   }
     * })
     */
    public function relay8(int $pin) : RelayDevice
    {
        return new RelayDevice($this->gpio()->getOutputPin($pin));
    }
}
