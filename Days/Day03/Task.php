<?php

namespace Days\Day03;

use Tools\AbstractTask;
use Tools\Enum\TaskResultEnum;

class Task extends AbstractTask
{
    public function execute(): int
    {
        $input = $this->loadData();

        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $priority = [];
        for ($i = 1; $i < 26; $i++) {
            $priority[$alphabet[$i]] = $i + 1;
            $priority[ucfirst($alphabet[$i])] = $i + 27;
        }

        $total = 0;
        foreach ($input as $bag) {
            $length = strlen($bag) / 2;
            $leftCompartment = substr($bag, 0, $length);
            $rightCompartment = substr($bag, $length, $length);

            for ($i = 0; $i <= $length; $i++) {
                $currItem = $leftCompartment[$i];
                if(str_contains($rightCompartment, $currItem)) {
                    $total += $priority[$currItem];
                    break;
                }
            }

        }

        # TASK 2

        $points2 = 0;
        $groupsCount = count($input) / 3;

        for ($i = 0; $i < $groupsCount; $i++) {
            $bag1 = $input[$i * 3];
            $bag2 = $input[$i * 3 + 1];
            $bag3 = $input[$i * 3 + 2];

            foreach (str_split($bag1) as $currItem) {
                if(str_contains($bag2, $currItem) && str_contains($bag3, $currItem)) {
                    $points2 += $priority[$currItem];
                    break;
                }
            }
        }

        $this->taskResult($total, $points2);

        return TaskResultEnum::SUCCESS;
    }
}