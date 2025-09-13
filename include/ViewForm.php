<?php
namespace App;

class ViewForm
{
    public function render(): string
    {
        return '<form method="post" action="index.php?action=hash">
                    <label for="password">Podaj hasło do zahashowania:</label>
                    <input type="text" id="password" name="password" required>
                    <input type="submit" value="Zahashuj">
                </form>';
    }
}
?>