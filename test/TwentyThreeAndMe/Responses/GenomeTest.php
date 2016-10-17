<?php
namespace TwentyThreeAndMe\Responses;

use Test\TwentyThreeAndMe\Test\BaseTest;
use TwentyThreeAndMe\Genomes\Annotation;

class GenomeTest extends BaseTest
{
    public function annotationResultDataProvider()
    {
        return [
            [new Annotation(0, 'rs41362547', '7', 10044), 'AC'],
            [new Annotation(1, 'rs28358280', 'Y', 10550), 'T'],
            [new Annotation(3, 'rs2853493', 'X', 11467), 'AG'],
            [new Annotation(7, 'rs28359175', '14', 13263), 'DD'],
            [new Annotation(8, 'rs41358152', '8', 13780), 'AA'],
            [new Annotation(15, 'rs41337244', 'MT', 15758), false],
        ];
    }

    /**
     * @dataProvider annotationResultDataProvider
     */
    public function testAnnotation(Annotation $annotation, $expectedGenotype)
    {
        $genome = $this->givenThereIsAGenome();
        $calculatedGenotype = $genome->annotateGenotype($annotation);
        $this->assertSame($expectedGenotype, $calculatedGenotype);
    }
}