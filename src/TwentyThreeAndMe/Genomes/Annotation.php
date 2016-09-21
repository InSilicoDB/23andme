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
        if (!empty($genotypeValue)) {
            return $genotypeValue;
        }

        return false;
    }
}