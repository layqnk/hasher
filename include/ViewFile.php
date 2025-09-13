<?php
namespace App;

class ViewFile
{
    private string $filename;

    public function __construct(string $filename = "hashes.txt")
    {
        $this->filename = $filename;
    }

    public function show(): string
    {
        $listing = "";
        if (!file_exists($this->filename)) {
            return "Plik nie istnieje.";
        }

        $handle = fopen($this->filename, "r");
        while (($line = fgets($handle)) !== false) {
            $listing .= htmlspecialchars($line) . "<br />";
        }
        fclose($handle);
        $listing .= "<br /><a href=index.php?action=cleanfile>Wyczyść plik</a><br />";

        return $listing;
    }
}
?>