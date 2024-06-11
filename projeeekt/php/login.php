<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Klub podpalaczy książek</title>
    <style>
        <?php include '../css/style.css' ?>
        main {
            height: 60vh;
        }
    </style>
</head>

<body>

    <div id="container">
        <header>
            <h1>Klub podpalaczy książek</h1>
        </header>
        <nav>
            <span><a href="../rejestracja.html">Zarejestruj się</a></span>
            <span><a href="./index.php">Strona główna</a></span>
            <span><a href="../login.html"> Zaloguj
                    się</a></span>
        </nav>
        <main>
            <?php
            //podlaczenie bazy danych
            require "./dbconnect.php";

            $nickE = $_POST['nick'];
            $haslo = $_POST['haslo'];

            $wz_mail = "/@/i";

            $checkNick = $connect->query("SELECT nick FROM uzytkownicy WHERE nick = '$nickE'");

            $checkEmail = $connect->query("SELECT email FROM uzytkownicy WHERE email = '$nickE'");

            $checkPass = $connect->query("SELECT haslo FROM uzytkownicy WHERE haslo = '$haslo'");



            if (preg_match($wz_mail, $nickE)) {
                if (mysqli_fetch_array($checkEmail) != null) {
                    if (mysqli_fetch_array($connect->query("SELECT email, haslo FROM uzytkownicy WHERE email = '$nickE' AND haslo = '$haslo'")) != null) {
                        $row = mysqli_fetch_array($connect->query("SELECT imie FROM uzytkownicy WHERE email = '$nickE'"));
                        $imie = $row["imie"];
                        $zalogowano = true;
                        global $zalogowano;


                    } else {
                        echo "Niepoprawny email lub hasło";
                    }
                } else {
                    echo "Niepoprawny email lub hasło";
                }
            } else if (mysqli_fetch_array($checkNick) != null) {
                if (($connect->query("SELECT nick, haslo FROM uzytkownicy WHERE nick = '$nickE' AND haslo = '$haslo'"))) {
                    if (mysqli_fetch_array($connect->query("SELECT nick, haslo FROM uzytkownicy WHERE nick = '$nickE' AND haslo = '$haslo'")) != null) {
                        $row = mysqli_fetch_array($connect->query("SELECT imie FROM uzytkownicy WHERE nick = '$nickE'"));
                        $imie = $row["imie"];
                        $zalogowano = true;
                        global $zalogowano;
                    } else {
                        echo "Niepoprawny nick lub hasło";
                    }
                } else {
                    echo "Niepoprawny nick lub hasło";
                }
            } else {
                echo "Niepoprawny nick/email lub hasło!";
            }

            global $zalogowano;

            if ($zalogowano == true) {
                echo "Poprawnie zalogowano!<br> Witaj " . $imie;
                setcookie("nick", $nickE, time()+3600, "/");
                global $imie;
            }


            ?>
        </main>
        <footer>
            <span>Projekt na PAI - Kacper Kowalczyk 2024 &copy;</span>
        </footer>
    </div>
</body>

</html>