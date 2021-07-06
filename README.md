# Kaufman Adaptative Moving Average

Calculate the KAMA of giving values.

![Jma](https://github.com/romulodl/kama/workflows/Kama/badge.svg)

## Instalation

```
composer require romulodl/kama
```

or add `romulodl/kama` to your `composer.json`. Please check the latest version in releases.

## Usage

```php
$kama = new Romulodl\Kama();
$kama->calculate(
  array $values,
  int $period = 7,
  int $phase = 50,
  float $power = 2
);
```

For example:
```php
$kama = new Romulodl\Kama();
$kama->calculate([10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]);
```

You would normally give a larger period to add smoothness to the result.
