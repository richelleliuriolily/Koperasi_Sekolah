<?php

function getAllEmployees() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM employees ORDER BY employee_id DESC");
    return $stmt->fetchAll();
}

function findEmployeeById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createEmployee($data) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO employees (employee_code, employee_name, phone, address, position) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([
        $data['employee_code'],
        $data['employee_name'],
        $data['phone'],
        $data['address'],
        $data['position']
    ]);
}

function updateEmployee($id, $data) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE employees SET employee_code = ?, employee_name = ?, phone = ?, address = ?, position = ? WHERE employee_id = ?");
    return $stmt->execute([
        $data['employee_code'],
        $data['employee_name'],
        $data['phone'],
        $data['address'],
        $data['position'],
        $id
    ]);
}

function deleteEmployee($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM employees WHERE employee_id = ?");
    return $stmt->execute([$id]);
}