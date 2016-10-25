<?php
namespace TwentyThreeAndMe\Genomes;

interface AnnotationSource
{
    /**
     * @return Annotation[]
     */
    public function all();
}