<?php
namespace App;
use Exception;
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
            case 'sha512':
                $this->hash = hash('sha512', $this->password);
                break;
            case 'password_hash-bcrypt':
                $this->hash = password_hash($this->password, PASSWORD_BCRYPT);
                break;
            case 'password_hash':
                $this->hash = password_hash($this->password, PASSWORD_DEFAULT);
                break;
            case 'sha1md5':
                $this->hash = sha1(md5($this->password));
            default:
                $this->hash = new Exception("Niepoprawny wariant haszowania");
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