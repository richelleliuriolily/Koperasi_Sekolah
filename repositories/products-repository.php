<?php

function getAllProducts() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM products ORDER BY product_id DESC");
    return $stmt->fetchAll();
}

function findProductById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createProduct($data) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO products (product_code, product_name, category, unit, price, stock, entry_date, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([
        $data['product_code'],
        $data['product_name'],
        $data['category'],
        $data['unit'],
        $data['price'],
        $data['stock'],
        $data['entry_date'],
        $data['description']
    ]);
}

function updateProduct($id, $data) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE products SET product_code = ?, product_name = ?, category = ?, unit = ?, price = ?, stock = ?, entry_date = ?, description = ? WHERE product_id = ?");
    return $stmt->execute([
        $data['product_code'],
        $data['product_name'],
        $data['category'],
        $data['unit'],
        $data['price'],
        $data['stock'],
        $data['entry_date'],
        $data['description'],
        $id
    ]);
}

function deleteProduct($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
    return $stmt->execute([$id]);
}