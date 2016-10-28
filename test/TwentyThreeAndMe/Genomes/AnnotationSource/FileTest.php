<?php
namespace TwentyThreeAndMe\Genomes\AnnotationSource;

use Test\TwentyThreeAndMe\Test\BaseTest;
use TwentyThreeAndMe\Genomes\Annotation;
use TwentyThreeAndMe\Types\Chromosome;

class FileTest extends BaseTest
{
    public function annotationDataProvider()
    {
        return [
            [new Annotation(0, 'rs41362547', new Chromosome('7'), 10044)],
            [new Annotation(1, 'rs28358280', new Chromosome('Y'), 10550)],
            [new Annotation(3, 'rs2853493', new Chromosome('X'), 11467)],
            [new Annotation(7, 'rs28359175', new Chromosome('14'), 13263)],
            [new Annotation(8, 'rs41358152', new Chromosome('8'), 13780)],
            [new Annotation(15, 'rs41337244', new Chromosome('MT'), 15758)],
        ];
    }

    /**
     * @dataProvider annotationDataProvider
     */
    public function testAnnotationsInTestFile(Annotation $expectedAnnotation)
    {
        $found = false;
        $annotationSource = $this->givenThereIsAnAnnotationSource();
        foreach ($annotationSource->all() as $annotation) {
            if ($annotation == $expectedAnnotation) {
                $found = true;
            }
        }

        $this->assertTrue($found, sprintf('Expected annotation for %s not found in index file', $expectedAnnotation->getName()));
    }

    public function invalidAnnotationSNPs()
    {
        return [
            ['i28357682'],
            ['rs28357369'],
            ['rs2853506'],
        ];
    }

    /**
     * @dataProvider invalidAnnotationSNPs
     */
    public function testInvalidAnnotationsAreIgnored($snpName)
    {
        $annotationSource = $this->givenThereIsAnAnnotationSource();
        foreach ($annotationSource->all() as $annotation) {
            /** @var Annotation $annotation */
            if ($annotation->getName() == $snpName) {
                $this->fail($snpName . ' is invalid and should be ignored');
            }
        }
    }
}
