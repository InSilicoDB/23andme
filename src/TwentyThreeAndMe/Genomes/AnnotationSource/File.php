<?php
namespace TwentyThreeAndMe\Genomes\AnnotationSource;

use TwentyThreeAndMe\Genomes\Annotation;
use TwentyThreeAndMe\Genomes\AnnotationException;
use TwentyThreeAndMe\Genomes\AnnotationSource;

class File
    implements AnnotationSource
{
    private $fileLocation;

    public function __construct($fileLocation)
    {
        $this->fileLocation = $fileLocation;
    }

    public function all()
    {
        $fp = fopen($this->fileLocation, 'r');
        while (($indexEntryData = fgets($fp))) {
            if (substr($indexEntryData, 0, 1) == '#') continue;
            list($snpIndex, $snpName, $chromosomeName, $chromosomePosition) = explode("\t", trim($indexEntryData));
            if (!is_numeric($snpIndex)) continue;
            try {
                yield new Annotation($snpIndex, $snpName, $chromosomeName, $chromosomePosition);
            } catch (AnnotationException $e) {
                // we ignore invalid lines
            }
        }
        fclose($fp);
    }
}