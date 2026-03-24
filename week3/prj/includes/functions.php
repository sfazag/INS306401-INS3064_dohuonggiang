<?php

function loadUsers() {
    return json_decode(file_get_contents(USER_FILE), true);
}

function saveUsers($users) {
    file_put_contents(USER_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

function findUser($username) {
    $users = loadUsers();
    foreach ($users as $user) {
        if ($user["username"] === $username) {
            return $user;
        }
    }
    return null;
}

function escape($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}