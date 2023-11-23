<?php

namespace Tools\Cli;

use Tools\AbstractTask;
use Tools\Enum\TaskResultEnum;

class DayCreate extends AbstractTask
{

    public function execute(): int
    {
        $currentDay = $this->input->getDay();

        $taskDir = 'Days' . DIRECTORY_SEPARATOR . 'Day' . $currentDay;
        $taskFile = $taskDir . DIRECTORY_SEPARATOR . 'Task.php';

        $dataDir = $this->config->getDataDir() . DIRECTORY_SEPARATOR . 'day' . $currentDay;
        $demoFile = $dataDir . DIRECTORY_SEPARATOR . 'demo.txt';
        $inputFile = $dataDir . DIRECTORY_SEPARATOR . 'input.txt';
        $taskTemplateDirName = pathinfo(__FILE__, PATHINFO_DIRNAME);
        $taskTemplate = $taskTemplateDirName . DIRECTORY_SEPARATOR . 'skeleton' . DIRECTORY_SEPARATOR . 'Task.heredoc.php';

        if (file_exists($taskFile)) {
            $this->output->error(sprintf('Day %s already exists.', $this->input->getDay()));

            return TaskResultEnum::FAILURE;
        }

        if (!file_exists($taskDir)) {
            mkdir($taskDir);
        }

        if (file_exists($taskTemplate)) {
            $taskBody = null;
            require_once($taskTemplate);

            $taskBody && file_put_contents($taskFile, $taskBody);

            !file_exists($dataDir) && mkdir($dataDir);
            !file_exists($demoFile) && file_put_contents($demoFile, '');
            !file_exists($inputFile) && file_put_contents($inputFile, '');

            $this->output->success('Task created');

            return TaskResultEnum::SUCCESS;
        }

        $this->output->error('Task template not found');

        return TaskResultEnum::FAILURE;
    }
}