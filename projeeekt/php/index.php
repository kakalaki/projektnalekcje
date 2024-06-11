<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Klub podpalaczy książek</title>
  <style>
    <?php require "../css/style.css" ?>
  </style>
  <style>
    main {
      height: 60vh;
    }
  </style>
</head>

<body>

  <div id=" container">
    <header>
      <h1>Klub podpalaczy książek</h1>
    </header>
    <nav>
      <span><a href="../rejestracja.html">Zarejestruj się</a></span>
      <span><a href="./index.php">Strona główna</a></span>
      <span><a href="../login.html"> Zaloguj się</a></span>
    </nav>
    <main>
      <?php
      require "./dbconnect.php";
      if (isset($_COOKIE['nick']) != null) {
        echo "Jesteś zalogowany, " . $_COOKIE['nick']."<br><br>";
        echo "Masz na imię " . mysqli_fetch_array($connect->query('SELECT imie FROM uzytkownicy WHERE "' . $_COOKIE['nick'] . '" = nick'))[0];
      } else {
        echo 'Jesteś niezalogowany';
      }

      ?>
      <form action="./logout.php" method="post">
        <button>Wyloguj się</button>
      </form>
    </main>
    <footer>
      <span>Projekt na PAI - Kacper Kowalczyk 2024 &copy;</span>
    </footer>
  </div>
</body>

</html>