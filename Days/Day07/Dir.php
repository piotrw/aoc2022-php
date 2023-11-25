<?php

namespace Days\Day07;

use Exception;

class Dir
{
    private Dir $root;
//    private Dir|null $parent = null;
//    private string $name;
//    /**
//     * @var int[]
//     */
//    private array $files = [];
//    /**
//     * @var Dir[]
//     */
//    private array $dirs = [];
    private string $path = '/';

    /**
     * @param Dir|null $parent
     * @param string $name
     * @param int[] $files
     * @param Dir[] $dirs
     */
    public function __construct(
        private string $name,
        private ?Dir $parent = null,
        private array $files = [],
        private array $dirs = [])
    {
//        $this->name = $name;
//        $this->parent = $parent;
        $this->root = $parent ? $parent->root : $this;
//        $this->files = $files;
//        $this->dirs = $dirs;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function cd($name)
    {
        switch ($name) {
            case '/' :
                return $this->root;
            case '..' :
                return $this->parent;
            default :
                foreach ($this->dirs as $dir) {
                    if ($dir->name == $name) {
                        return $dir;
                    };
                }
        }

        return null;
    }

    /**
     * Add element to directory
     * @param array $item
     * @return void
     * @throws Exception
     */
    public function add(array $item): void
    {
        if (is_numeric($item[0])) {
            $this->addFile($item[1], $item[0]);
        } elseif ($item[0] == 'dir') {
            $this->addDir($item[1]);
        }
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @return array
     */
    public function getDirs(): array
    {
        return $this->dirs;
    }

    /**
     * @param string $name
     * @param int $size
     * @return void
     * @throws Exception
     */
    public function addFile(string $name, int $size): void
    {
        if (isset($this->files[$name])) {
            throw new Exception('Task Error: File already exist!');
        }

        $this->files[$name] = $size;
    }

    /**
     * @param $name
     * @return void
     * @throws Exception
     */
    public function addDir($name): void
    {
        if (isset($this->dirs[$name])) {
            throw new Exception('Task Error: Directory already exist!');
        }

        $newDir = new Dir($name, $this);
        $newDir->path = $this->path . '/' . $name;
        $this->dirs[$name] = $newDir;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

}