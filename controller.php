<?php
require 'database.php';


session_start();

print_r($_REQUEST);

// // Verifico il formato di una email
// $regexemail = '/^((?![.])[\w\-\.]+)(@\w+)(\.\w+(\.\w+)?[^.\W])$/m';
// preg_match_all($regexemail, htmlspecialchars($_REQUEST['email']), $matchesEmail, PREG_SET_ORDER, 0);
// $email = $matchesEmail ? htmlspecialchars($_REQUEST['email']) : exit();

// // Verifico il formato di una password
// $regexPass = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{6,}$/';
// preg_match_all($regexPass, htmlspecialchars($_REQUEST['password']), $matchesPass, PREG_SET_ORDER, 0);
// $pass = $matchesPass ? htmlspecialchars($_REQUEST['password']) : exit();
// $password = password_hash($pass, PASSWORD_DEFAULT);

$email = $_REQUEST['email'];
$pass = $_REQUEST['password'];

if (strlen($email) > 3 || strlen($password) > 3) {
    header('Location: index.php');
}

// Leggo dati da una tabella

$sql = "SELECT FROM users WHERE email = '" . $email . "'" . " AND password = '" . $pass . "'";

$res = $mysqli->query($sql); // return un mysqli result

$_SESSION['username']= $email;


if ($row = $res->fetch_assoc()) {
    if (password_verify($pass, $row['password'])) {
        $_SESSION['userLogin'] = $row;
        session_write_close();
        // Verifico se durante il login è stata messa la spunto sulla checkbox Remember me
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Password errata!!!';
        header('Location: login.php');
    }
} else {
    $_SESSION['error'] = 'Email e Password errati!!!';
    header('Location: login.php');
}

