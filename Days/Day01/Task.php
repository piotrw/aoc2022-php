<?php

namespace Days\Day01;

use Tools\AbstractTask;
use Tools\Enum\TaskResultEnum;

class Task extends AbstractTask
{
    public function execute(): int
    {

        $data = $this->loadData();

        $total = [];
        $elf = 0;
        foreach ($data as $cal) {
            if (!$cal || !$total) {
                $elf++;
            }

            if (!isset($total[$elf])) {
                $total[$elf] = 0;
            }

            $total[$elf] += (int)$cal;
        }

        rsort($total);

        $result1 = current($total);
        $result2 = array_sum(array_slice($total, 0, 3));

        $this->taskResult($result1, $result2);

        return TaskResultEnum::SUCCESS;
    }
}