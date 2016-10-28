<?php
namespace Test\TwentyThreeAndMe\Genomes;

use Test\TwentyThreeAndMe\Test\BaseTest;

class GenomeAnnotatorTest extends BaseTest
{
    public function contentPresentInFileDataProvider()
    {
        return [
            [['rs41362547', '7', 10044, 'AC']],
            [['rs28358280', 'Y', 10550, 'T']],
            [['rs2853493', 'X', 11467, 'AG']],
            [['rs28359175', '14', 13263, 'DD']],
            [['rs41358152', '8', 13780, 'AA']],
            [['rs3915611', 'MT', 14233, 'I']]
        ];
    }

    public function contentMissingFromFileDataProvider()
    {
        return [
            ['rs41337244'],
            ['rs3088053']
        ];
    }

    /**
     * @dataProvider contentPresentInFileDataProvider
     */
    public function testThatAnnotatedFileContainsData($datarow)
    {
        $genomeAnnotator = $this->givenThereIsAnAnnotator();
        $file = $this->whenAnnotationsHaveBeenSavedToFile($genomeAnnotator);

        $fileContents = file_get_contents($file->getFilename());
        $this->assertNotFalse(
            strpos($fileContents, implode("\t", $datarow)),
            'File does not appear to contain data for SNP '.$datarow[0]
        );
    }

    /**
     * @dataProvider contentMissingFromFileDataProvider
     */
    public function testThatAnnotatedFileIsMissingData($snpName)
    {
        $genomeAnnotator = $this->givenThereIsAnAnnotator();
        $file = $this->whenAnnotationsHaveBeenSavedToFile($genomeAnnotator);

        $fileContents = file_get_contents($file->getFilename());
        $this->assertFalse(
            strpos($fileContents, $snpName),
            'File does appear to contain unexpected data for SNP '.$snpName
        );
    }

    public function testThatAnnotationsAreSortedByChromosome()
    {
        $genomeAnnotator = $this->givenThereIsAnAnnotator();
        $annotationsFile = $this->whenAnnotationsHaveBeenSavedToFile($genomeAnnotator);

        $annotations = file($annotationsFile->getFilename());
        $previousChromosome = null;
        foreach ($annotations as $annotation) {
            if (is_null($previousChromosome)) {
                continue;
            }
            if (   substr($annotation, 0, 1) != '#'
                && strlen(trim($annotation)) !== 0) {
                list($name, $chromosome, $position, $genotype) = explode("\t", $annotation);
                $chromosomes = [$previousChromosome, $chromosome];
                $sortedChromosomes = [$previousChromosome, $chromosome];
                sort($sortedChromosomes, SORT_NUMERIC);
                $this->assertEquals($chromosomes, $sortedChromosomes, 'Data for chromosome received out of order: ' . $chromosome . ' after ' . $previousChromosome);
                //$this->assertLessThanOrEqual(0, strcasecmp($previousChromosome, $chromosome), 'Data for chromosome received out of order: ' . $chromosome . ' after ' . $previousChromosome);
                $previousChromosome = $chromosome;
            }
        }
    }

    public function testThatAnnotationsAreSortedByPosition()
    {
        $genomeAnnotator = $this->givenThereIsAnAnnotator();
        $annotationsFile = $this->whenAnnotationsHaveBeenSavedToFile($genomeAnnotator);

        $annotations = file($annotationsFile->getFilename());
        $previousPosition = 0;
        foreach ($annotations as $annotation) {
            if (   substr($annotation, 0, 1) != '#'
                && strlen(trim($annotation)) !== 0) {
                list($name, $chromosome, $position, $genotype) = explode("\t", $annotation);
                if ($chromosome == 1) {
                    $this->assertGreaterThan($previousPosition, $position, 'Annotation data received with position out-of-order: ' . $position . ' after ' . $previousPosition);
                    $previousPosition = $position;
                }
            }
        }
    }
}