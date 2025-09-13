<?php
namespace App;
class HashGenerator
{
    private string $password;
    public string $hash;
    private string $variant;

    public function __construct($pass, $variant)
    {
        if (is_string($pass)) {
            $this->password = $pass;
            $this->variant = $variant;
            $this->hash = "";
        } else {
            echo "Podaj poprawne hasło";

        }
    }

        private function generateHash(): void
    {
        switch ($this->variant) {
            case 'md5':
                $this->hash = md5($this->password);
                break;
            case 'sha1':
                $this->hash = sha1($this->password);
                break;
            case 'sha256':
                $this->hash = hash('sha256', $this->password);
                break;
            case 'sha1md5':
            default:
                $this->hash = sha1(md5($this->password));
                $this->variant = 'sha1md5';
                break;
        }
        echo "Hasz dla hasła " . $this->password . " to: " . $this->hash;
    }

        public function getHash(): string
    {
        $this->generateHash();
        return $this->hash;
    }

    public function tosession(): void
    {
        $_SESSION['password'] = $this->password;
        $_SESSION['hash'] = $this->hash;
        $_SESSION['variant'] = $this->variant;
    }

}
?>