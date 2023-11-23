<?php

namespace Days\Day04;

use Tools\AbstractTask;
use Tools\Enum\TaskResultEnum;

class Task extends AbstractTask
{
    public function execute(): int
    {
        $input = $this->loadData();

        $doubleTaskCounter = $overlapTaskCounter = 0;
        foreach ($input as $pair) {
            list($leftElf, $rightElf) = explode(',', $pair);
            list($leftElfLeft, $leftDudeRight) = explode('-', $leftElf);
            list($rightElfLeft, $rightElfRight) = explode('-', $rightElf);

            if (
                ($leftElfLeft >= $rightElfLeft && $leftDudeRight <= $rightElfRight) ||
                ($rightElfLeft >= $leftElfLeft && $rightElfRight <= $leftDudeRight)
            ) {
                $doubleTaskCounter++;
            };

            if ($leftDudeRight < $rightElfLeft || $rightElfRight < $leftElfLeft) {
                $overlapTaskCounter++;
            }
        }

        $this->taskResult(
            $doubleTaskCounter, // result 1
            count($input) - $overlapTaskCounter // result 2
        );

        return TaskResultEnum::SUCCESS;
    }
}