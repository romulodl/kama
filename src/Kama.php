<?php

namespace Romulodl;

class Kama
{
	/**
	 * Calculate the KAMA based on this formula from everget tradingview indicator
	 * https://www.tradingview.com/script/WMySm5L4-Kaufman-Adaptive-Moving-Average/
	 */
	public function calculate(
		array $values,
		int $period = 14,
		int $fastEma = 2,
		int $slowEma = 30
	) : array
	{
		if (empty($values) || count($values) < $period) {
			throw new \Exception('[' . __METHOD__ . '] $values parameters is empty');
		}

		$fastAlpha = 2 / ($fastEma + 1);
		$slowAlpha = 2 / ($slowEma + 1);
		$kama = 0;
		$return = $change = [];
		foreach ($values as $key => $value) {
			if ($key === 0) {
				continue;
			}

			if ( !is_numeric($value)) {
				throw new \Exception('[' . __METHOD__ . '] invalid value: '. $value);
			}

			$change[] = abs($value - $values[$key - 1]);

			if (!isset($values[$key - $period])) {
				continue;
			}

			$mom   = abs($value - $values[$key - $period]);
			$vol   = array_sum(array_slice($change, -1 * $period));
			$er    = $vol !== 0 ? $mom / $vol : 0;
			$alpha = pow($er * ($fastAlpha - $slowAlpha) + $slowAlpha, 2);
			$kama  = $alpha * $value + (1 - $alpha) * $kama;

			$return[] = $kama;
		}

		return array_reverse($return);
	}
}
