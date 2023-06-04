<?php

$api_key = 'my_secret_api_key'; // Ganti dengan kunci autentikasi Anda

// Cek header Authorization
$headers = apache_request_headers();
if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer ' . $api_key) {
    http_response_code(401);
    echo json_encode(array('message' => 'Unauthorized'));
    exit();
}

$search = $_GET['search']; // Ambil parameter search dari URL

// Buat array data contoh untuk merespons permintaan
$data = array(
    array('name' => 'John Doe', 'age' => 30),
    array('name' => 'Jane Doe', 'age' => 25),
    array('name' => 'Bob Smith', 'age' => 40),
    array('name' => 'Alice Brown', 'age' => 35),
    array('name' => 'Charlie Green', 'age' => 50),
);

// Filter data berdasarkan parameter search
if (!empty($search)) {
    $filteredData = array_filter($data, function ($item) use ($search) {
        return strpos(strtolower($item['name']), strtolower($search)) !== false;
    });

    $data = array_values($filteredData); // Reset kunci array
}

header('Content-Type: application/json');
echo json_encode($data);