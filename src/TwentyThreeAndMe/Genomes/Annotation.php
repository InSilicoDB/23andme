<?php
namespace TwentyThreeAndMe\Genomes;

class Annotation
{
    private $sampleStringIndex;
    private $name;
    private $chromosome;
    private $position;

    public function __construct($sampleLocation, $name, $chromosome, $position)
    {
        if (empty($chromosome)) {
            throw new AnnotationException('The chromosome should not be 0 or empty');
        }

        if (empty($position)) {
            throw new AnnotationException('The position should not be 0 or empty');
        }

        $this->sampleStringIndex = $sampleLocation * 2;
        $this->name = $name;
        $this->chromosome = $chromosome;
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getChromosome()
    {
        return $this->chromosome;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $sample
     * @return bool|string
     */
    public function genotypeFromSample($sample)
    {
        $genotypeValue = substr($sample, $this->sampleStringIndex, 2);
        if (in_array(strtolower($this->getChromosome()), ['mt', 'y'])) {
            $genotypeValue = substr($genotypeValue, 0, 1);
        }

        if (!empty($genotypeValue) && $genotypeValue != '__') {
            return $genotypeValue;
        }

        return false;
    }
}