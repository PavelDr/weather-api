<?php

namespace App\Services;

use App\Generators\AbstractGenerator;

/**
 * Class FileSaver
 * @package App\Services
 */
class FileSaver
{
    /**
     * @var string
     */
    private $fileFormat;

    /**
     * Possible generators
     * @var array
     */
    protected $generators;

    /**
     * Respondent constructor.
     * @param array $generators
     */
    public function __construct(
        array $generators
    ) {
        $this->fileFormat = config('services.storage.fileFormat');
        $this->generators = $generators;
    }

    /**
     * Save collection in file
     * @param array $weatherData
     * @return string
     */
    public function saveData(array $weatherData):string
    {
        /** @var AbstractGenerator $generator */
        $generator = $this->generators[$this->fileFormat];

        $data = $generator->generateData($weatherData);

        $fileName = $generator->generateFileName();

        $result = \Storage::put($fileName.'.'.$this->fileFormat, $data);

        return $fileName;
    }
}