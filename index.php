<?php

$messages = [];

if (!file_exists("messages.json")) {
    file_put_contents("messages.json", '');
}
else {
    $messages = json_decode(file_get_contents("messages.json"));
}

$users = [
    [
        "anon",
        "123"
    ],
    [
        "portalcat",
        "cat"
    ]
];

echo '
    <form action="/" method="post">
        <label> Username: 
            <input name="name" type="text">
        </label> <br>
        <label> Password: 
            <input name="pass" type="text">
        </label> <br>
        <label> Message: 
            <input name="mess" type="text">
        </label> <br>
        <input type="submit" value="Submit">
    </form>
    ';

$name = $_POST['name'];
$pass = $_POST['pass'];
$mess = $_POST['mess'];

if ((($name == $users[0][0] && $pass == $users[0][1]) ||
     ($name == $users[1][0] && $pass == $users[1][1])) && trim($mess) != '') {
    $mes_title = $name. " " . date("d.m.y D H:i (e)");

    $messages[] = ['mes_title' => $mes_title, 'mes' => $mess];
    file_put_contents("messages.json", json_encode($messages));
}

if (file_exists("messages.json")) {
    $messages = json_decode(file_get_contents("messages.json"));
    foreach ($messages as $message) {
        $mes_title = $message->mes_title;
        $mes = $message->mes;
        echo "<br>$mes_title: $mes<br>";
    }
}