<?php
// 1. Deklarasi Array untuk menyimpan data barang
$daftarBarang = [
    ["kode" => "BRG001", "nama" => "Laptop", "jumlah" => 10, "harga" => 7500000],
    ["kode" => "BRG002", "nama" => "Mouse", "jumlah" => 25, "harga" => 85000]
];

// 2. Membuat Function sesuai kebutuhan
function tambahBarang(&$array, $kode, $nama, $jumlah, $harga) {
    $array[] = [
        "kode" => $kode,
        "nama" => $nama,
        "jumlah" => $jumlah,
        "harga" => $harga
    ];
}

function tampilkanBarang($array) {
    if (count($array) == 0) {
        echo "<p>Belum ada data barang.</p>";
        return;
    }
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Kode</th><th>Nama Barang</th><th>Jumlah</th><th>Harga Satuan</th><th>Total</th></tr>";
    foreach ($array as $item) {
        $total = $item["jumlah"] * $item["harga"];
        echo "<tr>";
        echo "<td>".$item["kode"]."</td>";
        echo "<td>".$item["nama"]."</td>";
        echo "<td>".$item["jumlah"]."</td>";
        echo "<td>Rp ".number_format($item["harga"],0,',','.')."</td>";
        echo "<td>Rp ".number_format($total,0,',','.')."</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function hitungTotalBarang($array) {
    $total = 0;
    foreach ($array as $item) {
        $total += $item["jumlah"];
    }
    return $total;
}

// 3. Proses input dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_POST["kode"];
    $nama = $_POST["nama"];
    $jumlah = $_POST["jumlah"];
    $harga = $_POST["harga"];
    tambahBarang($daftarBarang, $kode, $nama, $jumlah, $harga);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas Penanganan Form di PHP</title>
    <style>
        body { font-family: Arial; max-width: 800px; margin: 20px auto; padding: 20px; }
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 5px; }
        .form-group { margin-bottom: 10px; }
        label { display: block; margin-bottom: 5px; }
        input { padding: 6px; width: 100%; box-sizing: border-box; }
        button { padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Formulir Tambah Barang Inventaris</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>Kode Barang:</label>
            <input type="text" name="kode" required>
        </div>
        <div class="form-group">
            <label>Nama Barang:</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>Jumlah:</label>
            <input type="number" name="jumlah" min="1" required>
        </div>
        <div class="form-group">
            <label>Harga Satuan (Rp):</label>
            <input type="number" name="harga" min="1000" required>
        </div>
        <button type="submit">Simpan Barang</button>
    </form>

    <h3>Daftar Seluruh Barang</h3>
    <?php tampilkanBarang($daftarBarang); ?>

    <p><strong>Total Seluruh Barang: <?php echo hitungTotalBarang($daftarBarang); ?> unit</strong></p>
</body>
</html>