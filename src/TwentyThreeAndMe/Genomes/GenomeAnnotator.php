<?php
namespace TwentyThreeAndMe\Genomes;

use TwentyThreeAndMe\Responses\Genome;

class GenomeAnnotator
{
    private $genomeResponse;
    private $annotationSource;

    public function __construct(Genome $genomeResponse, AnnotationSource $annotationSource)
    {
        $this->genomeResponse = $genomeResponse;
        $this->annotationSource = $annotationSource;
    }

    public function annotateAndSaveTo($fileLocation)
    {
        $file = new AnnotatedFile($fileLocation);
        foreach ($this->annotationSource->all() as $annotation) {
            $genotype = $this->genomeResponse->annotateGenotype($annotation);
            if ($genotype !== false) {
                $file->append(
                    $annotation->getName(),
                    $annotation->getChromosome(),
                    $annotation->getPosition(),
                    $genotype
                );
            }
        }
        $file->close();

        return $file;
    }
}