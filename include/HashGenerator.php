<?php
namespace App;
class HashGenerator
{
    private string $password;
    public string $hash;
    public function __construct($pass)
    {
        if (is_string($pass)) {
            $this->password = $pass;
            $this->hash = sha1(md5($this->password));
            echo "Hasz dla hasła " . $this->password . " to: " . $this->hash;
        } else {
            echo "Podaj poprawne hasło";

        }
    }
    public function getHash(): string
    {
        return $this->hash;
    }

    public function tosession(): void
    {
        $_SESSION['password'] = $this->password;
        $_SESSION['hash'] = $this->hash;
    }

}
?>