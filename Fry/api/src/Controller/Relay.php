<?php declare(strict_types=1);

namespace Fry\Controller;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Http\Server\Router;
use Amp\Http\Status;
use Fry\Io\Device\Relay as RelayDevice;
use Fry\Io\GPIO\Command\Pulse;

/**
 * Class: Relay
 *
 * @final
 */
final class Relay
{
    /**
     * @var array
     */
    private $relays;

    /**
     * @var Pulse
     */
    private $pulse;

    public function __construct(array $relays, Pulse $pulse)
    {
        $this->relays = $relays;
        $this->pulse = $pulse;
    }

    public function __invoke(Request $request) : Response
    {
        $args = $request->getAttribute(Router::class);

        /** @var RelayDevice|null $relay */
        $relay = $this->relays['IN' . (int) $args['number']] ?? null;

        if (null === $relay) {
            return new Response(
                Status::NOT_FOUND,
                [
                    'content-type' => 'text/plain',
                ],
                ''
            );
        }

        $relay->send($this->pulse);

        return new Response(
            Status::OK,
            [
                'content-type' => 'text/plain',
            ],
            ''
        );
    }
}
