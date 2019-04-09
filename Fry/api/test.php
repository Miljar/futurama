<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\InputPinInterface;
$gpio = new GPIO();

//$pin = 17;

$pins = array(17, 18, 27, 22, 23, 24, 25, 3);

foreach ($pins as $pin) {
	// Activate
	$gpio->getOutputPin($pin)->setValue(InputPinInterface::VALUE_LOW);
	usleep(250000);

	// Deactivate
	$gpio->getOutputPin($pin)->setValue(InputPinInterface::VALUE_HIGH);
}

