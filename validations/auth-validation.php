<?php

function validateRegister($data) {
    $errors = [];

    if (empty($data['username'])) {
        $errors[] = "Username tidak boleh kosong.";
    }

    if (empty($data['email'])) {
        $errors[] = "Email tidak boleh kosong.";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if (empty($data['password'])) {
        $errors[] = "Password tidak boleh kosong.";
    } elseif (strlen($data['password']) < 6) {
        $errors[] = "Password minimal harus terdiri dari 6 karakter.";
    }

    return $errors;
}

function validateLogin($data) {
    $errors = [];

    if (empty($data['email'])) {
        $errors[] = "Email tidak boleh kosong.";
    }

    if (empty($data['password'])) {
        $errors[] = "Password tidak boleh kosong.";
    }

    return $errors;
}