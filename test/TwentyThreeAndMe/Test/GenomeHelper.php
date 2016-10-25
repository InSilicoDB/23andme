<?php
namespace Test\TwentyThreeAndMe\Test;

use TwentyThreeAndMe\Genomes\AnnotationSource\File;
use TwentyThreeAndMe\Genomes\GenomeAnnotator;
use TwentyThreeAndMe\Responses\Genome;

trait GenomeHelper
{
    public function givenThereIsAGenome()
    {
        return new Genome([
            'id' => 1,
            'genome' => 'ACTTGTAG__TTGADDAAIICCTTIIIIII'
        ]);
    }

    public function givenThereIsAnAnnotationSource()
    {
        $fileLocation = __DIR__ . '/../../../data/test/annotation-index.txt';
        $annotationSource = new File($fileLocation);

        return $annotationSource;
    }

    public function givenThereIsAnAnnotator()
    {
        $genome = $this->givenThereIsAGenome();
        $annotationSource = $this->givenThereIsAnAnnotationSource();
        $genomeAnnotator = new GenomeAnnotator($genome, $annotationSource);

        return $genomeAnnotator;
    }

    public function whenAnnotationsHaveBeenSavedToFile(GenomeAnnotator $genomeAnnotator)
    {
        $filename = __DIR__ . '/../../../data/tmp/23andme.txt';
        $file = $genomeAnnotator->annotateAndSaveTo($filename);

        return $file;
    }
}