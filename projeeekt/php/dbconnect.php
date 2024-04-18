<?php

$login = "root";
$password = "";

$connect = new mysqli("localhost", $login, $password);
$connect->set_charset("utf8");
$connect->query("CREATE DATABASE IF NOT EXISTS projekt");
$connect->select_db("projekt");
$connect->query("CREATE TABLE IF NOT EXISTS `projekt`.`uzytkownicy` (`id` INT NOT NULL AUTO_INCREMENT , `imie` TEXT NOT NULL , `nazwisko` TEXT NULL , `nick` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `haslo` VARCHAR(255) NOT NULL , `data_urodzenia` DATE NOT NULL , `plec` TEXT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;")

    ?>