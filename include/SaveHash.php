<?php
namespace App;

class SaveHash
{
    private string $file;

    public function __construct(string $file = "hashes.txt")
    {
        $this->file = $file;
    }

/**
* Zapisuje hash do pliku w formacie:
* numer. hasło = hash. Wariant: wariant
*
* @param int $number Numer kolejny
* @param string $password Hasło wprowadzone przez użytkownika
* @param string $hash Wygenerowany hash
* @param string $variant Wariant hashowania    
* @return void
*/

    public function save(int $number, string $password, string $hash, string $variant): void
    {
        // Tworzymy linię do zapisu
        $line = $number . ". " . $password . " = " . $hash . ". Wariant: ". $variant . PHP_EOL;

        // Dopisanie do pliku
        file_put_contents($this->file, $line, FILE_APPEND);
    }
}