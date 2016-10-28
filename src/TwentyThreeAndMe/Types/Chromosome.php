<?php
namespace TwentyThreeAndMe\Types;

use TwentyThreeAndMe\Exception\ValidationException;

class Chromosome
{
    private $name;
    private $invalid = false;

    public function __construct($name)
    {
        switch (strtoupper($name)) {
            case 'X':
            case 'Y':
            case 'XY':
            case 'MT':
                $this->name = strtoupper($name);
                break;
            default:
                if (!is_int($name) && !ctype_digit($name)) {
                    $this->name = $name;
                    $this->invalid = true;
                } else {
                    $this->name = (int) $name;
                }
        }
    }

    private function validate()
    {
        if ($this->invalid) {
            throw new ValidationException('Chromosome must be an integer: ' . $this->name);
        }
    }

    public function asInt()
    {
        $this->validate();
        switch ($this->name) {
            case 'X':
                return 23;
            case 'Y':
                return 24;
            case 'XY':
                return 25;
            case 'MT':
                return 26;
            default:
                return $this->name;
        }
    }

    public function asString()
    {
        $this->validate();
        return $this->name;
    }
}