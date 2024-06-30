<?php

namespace App\Libs;

use InvalidArgumentException;

class OmpFirstTask
{
    public function humanReadableNumber(string|int|float $number, null|int $decimalPlaces = null, null|string $language = 'fa'): string
    {
        if (!in_array($language, ['fa', 'en'])) {
            throw new InvalidArgumentException('Invalid language. Supported languages: fa, en');
        }

        $number = $this->scientificToDecimal($number);

        $number = $this->setDecimalPlaces($number, $decimalPlaces);

        $number = $this->numberGrouping($number);

        if ('fa' === $language) {
            return $this->persianFormat($number);
        }

        return $number;
    }

    private function scientificToDecimal(string|int|float $number): string
    {
        if (!strpos(strtolower($number), 'e')) {
            return $number;
        }

        $parts = explode('e', strtolower($number));
        $base = $parts[0];
        $exponent = (int)$parts[1];

        if ($exponent > 0) {
            return floatval($number);
        }

        $decimalNumber = $base * pow(10, $exponent);
        $countOfDecimals = ((int)$base != $base) ? (strlen($base) - strpos($base, '.')) - 1 : 0;
        $precision = abs($exponent) + $countOfDecimals;

        return number_format($decimalNumber, $precision, '.', '');
    }

    private function setDecimalPlaces(string|int|float $number, null|int $decimalPlaces): string
    {
        if (null === $decimalPlaces) {
            return str_contains($number, '.') ? rtrim(rtrim($number, '0'), '.') : $number;
        }

        $number = bcpow($number, 1, $decimalPlaces + 1);
        $numberSplit = str_split($number);
        $numberSplitReverse = array_reverse($numberSplit);

        if ($numberSplitReverse[0] >= 5) {
            for ($i = 1; $i < count($numberSplitReverse); $i++) {
                if ($numberSplitReverse[$i] === '.') {
                    continue;
                }

                $numberSplitReverse[$i]++;
                if ($numberSplitReverse[$i] < 10) {
                    break;
                } else {
                    $numberSplitReverse[$i] = 0;
                }
            }
        }

        $numberSplit = array_reverse($numberSplitReverse);
        $number = implode($numberSplit);
        $number = bcpow($number, 1, $decimalPlaces);

        return str_contains($number, '.') ? rtrim(rtrim($number, '0'), '.') : $number;
    }

    private function numberGrouping(string|int|float $number): string
    {
        $decimalPos = strpos($number, '.');

        if ($decimalPos === false) {
            $afterDecimal = 0;
            $beforeDecimal = $number;
        } else {
            $afterDecimal = substr($number, $decimalPos + 1);
            $beforeDecimal = substr($number, 0, $decimalPos);
        }

        $numberGrouping = number_format($beforeDecimal, 0, '.', ',');

        if ($afterDecimal === 0) {
            return $numberGrouping;
        }

        if ($number < 0 && $number > -1) {
            return '-' . $numberGrouping . '.' . $afterDecimal;
        }

        return $numberGrouping . '.' . $afterDecimal;
    }

    private function persianFormat(int|float|string $number): string
    {
        $persianCharacters = [
            0 => '۰',
            1 => '۱',
            2 => '۲',
            3 => '۳',
            4 => '۴',
            5 => '۵',
            6 => '۶',
            7 => '۷',
            8 => '۸',
            9 => '۹',
            '.' => '٫',
            ',' => '٬',
            '-' => '-',
        ];

        $strNumber = str_split($number);

        $persianNumber = '';
        foreach ($strNumber as $digit) {
            $persianNumber .= $persianCharacters[$digit];
        }

        return $persianNumber;
    }
}
