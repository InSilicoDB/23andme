<?php
namespace Test\TwentyThreeAndMe\Genomes;

use Test\TwentyThreeAndMe\Test\BaseTest;

class GenomeAnnotatorTest extends BaseTest
{
    public function contentPresentInFileDataProvider()
    {
        return [
            [['rs41362547', '7', 10044, 'AC']],
            [['rs28358280', '11', 10550, 'TA']],
            [['rs2853493', 'X', 11467, 'AG']],
            [['rs28359175', '14', 13263, 'DD']],
            [['rs41358152', '8', 13780, 'AA']],
        ];
    }

    public function contentMissingFromFileDataProvider()
    {
        return [
            ['rs41337244'],
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
}