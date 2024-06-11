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
            <span><a href="../rejestracja.html">Zarejestruj się</a></span><span><a href="./php/index.php">Strona główna</a></span><span><a href="../login.html"> Zaloguj
                    się</a></span>
        </nav>
        <main>
            <?php
            //Wprowadzenie danych do PHP
            $imie = $_POST["imie"];
            $nazwisko = $_POST["nazwisko"];
            $email = $_POST["email"];
            $haslo = $_POST["haslo"];
            $haslo2 = $_POST["haslo2"];
            $nick = $_POST["nick"];
            $plec = isset($_POST["plec"]);
            if ($plec == 1) {
                $plec = $_POST["plec"];
            }
            $data = $_POST["data_urodzenia"];

            //Taki regex ale dłuższy i nie umiem
            $uppercase = preg_match('@[A-Z]@', $haslo);
            $lowercase = preg_match('@[a-z]@', $haslo);
            $number = preg_match('@[0-9]@', $haslo);
            $specialChars = preg_match('@[^\w]@', $haslo);

            // data dzisiejsza i wiek uzytkownika
            $dzisY = intval(date("Y")); // 2024
            $uzytkownikY = intval(substr($data, 0, 4)); // 2005
            
            $dzisM = intval(date("n")); // 04
            $uzytkownikM = intval(substr($data, 5, 2)); // 06
            
            $dzisD = intval(date("d")); // 18
            $uzytkownikD = intval(substr($data, 8, 2)); // 29
            

            // sprawdzenie czy się wszystko zgadza czy czegoś nie brakuje
            if ($imie == null || $email == null || $nick == null || $haslo == null || $haslo2 == null || $data == null) {
                echo "Nie podałeś wszystkich obowiązkowych informacji!";
            } else if (!$uppercase || !$lowercase || (!$number  && !$specialChars) || strlen($haslo) < 8) {
                echo "Hasło nie spełnia wymagań!";
            } else if ($haslo != $haslo2) {
                echo "Hasła nie zgadzają się";
            } else {
                $wynikDane = true;
            }

            // sprawdzanie wieku
            if (($dzisY - $uzytkownikY) > 18) {
                $wynikW = true;
            } else if (($dzisY - $uzytkownikY) == 18) {
                if (($dzisM - $uzytkownikM) >= 0) {
                    if (($dzisD - $uzytkownikD) >= 0) {
                        $wynikW = true;
                    } else {
                        $wynikW = false;
                    }
                } else {
                    $wynikW = false;
                }
            } else {
                $wynikW = false;
            }

            if ($wynikW == false) {
                echo "Nie masz osiemnastu lat!";
            }

            // podłączenie bazy danych do tego pliku
            require "./dbconnect.php";

            $isNickFree = $connect->query("SELECT * FROM `uzytkownicy` WHERE nick = '$nick'");
            $isMailFree = $connect->query("SELECT * FROM `uzytkownicy` WHERE `email` = '$email'");

            //   wysłanie danych do bazy jeśli spełnia warunki
            if ($wynikW == true && isset($wynikDane) == true) {
                if (mysqli_fetch_array($isNickFree) != null) {
                    echo "Nick w użyciu";
                } else if (mysqli_fetch_array($isMailFree) != null) {
                    echo "Email w użyciu";
                } else {
                    $connect->query("INSERT INTO `uzytkownicy` (`id`, `imie`, `nazwisko`, `nick`, `email`, `haslo`, `data_urodzenia`, `plec`) VALUES (NULL, '$imie', '$nazwisko', '$nick', '$email', '$haslo', '$data', '$plec');");
                    echo "Udało się!<br>Możesz się teraz zalogować";
                }
            }
            ?>
        </main>
        <footer>
            <span>Projekt na PAI - Kacper Kowalczyk 2024 &copy;</span>
        </footer>
    </div>
</body>

</html>