<?php

namespace Tools;

use Exception;

class Input
{
    protected ?string $day = null;
    protected bool $demo = false;
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
                default :
                    if (is_numeric($item)) {
                        $this->day = str_pad($item, 2, '0', STR_PAD_LEFT);
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
    public function isHelp(): bool
    {
        return $this->help;
    }

    /**
     * @throws Exception
     */
    public function loadData(?string $filename = null): array
    {
        if (is_null($filename)) {
            $filename = $this->isDemo() ? "demo{$this->getDay()}.txt" : "input{$this->getDay()}.txt";
        }

        if (!file_exists($this->config->getDataDir() . DIRECTORY_SEPARATOR . $filename)) {
            throw new Exception(sprintf('File %s not exist!', $filename));
        }

        $file = file_get_contents($this->config->getDataDir() . DIRECTORY_SEPARATOR . $filename);
        return explode("\n", $file);
    }

}