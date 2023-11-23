<?php

namespace Tools;

use Exception;
use Tools\Enum\MessageEnum;
use Tools\Interface\TaskInterface;

abstract class AbstractTask implements TaskInterface
{
    public function __construct(
        protected Input  $input,
        protected Output $output,
        protected Config $config,
    )
    {
    }

    public function taskResult(string $firstResult = null, string $secondResult = null)
    {
        $this->output->result([
            MessageEnum::HR,
            $firstResult ? sprintf(MessageEnum::RESULT_1, $this->input->getDay(), $firstResult) : null,
            $secondResult ? sprintf(MessageEnum::RESULT_2, $this->input->getDay(), $secondResult) : null,
            MessageEnum::HR,
        ]);
    }

    /**
     * @param string|null $filename If empty it will load default input/demo file
     * @return string[]
     * @throws Exception
     */
    public function loadData(?string $filename = null): array
    {
        return $this->input->loadData($filename);
    }
}