<?php

namespace Days\Day07;

use Tools\AbstractTask;
use Tools\Enum\MessageEnum;
use Tools\Enum\TaskResultEnum;

class Task extends AbstractTask
{
    const DIRECTORIES_TOTAL_SIZE = 100000;
    const AVAILABLE_SPACE = 70000000;
    const UPDATE_SIZE = 30000000;

    public function execute(): int
    {
        $input = $this->loadData();

        $tree = new Dir('/');
        $node = $tree;

        foreach ($input as $line) {
            $col = explode(' ', $line);
            if ($col[0] == '$') {
                switch ($col[1]) {
                    case 'cd' :
                        $node = $node->cd($col[2]);
                        break;
                    case 'ls' : // skip
                }
            } else {
                $node->add($col);
            }
        }

        $result1 = 0;
        $sizeTotal = Calculate::calculate($tree, self::DIRECTORIES_TOTAL_SIZE, $result1);
        $this->output->write('Total size: ' . $sizeTotal);

        $threshold = self::UPDATE_SIZE - (self::AVAILABLE_SPACE - $sizeTotal);
        $this->output->write('Threshold size: ' . $threshold);
        $this->output->newLine();

        $result2 = null;
        $dirsToDelete = [];
        Calculate::findDirectoryToDelete($tree, $threshold, $result2, $dirsToDelete);


        $this->output->write([
            'Possible directories to delete:',
            MessageEnum::HR,
            array_shift($dirsToDelete) . ' <- delete this',
            ...$dirsToDelete
        ]);

        $this->output->newLine();

        $this->taskResult($result1, $result2);

        return TaskResultEnum::SUCCESS;
    }

}