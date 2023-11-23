<?php

namespace Tools;

use Tools\Enum\MessageEnum;

class Output
{
    public function title(string|array $title = null): void
    {
        if (!$title) return;
        echo "\e[1;33;42m {$title} \e[0m" . PHP_EOL;
    }

    public function write(string|array $message = null): void
    {
        if (!$message) return;
        echo $message . PHP_EOL;
    }

    public function hr(int $length = null): void
    {
        if ($length) {
            echo str_pad(MessageEnum::HR, $length, MessageEnum::HR[0]) . PHP_EOL;
            return;
        }
        echo MessageEnum::HR;
    }

    public function dump()
    {

    }

    public function error(string $error)
    {
        echo "\e[01;31m 🛑 Error: \n    {$error} \e[0m\n";
    }

    public function result(string|array $messages): void
    {
        if (is_array($messages)) {
            foreach ($messages as $message) {
                // new length for hr
                if ($message == MessageEnum::HR) {
                    $length = array_reduce($messages, fn($acc, $msg) => max(strlen($msg), $acc), 0) - 1;
                    $message = str_pad(MessageEnum::HR, $length, MessageEnum::HR[0]);
                }
                $this->result($message);
            }
            return;
        }
        echo "\e[33m {$messages} \e[0m\n";
    }
}