<?php

namespace Tools;

use Exception;

class Input
{
    protected ?string $day = null;
    protected bool $demo = false;
    protected bool $create = false;
    protected bool $help = false;
    protected Config $config;

    public function __construct(
        array $input
    )
    {
        foreach ($input as $item) {
            switch ($item) {
                case 'help' :
                    $this->help = true;
                    break;
                case 'demo' :
                    $this->demo = true;
                    break;
                case 'create' :
                    $this->create = true;
                    break;
                default :
                    if (is_numeric($item)) {
                        $this->day = str_pad(abs($item), 2, '0', STR_PAD_LEFT);
                    }
            }
        }
    }

    public function injectConfig(Config $config): self
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDay(): ?string
    {
        return $this->day;
    }

    /**
     * @return bool
     */
    public function isDemo(): bool
    {
        return $this->demo;
    }

    /**
     * @return bool
     */
    public function isCreate(): bool
    {
        return $this->create;
    }

    /**
     * @return bool
     */
    public function isHelp(): bool
    {
        return $this->help;
    }


    /**
     * @param string|null $filename If empty it will load default input/demo file
     * @return string[]
     * @throws Exception
     */
    public function loadData(?string $filename = null): array
    {
        $dataDir = $this->config->getDataDir() . DIRECTORY_SEPARATOR . 'day' . $this->getDay() . DIRECTORY_SEPARATOR;
        if (is_null($filename)) {
            $filename = $this->isDemo() ? "demo.txt" : "input.txt";
        }

        if (!file_exists($dataDir . $filename)) {
            throw new Exception(sprintf('File %s not exist!', $filename));
        }

        $file = file_get_contents($dataDir . $filename);
        if ($file) {
            return explode("\n", $file);
        }

        throw new Exception(sprintf('Data file "%s" is empty', $dataDir . $filename));
    }

}