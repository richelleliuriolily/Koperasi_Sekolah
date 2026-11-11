<?php

function validateCategory($data) {
    $errors = [];

    if (empty($data['category_name'])) {
        $errors[] = "Nama kategori tidak boleh kosong.";
    }

    return $errors;
}