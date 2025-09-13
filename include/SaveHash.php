<?php
/*namespace App;
class SaveHash
{
    private string $file;
    private string $password;
    private string $hash;
    public int $n;

    public function __construct($password,$hash,$n)
    {
        $file = fopen("hashes.txt", "a");
        $line = fwrite($file, $this->$n .". Hasło ".$this->password." = ".$this->hash. PHP_EOL);
        fclose($file);
        return $line;
    }

}
*/
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
     * numer. hasło = hash
     *
     * @param int $number Numer kolejny
     * @param string $password Hasło wprowadzone przez użytkownika
     * @param string $hash Wygenerowany hash
     * @return void
     */
    public function save(int $number, string $password, string $hash): void
    {
        // Tworzymy linię do zapisu
        $line = $number . ". " . $password . " = " . $hash . PHP_EOL;

        // Dopisanie do pliku
        file_put_contents($this->file, $line, FILE_APPEND);
    }
}