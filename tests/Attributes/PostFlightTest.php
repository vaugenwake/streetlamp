<?php declare(strict_types=1);

namespace Attributes;

use willitscale\Streetlamp\Attributes\PostFlight;
use willitscale\Streetlamp\Models\Controller;
use willitscale\Streetlamp\Models\Route;
use PHPUnit\Framework\TestCase;

class PostFlightTest extends TestCase
{
    /**
     * @test
     * @param array $expectedClasses
     * @return void
     * @dataProvider validAnnotations
     */
    public function testProcessRouteAnnotationCorrectlyAndExtractThePostFlightClass(
        array  $expectedClasses
    ): void {
        $route = new Route('Test', 'test');

        foreach($expectedClasses as $expectedClass) {
            $postFlight = new PostFlight($expectedClass);
            $postFlight->applyToRoute($route);
        }

        $postFlights = $route->getPostFlight();

        $this->assertCount(count($expectedClasses), $postFlights);

        for ($i = 0; $i < count($expectedClasses); $i++) {
            $this->assertEquals($expectedClasses[$i], $postFlights[$i]);
        }
    }

    /**
     * @test
     * @param array $expectedClasses
     * @return void
     * @dataProvider validAnnotations
     */
    public function testProcessControllerAnnotationCorrectlyAndExtractThePostFlightClass(
        array  $expectedClasses
    ): void {
        $controller = new Controller('Test', 'test');

        foreach($expectedClasses as $expectedClass) {
            $postFlight = new PostFlight($expectedClass);
            $postFlight->applyToController($controller);
        }

        $postFlights = $controller->getPostFlight();

        $this->assertCount(count($expectedClasses), $postFlights);

        for ($i = 0; $i < count($expectedClasses); $i++) {
            $this->assertEquals($expectedClasses[$i], $postFlights[$i]);
        }
    }

    public function validAnnotations(): array
    {
        return [
            'it should extract the class and namespace from a valid annotation' => [
                'expectedClasses' => [
                    'Test/Test'
                ]
            ],
            'it should extract just the class from a valid annotation' => [
                'expectedClasses' => [
                    'Test'
                ]
            ],
            'it should extract just the class and namepsace with multiple levels from a valid annotation' => [
                'expectedClasses' => [
                    'Level1/Level2/Test'
                ]
            ]
        ];
    }
}