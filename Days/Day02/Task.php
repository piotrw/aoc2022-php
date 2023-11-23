<?php

namespace Days\Day02;

use Tools\AbstractTask;
use Tools\Enum\TaskResultEnum;

class Task extends AbstractTask
{
    public function execute(): int
    {
        $input = $this->loadData();

        $draws = [
            'A' => 'X', // rock  X
            'B' => 'Y', // paper Y
            'C' => 'Z', // scissors Z
        ];

        $wins = [
            'A' => 'Y', // rock  X
            'B' => 'Z', // paper Y
            'C' => 'X', // scissors Z
        ];

        $loose = [
            'A' => 'Z', // rock  X
            'B' => 'X', // paper Y
            'C' => 'Y', // scissors Z
        ];

        $points  = [
            'X' => 1, // rock  X
            'Y' => 2, // paper Y
            'Z' => 3, // scissors Z
        ];

        $totalPoints = $totalPoints2 = 0;

        foreach ($input as $round) {
            $elf = $round[0];
            $me = $round[2];

            if ($wins[$elf] == $me) {
                $totalPoints += $points[$me] + 6;
            }
            elseif ($draws[$elf] == $me) {
                // draw
                $totalPoints += $points[$me] + 3;
            }
            else {
                $totalPoints += $points[$me];
            }
            switch ($me) {
                case 'Y': // rock - draw
                    $sel = $draws[$elf];
                    $totalPoints2 += $points[$sel] + 3;
                    break;
                case 'X': // paper - lose
                    $sel = $loose[$elf];
                    $totalPoints2 += $points[$sel];
                    break;
                case 'Z': // scissors - wins
                    $sel = $wins[$elf];
                    $totalPoints2 += $points[$sel] + 6;
                    break;
            }
        }

        $this->taskResult($totalPoints, $totalPoints2);

        return TaskResultEnum::SUCCESS;
    }
}