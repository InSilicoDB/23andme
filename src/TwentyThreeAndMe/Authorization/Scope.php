<?php

namespace TwentyThreeAndMe\Authorization;

/**
 * Collection of valid scopes for easier configuration.
 */
class Scope
{
    const GENOMES           = 'genomes';
    const BASIC             = 'basic';
    const NAMES             = 'names';
    const EMAIL             = 'email';
    const HAPLOGROUPS       = 'haplogroups';
    const ANCESTRY          = 'ancestry';
    const FAMILY_TREE       = 'family_tree';
    const RELATIVES         = 'relatives';
    const RELATIVES_WRITE   = 'relatives:write';
    const ANALYSES          = 'analyses';
    const PROFILE_READ      = 'profile:read';
    const PROFILE_WRITE     = 'profile:write';
    const PUBLISH           = 'publish';

    public static function rsXX($id)
    {
        return 'rs'.$id;
    }

    public static function iXX($id)
    {
        return 'i'.$id;
    }

    public static function readPhenotype($phenotype)
    {
        return 'phenotypes:read:'.$phenotype;
    }

    public static function writePhenotype($phenotype)
    {
        return 'phenotypes:write:'.$phenotype;
    }
}