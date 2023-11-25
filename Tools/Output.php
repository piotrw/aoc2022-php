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

    public function write(string|array $messages = null): void
    {
        if (!$messages) return;
        if (is_array($messages)) {
            foreach ($messages as $message) {
                if ($message == MessageEnum::HR) $messages = $this->dynamicHr($messages);
                $this->write($message);
            }
            return;
        }
        echo $messages . PHP_EOL;
    }

    public function newLine(int $count = 1)
    {
        echo str_pad(PHP_EOL, $count, PHP_EOL);
    }

    public function hr(int $length = null): void
    {
        if ($length) {
            echo str_pad(MessageEnum::HR, $length, MessageEnum::HR[0]) . PHP_EOL;
            return;
        }
        echo MessageEnum::HR;
    }

    /**
     * Draw new HR that have length equal to the longest message in array
     * @param array $messages
     * @return string Proper length HR
     */
    private function dynamicHr(array $messages)
    {
        $length = array_reduce($messages, fn($acc, $msg) => max(strlen($msg ?: ''), $acc), 0);
        return str_pad(MessageEnum::HR, $length, MessageEnum::HR[0]);
    }

    public function dump(): void
    {
        // not yet
    }

    public function success(string $message): void
    {
        echo "\e[1;32m 👌 Success: \n    {$message} \e[0m\n";
    }

    public function error(string $error): void
    {
        echo "\e[01;31m 🛑 Error: \n    {$error} \e[0m\n";
    }

    public function result(string|array $messages = null): void
    {
        if (!$messages) return;;

        if (is_array($messages)) {
            foreach ($messages as $message) {
                if ($message == MessageEnum::HR) $message = $this->dynamicHr($messages);
                $this->result($message);
            }
            return;
        }
        echo "\e[33m{$messages}\e[0m\n";
    }
}