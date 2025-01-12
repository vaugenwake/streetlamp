<?php

declare(strict_types=1);

namespace willitscale\StreetlampTests\Attributes\Validators;

use PHPUnit\Framework\TestCase;
use willitscale\Streetlamp\Attributes\Validators\AlphabeticValidator;

class AlphabeticValidatorTest extends TestCase
{
    /**
     * @param string $input
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateScenarios
     */
    public function testThatValidateCorrectlyValidatesTheInput(
        string $input,
        bool $expectedResult
    ): void {
        $regExpValidator = new AlphabeticValidator();
        $response = $regExpValidator->validate($input);
        $this->assertEquals($expectedResult, $response);
    }

    /**
     * @return array[]
     */
    public function validateScenarios(): array
    {
        return [
            "it should validate that a string only contains alphabetic characters" => [
                "input" => "abc",
                "expectedResult" => true
            ],
            "it should fail to validate when a string does not contain alphabetic characters" => [
                "input" => "abc2",
                "expectedResult" => false
            ]
        ];
    }
}
