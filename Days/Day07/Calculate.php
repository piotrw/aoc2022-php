<?php

namespace Days\Day07;

class Calculate
{
    /**
     * Calculate size of directory
     * @param Dir $node
     * @param int $threshold
     * @param int $total
     * @return int
     */
    public static function calculate(Dir $node, int $threshold, int &$total): int
    {
        $size = 0;
        foreach ($node->getFiles() as $file1) {
            $size += $file1;
        }

        foreach ($node->getDirs() as $dir) {
            $size += self::calculate($dir, $threshold, $total);
        }

        if ($size < $threshold) {
            $total += $size;
        }

        return $size;
    }

    /**
     * Calculate size of directory
     * @param Dir $node
     * @param int $threshold
     * @param int|null $total
     * @param array $dirsToDelete
     * @return int
     */
    public static function findDirectoryToDelete(Dir $node, int $threshold, int &$total = null, array &$dirsToDelete = []): int
    {
        $size = 0;
        foreach ($node->getFiles() as $file) {
            $size += $file;
        }

        foreach ($node->getDirs() as $dir) {
            $size += self::findDirectoryToDelete($dir, $threshold, $total, $dirsToDelete);
        }

        if ($size > $threshold) {
            $dirsToDelete[] = "{$node->getName()}: [{$size}]";
            $total = $total ? min($total, $size) : $size;
        }

        return $size;
    }
}