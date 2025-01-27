<?php
// import modul
require_once "..\conn.php"; // konek database
require_once "query_function.php"; // cek session

// $username = $_POST['username'];
// $password = $_POST['password'];
// $Rpassword = $_POST['Rpassword'];
// $email = $_POST['email'];
// $ttl = $_POST['date'];
// $gender = $_POST['kelamin'];
// $alamat = $_POST['alamat'];
// $id_provinsi = '11';
// $id_kota = $_POST['kota'];
// $no_HP = $_POST['kontak'];
// $paypal_ID = $_POST['paypal'];

/// inisialisasi variabel dengan nilai data inputan dari form register.php dengan metode POST kedalam struktur data bertipe array lalu melakukan pengecekan sql injection
$data = [
    'username' => mysqli_real_escape_string($conn, $_POST['username']),
    'password' => $_POST['password'],
    'Rpassword' => $_POST['Rpassword'],
    'email' => mysqli_real_escape_string($conn, $_POST['email']),
    'ttl' => mysqli_real_escape_string($conn, $_POST['date']),
    'gender' => mysqli_real_escape_string($conn, $_POST['kelamin']),
    'alamat' => mysqli_real_escape_string($conn, $_POST['alamat']),
    'id_provinsi' => '11', // sementara
    'id_kota' => mysqli_real_escape_string($conn, $_POST['kota']),
    'no_HP' => mysqli_real_escape_string($conn, $_POST['kontak']),
    'paypal_ID' => mysqli_real_escape_string($conn, $_POST['paypal'])
];

/// inisialisasi variabel yang menampung nilai tanggal dan waktu pada saat modul ini dijalankan 
$date_created = date("Y-m-d H:i:s");
/// melakukan pengecekan password dan confirm password agar calon customer tidak melakukan kesalahan kedepannya 
if ($data['password'] === $data['Rpassword']) {
    $password_hashed = password_hash($data['password'], PASSWORD_DEFAULT);
} else {
    echo "<h1> Password yang anda masukkan tidak sama !</h1><a href='register.php'>kembali</a>";
}
// var_dump($data);
/// melakukan fungsi query register_customer() yang datanya berparameter dari array '$data'
register_customer($data['username'], $data['email'], $password_hashed, $data['ttl'], $data['alamat'], $data['id_provinsi'], $data['id_kota'], $data['no_HP'], $data['paypal_ID'], $data['gender'], $date_created);
