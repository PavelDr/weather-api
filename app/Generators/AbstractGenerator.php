<?php

namespace App\Generators;

/**
 * Class AbstractGenerator
 * @package App\Generators
 */
abstract class AbstractGenerator
{
    const GENERATOR_FORMAT = '';

    /**
     * Prefix for file name
     * @var string
     */
    protected $fileName = '';

    /**
     * Add time for file name
     * @return string
     */
    public function generateFileName()
    {
        $d = new \DateTime();

        return strtoupper($this->fileName)."_" . $d->format("Y-m-d");
    }

    /**
     * Generate data for save in file
     * @param array $data
     * @return mixed
     */
    abstract public function generateData(array $data);
}