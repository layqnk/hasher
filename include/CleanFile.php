<?php
namespace App;
class CleanFile
{
    public string $file = "hashes.txt";
    private string $adminpassword = "admin123";

    public function __construct(string $file = "hashes.txt")
    {
        $this->file = $file;
    }

    public function getAdminPassword(): string
    {
        return '<form method="post" action="index.php?action=cleanfile">
                    <label for="password">Podaj hasło administratora:</label>
                    <input type="password" id="adminpassword" name="adminpassword" required>
                    <input type="submit" value="Wyślij">
                </form>';
    }

    public function checkpassword($password) : bool
    {
        return $password === $this->adminpassword;
    }

    public function clean(): void
    {
        if (file_exists($this->file)) {
            file_put_contents($this->file, '');
        }
    }
}
    
    
?>