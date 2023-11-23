<?php

namespace Tools;

class Config
{
    protected int $year;
    protected string $dataDir;

    public function __construct(array $config)
    {
        $this->year = $config['year'] ?? (int)(new \DateTime('now'))->format('Y');
        $this->dataDir = $config['data_dir'] ?? 'data';
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getDataDir(): string
    {
        return $this->dataDir;
    }

}