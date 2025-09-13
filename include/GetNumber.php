<?php
namespace App;
class GetNumber
{
    private string $file;

    public function __construct(string $file = "hashes.txt")
    {
        $this->file = $file;
    }

    public function get(): int
    {
        if (!file_exists($this->file)) {
            return 0;
        }

        $lines = file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return count($lines);
    }
}
?>