<?php

namespace Tests\Unit;

use App\Libs\OmpFirstTask;
use PHPUnit\Framework\TestCase;

class HumanReadableNumberTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testHumanReadableNumber()
    {
        $testCases = [
            ['input' => ['0', null, 'fa'], 'expected' => '۰'],
            ['input' => [0, null, 'fa'], 'expected' => '۰'],
            ['input' => ['123.4400', null, 'fa'], 'expected' => '۱۲۳٫۴۴'],
            ['input' => ['123.4400000000000000000', null, 'fa'], 'expected' => '۱۲۳٫۴۴'],
            ['input' => ['-123.4400000000000000000', null, 'fa'], 'expected' => '-۱۲۳٫۴۴'],
            ['input' => ['100000', null, 'fa'], 'expected' => '۱۰۰٬۰۰۰'],
            ['input' => ['-100000', null, 'fa'], 'expected' => '-۱۰۰٬۰۰۰'],
            ['input' => ['100000.111222333', null, 'fa'], 'expected' => '۱۰۰٬۰۰۰٫۱۱۱۲۲۲۳۳۳'],
            ['input' => ['-100000.111222333', null, 'fa'], 'expected' => '-۱۰۰٬۰۰۰٫۱۱۱۲۲۲۳۳۳'],
            ['input' => ['100000.1', null, 'fa'], 'expected' => '۱۰۰٬۰۰۰٫۱'],
            ['input' => ['-100000.1', null, 'fa'], 'expected' => '-۱۰۰٬۰۰۰٫۱'],
            ['input' => ['0.00001', null, 'fa'], 'expected' => '۰٫۰۰۰۰۱'],
            ['input' => ['-0.00001', null, 'fa'], 'expected' => '-۰٫۰۰۰۰۱'],
            ['input' => ['1.00001', null, 'fa'], 'expected' => '۱٫۰۰۰۰۱'],
            ['input' => ['-1.00001', null, 'fa'], 'expected' => '-۱٫۰۰۰۰۱'],
            ['input' => ['0.0000000000000000000000000000001', null, 'fa'], 'expected' => '۰٫۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۱'],
            ['input' => ['1234.0000000000000000000000000000001', null, 'fa'], 'expected' => '۱٬۲۳۴٫۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۱'],
            ['input' => ['-1234.0000000000000000000000000000001', null, 'fa'], 'expected' => '-۱٬۲۳۴٫۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۱'],

            ['input' => ['123.440', 2, 'fa'], 'expected' => '۱۲۳٫۴۴'],
            ['input' => ['123.490', 1, 'fa'], 'expected' => '۱۲۳٫۵'],
            ['input' => ['123.4400000000000000000', 1, 'fa'], 'expected' => '۱۲۳٫۴'],
            ['input' => ['-123.4400000000000000000', 1, 'fa'], 'expected' => '-۱۲۳٫۴'],
            ['input' => ['100000', 2, 'fa'], 'expected' => '۱۰۰٬۰۰۰'],
            ['input' => ['-100000', 1, 'fa'], 'expected' => '-۱۰۰٬۰۰۰'],
            ['input' => ['100000.111222333', 5, 'fa'], 'expected' => '۱۰۰٬۰۰۰٫۱۱۱۲۲'],
            ['input' => ['-100000.111222333', 0, 'fa'], 'expected' => '-۱۰۰٬۰۰۰'],
            ['input' => ['100000.1', 2, 'fa'], 'expected' => '۱۰۰٬۰۰۰٫۱'],
            ['input' => ['-100000.1', 1, 'fa'], 'expected' => '-۱۰۰٬۰۰۰٫۱'],
            ['input' => ['0.00001', 4, 'fa'], 'expected' => '۰'],
            ['input' => ['-0.00001', 4, 'fa'], 'expected' => '۰'],
            ['input' => ['-0.00001', 5, 'fa'], 'expected' => '-۰٫۰۰۰۰۱'],
            ['input' => ['1.00001', 3, 'fa'], 'expected' => '۱'],
            ['input' => ['-1.00001', 10, 'fa'], 'expected' => '-۱٫۰۰۰۰۱'],
            ['input' => ['0.0000000000000000000000000000001', 31, 'fa'], 'expected' => '۰٫۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۱'],
            ['input' => ['1234.0000000000000000000000000000001', 31, 'fa'], 'expected' => '۱٬۲۳۴٫۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۱'],
//            ['input' => ['-1234.0000000000000000000000000000001', 17, 'fa'], 'expected' => '-۱٬۲۳۴٫۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۰۱'],

            ['input' => ['0', null, 'en'], 'expected' => '0'],
            ['input' => [0, null, 'en'], 'expected' => '0'],
            ['input' => ['123.4400', null, 'en'], 'expected' => '123.44'],
            ['input' => ['123.4400000000000000000', null, 'en'], 'expected' => '123.44'],
            ['input' => ['-123.4400000000000000000', null, 'en'], 'expected' => '-123.44'],
            ['input' => ['100000', null, 'en'], 'expected' => '100,000'],
            ['input' => ['-100000', null, 'en'], 'expected' => '-100,000'],
            ['input' => ['100000.111222333', null, 'en'], 'expected' => '100,000.111222333'],
            ['input' => ['-100000.111222333', null, 'en'], 'expected' => '-100,000.111222333'],
            ['input' => ['100000.1', null, 'en'], 'expected' => '100,000.1'],
            ['input' => ['-100000.1', null, 'en'], 'expected' => '-100,000.1'],
            ['input' => ['0.00001', null, 'en'], 'expected' => '0.00001'],
            ['input' => [0.00001, null, 'en'], 'expected' => '0.00001'],
            ['input' => ['-0.00001', null, 'en'], 'expected' => '-0.00001'],
            ['input' => ['1.00001', null, 'en'], 'expected' => '1.00001'],
            ['input' => ['-1.00001', null, 'en'], 'expected' => '-1.00001'],
            ['input' => ['0.0000000000000000000000000000001', null, 'en'], 'expected' => '0.0000000000000000000000000000001'],
            ['input' => ['1234.0000000000000000000000000000001', null, 'en'], 'expected' => '1,234.0000000000000000000000000000001'],
            ['input' => ['-1234.0000000000000000000000000000001', null, 'en'], 'expected' => '-1,234.0000000000000000000000000000001'],

            ['input' => ['123.4400', 2, 'en'], 'expected' => '123.44'],
            ['input' => ['123.4400000000000000000', 1, 'en'], 'expected' => '123.4'],
            ['input' => ['-123.4400000000000000000', 1, 'en'], 'expected' => '-123.4'],
            ['input' => ['100000', 2, 'en'], 'expected' => '100,000'],
            ['input' => ['-100000', 1, 'en'], 'expected' => '-100,000'],
            ['input' => ['100000.111222333', 5, 'en'], 'expected' => '100,000.11122'],
            ['input' => [100000.111222333, 5, 'en'], 'expected' => '100,000.11122'],
            ['input' => ['-100000.111222333', 0, 'en'], 'expected' => '-100,000'],
            ['input' => ['100000.1', 2, 'en'], 'expected' => '100,000.1'],
            ['input' => ['-100000.1', 1, 'en'], 'expected' => '-100,000.1'],
            ['input' => ['0.00001', 4, 'en'], 'expected' => '0'],
            ['input' => ['-0.00001', 4, 'en'], 'expected' => '0'],
            ['input' => ['-0.00001', 5, 'en'], 'expected' => '-0.00001'],
            ['input' => ['1.00001', 3, 'en'], 'expected' => '1'],
            ['input' => ['-1.00001', 10, 'en'], 'expected' => '-1.00001'],
            ['input' => [-1.00001, 10, 'en'], 'expected' => '-1.00001'],
            ['input' => ['0.0000000000000000000000000000001', 31, 'en'], 'expected' => '0.0000000000000000000000000000001'],
            ['input' => ['1234.0000000000000000000000000000001', 31, 'en'], 'expected' => '1,234.0000000000000000000000000000001'],
//            ['input' => ['-1234.0000000000000000000000000000001', 17, 'en'], 'expected' => '-1,234.0000000000000000000000000000001'],

            ['input' => ['123456.123456789'], 'expected' => '۱۲۳٬۴۵۶٫۱۲۳۴۵۶۷۸۹'],

            ['input' => [1e-15], 'expected' => '۰٫۰۰۰۰۰۰۰۰۰۰۰۰۰۰۱'],
            ['input' => ['1e-15'], 'expected' => '۰٫۰۰۰۰۰۰۰۰۰۰۰۰۰۰۱'],
            ['input' => ['1e-15', 10], 'expected' => '۰'],
            ['input' => ['7.5627e-13', null, 'en'], 'expected' => '0.00000000000075627'],
            ['input' => ['7.5627e-13', null, 'fa'], 'expected' => '۰٫۰۰۰۰۰۰۰۰۰۰۰۰۷۵۶۲۷'],
            ['input' => ['7.5627e-13', 13, 'fa'], 'expected' => '۰٫۰۰۰۰۰۰۰۰۰۰۰۰۸'],
            ['input' => [-7.5627e-13, 13, 'fa'], 'expected' => '-۰٫۰۰۰۰۰۰۰۰۰۰۰۰۸'],

            ['input' => ['1.23E-4', 10, 'en'], 'expected' => '0.000123'],
            ['input' => ['1.23E4', 10, 'en'], 'expected' => '12,300'],
            ['input' => [1.23E4, 10, 'en'], 'expected' => '12,300'],
            ['input' => [1.23E+4, 10, 'en'], 'expected' => '12,300'],
            ['input' => ['-0.000000000099', 32, 'en'], 'expected' => '-0.000000000099'],
            ['input' => ['-0.000000000099', 11, 'en'], 'expected' => '-0.0000000001'],

//            ['input' => [-1.12345001, 13, 'fa'], 'expected' => '۱٫۱۲۳۴۵۰۰۱'],
            ['input' => [1.12345001, 13, 'fa'], 'expected' => '۱٫۱۲۳۴۵۰۰۱'],
        ];

        foreach ($testCases as $testCase) {
            $input = $testCase['input'];
            $expectedResult = $testCase['expected'];

            $ompFirstTask = new OmpFirstTask();
            $result = call_user_func_array([$ompFirstTask, 'humanReadableNumber'], $input);
            $this->assertEquals($expectedResult, $result);
        }
    }
}
