<?php

namespace App\Models\DemoDataGenerator;

abstract class DemoDataGenerator
{
    use DemoDataGeneratorTrait;

    protected array $demoData;

    protected array $authors;

    public function __construct()
    {
        $this->authors = $this->createAuthors();
    }

    /**
     * @return array
     */
    abstract public function getDemoData(): array;
}