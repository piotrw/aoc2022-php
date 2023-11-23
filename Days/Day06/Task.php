<?php

namespace Days\Day06;

use Tools\AbstractTask;
use Tools\Enum\MessageEnum;
use Tools\Enum\TaskResultEnum;

class Task extends AbstractTask
{
    public function execute(): int
    {
        $input = $this->loadData();

        $output[] = MessageEnum::HR;
        for ($x = 0; $x < (count($input)); $x++) {
            $buffer = $input[$x];

            $markerLength = 4;
            for ($i = $markerLength; $i <= strlen($buffer); $i++) {
                $marker = substr($buffer, $i - $markerLength, $markerLength);
                if (count(array_unique(str_split($marker))) === $markerLength) {
                    $result1 = $i;
                    $output[] = sprintf(MessageEnum::RESULT_1, $this->input->getDay(), $result1);
                    break;
                }
            }
        }

        if (count($input) > 1) {
            $output[] = MessageEnum::HR;
        }

        for ($x = 0; $x < (count($input)); $x++) {
            $buffer = $input[$x];

            $markerLength = 14;
            for ($i = $markerLength; $i <= strlen($buffer); $i++) {
                $marker = substr($buffer, $i - $markerLength, $markerLength);

                if (count(array_unique(str_split($marker))) === $markerLength) {
                    $result2 = $i;
                    $output[] = sprintf(MessageEnum::RESULT_2, $this->input->getDay(), $result2);
                    break;
                }
            }
        }
        $output[] = MessageEnum::HR;
        
        $this->output->result($output);

        return TaskResultEnum::SUCCESS;
    }
}