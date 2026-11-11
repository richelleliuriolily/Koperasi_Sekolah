<?php

function getAllSuppliers() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM suppliers ORDER BY supplier_id DESC");
    return $stmt->fetchAll();
}

function findSupplierById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM suppliers WHERE supplier_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createSupplier($data) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO suppliers (supplier_code, supplier_name, phone, address) VALUES (?, ?, ?, ?)");
    return $stmt->execute([
        $data['supplier_code'],
        $data['supplier_name'],
        $data['phone'],
        $data['address']
    ]);
}

function updateSupplier($id, $data) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE suppliers SET supplier_code = ?, supplier_name = ?, phone = ?, address = ? WHERE supplier_id = ?");
    return $stmt->execute([
        $data['supplier_code'],
        $data['supplier_name'],
        $data['phone'],
        $data['address'],
        $id
    ]);
}

function deleteSupplier($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM suppliers WHERE supplier_id = ?");
    return $stmt->execute([$id]);
}