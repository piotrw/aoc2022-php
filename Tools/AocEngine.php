<?php

namespace Tools;

use Exception;
use Tools\Cli\DayCreate;
use Tools\Enum\MessageEnum;
use Tools\Interface\TaskInterface;

class AocEngine
{
    protected Input $input;
    protected Output $output;
    protected Config $config;

    /**
     * @throws Exception
     */
    public function __construct(array $input, array $config)
    {
        $this->config = new Config($config);
        $this->input = (new Input($input))->injectConfig($this->config);
        $this->output = new Output();
        $this->init();
    }

    /**
     * @throws Exception
     */
    protected function init(): void
    {
        $this->output->title(sprintf(MessageEnum::INTRO, $this->config->getYear(), $this->input->getDay() ?: '??'));

        if (!$this->input->isHelp() && is_null($this->input->getDay())) {
            throw new Exception('Day is not defined!');
        }

        // Dispatch task
        switch (true) {
            case $this->input->isCreate():
                $controller = DayCreate::class;
                break;
            default:
                $controller = sprintf("\Days\Day%s\Task", $this->input->getDay());
        }

        if (class_exists($controller)) {
            /** @var TaskInterface $current */
            $current = new $controller($this->input, $this->output, $this->config);
            $result = $current->execute();
            exit($result);
        }

        throw new Exception(sprintf('Day %s is not implemented', $this->input->getDay()));
    }
}