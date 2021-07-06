<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Romulodl\Kama;

final class JmaTest extends TestCase
{
	public function testCalculateWithMorePreviousValues(): void
	{
		$val = require(__DIR__ . '/values.php');
		$values = [];
		foreach ($val as $v) {
			$values[] = $v[2];
		}

		$kama = new Kama();
		$series = $kama->calculate($values);
		$this->assertSame(9294.15, round($series[0], 2));
	}

	public function testCalculateWithEmptyArray(): void
	{
		$this->expectException(Exception::class);

		$kama = new Kama();
		$kama->calculate([]);
	}

	public function testCalculateWithInvalidArray(): void
	{
		$values = [
			9148.27,
			9995,
			9807.49,
			'hahah',
			8719.53,
			8561.09,
			8808.71,
			9305.91,
			9786.80,
		];

		$this->expectException(Exception::class);

		$kama = new Kama();
		$kama->calculate($values);
	}
}
