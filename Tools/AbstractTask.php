<?php

namespace Tools;

class AbstractTask
{
    const SUCCESS = 0;
    const FAIL = 1;

    public function __construct(
        protected Input  $input,
        protected Output $output,
        protected Config $config,
    )
    {
    }
}