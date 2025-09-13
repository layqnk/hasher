<?php
session_start();
error_reporting(E_ALL);


require __DIR__ . '/vendor/autoload.php';

use App\{
    HashGenerator,
    SaveHash,
    ViewFile,
    GetNumber,
    ViewForm,
    CleanFile,
};

if (!isset($_SESSION['hash']) || !isset($_SESSION['n'])) {
    $_SESSION['hash'] = "";
    $_SESSION['n'] = 1;
}

$hash = $_SESSION['hash'];
$n = $_SESSION['n'];
include __DIR__ . '/template/header.html';
    if(!isset($_GET['action'])){
        $action = "";
    } else {
        $action = $_GET['action'];
    }

    switch ($action){
        case 'hash':
            $password = $_POST['password'];
            $variant = $_POST['variant'];
            $generator = new HashGenerator($password, $variant);
            $hash = $generator->getHash(); // metoda zwracająca hash
            $generator->tosession();    //zapis do sesji
            $nGetter = new GetNumber("hashes.txt");
            $n = $nGetter->get() + 1;
            echo "<a href='index.php?action=save&n=$n'>Zapisz hasz</a>";
            echo "<br /><a href='index.php'>Wróć</a>";
            $_SESSION['n'] = $n;
        break;
        case 'save':
            $password = $_SESSION['password'];
            $hash = $_SESSION['hash'];
            $n = $_SESSION['n'];
            $variant = $_SESSION['variant'] ?? 'sha1md5';
            $saver = new SaveHash("hashes.txt");
            $saver->save($n, $password, $hash, $variant);
            $_SESSION['n'] = $n + 1;
            echo "Zapisano hasło i jego hash do pliku. <a href='index.php?action=viewfile'>Zobacz plik</a>";
        break;
        case 'logout':
            session_destroy();
            $form = new ViewForm();
            echo $form->render();
        break;
        case 'viewfile':
            $viewer = new \App\ViewFile("hashes.txt");
            echo $viewer->show();
        break;
        case 'cleanfile':
        if (isset($_POST['adminpassword'])) 
        {
            $cleaner = new CleanFile("hashes.txt");
            if (!$cleaner->checkpassword($_POST['adminpassword'])) 
            {
                echo "Podano błędne hasło. <a href='javascript:history.back();'>Powrót</a>";
            } 
            else
            {    
                $cleaner = new CleanFile("hashes.txt");
                $cleaner->clean();
                echo "Plik został wyczyszczony. <a href='index.php'>Wróć</a>";
            }
        } 
        else 
        {
            $cleaner = new CleanFile("hashes.txt");
            echo $cleaner->getAdminPassword();
        }
        break;
        default:
            $form = new ViewForm();
            echo $form->render();
        break;
    }
include __DIR__ . '/template/footer.html';
?>