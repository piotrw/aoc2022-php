<?php

namespace Tools\Interface;

use Exception;

interface TaskInterface
{
    /**
     * Execute Task
     * @return int Success/Failure
     * @throws Exception
     */
    public function execute() : int;
}