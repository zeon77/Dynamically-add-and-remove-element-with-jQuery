<?php

/**
 * Adatbázis kapcsolódás
 *
 * @return $connection
 */
function getConnection()
{
    global $config;
    $connection = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
    if (!$connection) {
        logMessage("ERROR", 'Failed to connect to MySQL: ' . mysqli_connect_error());
        errorPage();
    }
    return $connection;
}

/**
 * Kiír egy hibát a logfájlba (logs/application.log)
 *
 * @param [string] $level Hiba szint.
 * @param [string] $message Hibaüzenet szövege.
 * @return void
 */
function logMessage($level, $message)
{
    $file = fopen("logs/application.log", "a");
    fwrite($file, "[$level] " . date("Y-m-d H:i:s") . " $message" . PHP_EOL);
    fclose($file);
}

/**
 * Hiba esetén megjeleníti a templates/error.php oldalt
 *
 * @return void
 */
function errorPage()
{
    include "templates/error.php";
    die();
}

/**
 * Gyártmányok lekérdezése
 *
 * @return void
 */
function getMakes($connection) {
    $query = "SELECT id, make FROM mtr_make";
    if ($result = mysqli_query($connection, $query)) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
}

function getModelsByMakeId($connection, $make_id) {
    $query = 
        "SELECT model
        FROM mtr_model
        WHERE make_id = ?";

    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $make_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        die();
        errorPage();
    } 
}