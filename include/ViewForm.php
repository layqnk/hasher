<?php
namespace App;

class ViewForm
{
    public function render(): string
    {
        return '<form method="post" action="index.php?action=hash">
                    <label for="password">Podaj hasło do zahashowania:</label>
                    <input type="text" id="password" name="password" required>
                    <label>Wybierz wariant:</label>
                    <select name="variant">
                        <option value="md5">md5(password)</option>
                        <option value="sha1">sha1(password)</option>
                        <option value="sha256">sha256(password)</option>
                        <option value="sha512">sha512(password)</option>
                        <option value="sha1md5">sha1(md5(password))</option>
                        <option value="password_hash">password_hash(password)</option>
                        <option value="password_hash-bcrypt">password_hash-bcrypt(password)</option>
                    </select>
                    <input type="submit" value="Zahashuj">
                </form>';
    }
}
?>