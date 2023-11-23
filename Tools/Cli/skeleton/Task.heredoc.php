<?php

$_day = $currentDay ?? '00';
$_works = '$this->output->write(\'Task ' . $_day. ' works\');';

$taskBody =<<<EOF
<?php

namespace Days\Day{$_day};

use Tools\AbstractTask;
use Tools\Enum\TaskResultEnum;

class Task extends AbstractTask
{
    public function execute(): int
    {
        {$_works}       
        return TaskResultEnum::SUCCESS;
    }
}
EOF;
