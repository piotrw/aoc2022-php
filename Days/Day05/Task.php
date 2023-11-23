<?php

namespace Days\Day05;

use Tools\AbstractTask;
use Tools\Enum\TaskResultEnum;

class Task extends AbstractTask
{
    public function execute(): int
    {
        $input = $this->input->loadData();

        $inputSeparator = array_search('', $input) - 1;
        $cargoRaw = array_slice($input, 0, $inputSeparator);
        $cargoHeight = count($cargoRaw);
        $procedureRaw = array_slice($input, $cargoHeight + 2, count($input) - $cargoHeight - 2);

        // parse cargo
        $cargo = [];
        foreach ($cargoRaw as $row) {
            for ($i = 0; $i < (strlen($row) + 1) / 4; $i++) {
                $item = substr($row, $i * 4, 3);
                if (trim($item[1])) {
                    $tmp = $cargo[$i + 1] ?? [];
                    array_unshift($tmp, $item[1]);
                    $cargo[$i + 1] = $tmp;
                }
            }
        }

        // parse procedure
        $procedure = [];
        foreach ($procedureRaw as $item) {
            $matches = [];
            preg_match('/^move (\d+) from (\d+) to (\d+)/', $item, $matches);
            $procedure[] = array_slice($matches, 1, 3);
        }

        // do operations
        $cargoSim = $cargo;

        foreach ($procedure as list($itemsCount, $from, $to)) {
            $crane = array_splice($cargo[$from], count($cargo[$from]) - $itemsCount, $itemsCount);
            array_push($cargo[$to], ...array_reverse($crane));
        }

        foreach ($procedure as list($itemsCount, $from, $to)) {
            $crane = array_splice($cargoSim[$from], count($cargoSim[$from]) - $itemsCount, $itemsCount);
            array_push($cargoSim[$to], ...$crane);
        }

        // results
        $result1 = null;
        for ($i = 1; $i <= count($cargo); $i++) {
            $result1 .= $cargo[$i][count($cargo[$i]) - 1];
        }

        $result2 = null;
        for ($i = 1; $i <= count($cargoSim); $i++) {
            $result2 .= $cargoSim[$i][count($cargoSim[$i]) - 1];
        }

        $this->taskResult($result1, $result2);

        return TaskResultEnum::SUCCESS;
    }
}