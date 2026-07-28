<?php
session_start();
// Inisialisasi daftar pesanan
if (!isset($_SESSION['pesanan'])) {
    $_SESSION['pesanan'] = [];
}

// Daftar menu makanan
$daftarMenu = [
    ["id" => 1, "nama" => "Nasi Goreng Spesial", "harga" => 15000],
    ["id" => 2, "nama" => "Mie Ayam", "harga" => 12000],
    ["id" => 3, "nama" => "Ayam Bakar", "harga" => 20000],
    ["id" => 4, "nama" => "Soto Ayam", "harga" => 13000],
    ["id" => 5, "nama" => "Es Teh Manis", "harga" => 3000]
];

// Proses kirim pesanan
$pesan = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $meja = $_POST['meja'];
    $idMenu = $_POST['menu'];
    $jumlah = $_POST['jumlah'];
    $catatan = htmlspecialchars($_POST['catatan']);

    // Cari harga menu
    $hargaSatuan = 0;
    $namaMenu = "";
    foreach ($daftarMenu as $m) {
        if ($m['id'] == $idMenu) {
            $hargaSatuan = $m['harga'];
            $namaMenu = $m['nama'];
            break;
        }
    }
    $total = $hargaSatuan * $jumlah;

    // Simpan ke sesi
    $pesananBaru = [
        "nama" => $nama,
        "meja" => $meja,
        "menu" => $namaMenu,
        "jumlah" => $jumlah,
        "total" => $total,
        "catatan" => $catatan
    ];
    array_push($_SESSION['pesanan'], $pesananBaru);
    $pesan = "Pesanan berhasil ditambahkan! Total: Rp " . number_format($total,0,',','.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pemesanan Makanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>SISTEM PEMESANAN MAKANAN</h1>
        </header>

        <nav>
            <a href="#">Beranda</a> |
            <a href="#">Daftar Menu</a> |
            <a href="#">Tentang Kami</a>
        </nav>

        <div id="pesan"></div>
        <?php if ($pesan) echo "<div class='pesan sukses'>$pesan</div>"; ?>

        <div class="row">
            <!-- Kolom Form Pesanan -->
            <div class="col">
                <h2>Form Pemesanan</h2>
                <form method="POST" action="" onsubmit="return validasiForm()">
                    <div class="form-group">
                        <label>Nama Pemesan:</label>
                        <input type="text" name="nama" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Meja (1-20):</label>
                        <input type="number" name="meja" id="meja" min="1" max="20" required>
                    </div>
                    <div class="form-group">
                        <label>Pilih Menu:</label>
                        <select name="menu" id="menu" required>
                            <option value="">-- Pilih Menu --</option>
                            <?php foreach ($daftarMenu as $m): ?>
                            <option value="<?= $m['id'] ?>">
                                <?= $m['nama'] ?> - Rp <?= number_format($m['harga'],0,',','.') ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Pesanan:</label>
                        <input type="number" name="jumlah" id="jumlah" min="1" max="10" value="1" required>
                    </div>
                    <div class="form-group">
                        <label>Catatan Khusus:</label>
                        <textarea name="catatan" rows="3" placeholder="Contoh: Tanpa pedas"></textarea>
                    </div>
                    <button type="submit">Kirim Pesanan</button>
                </form>
            </div>

            <!-- Kolom Daftar Pesanan -->
            <div class="col">
                <h2>Daftar Pesanan Aktif</h2>
                <?php if (empty($_SESSION['pesanan'])): ?>
                    <p>Belum ada pesanan yang masuk.</p>
                <?php else: ?>
                <table>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Meja</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                    <?php $no=1; foreach ($_SESSION['pesanan'] as $psn): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $psn['nama'] ?></td>
                        <td><?= $psn['meja'] ?></td>
                        <td><?= $psn['menu'] ?></td>
                        <td><?= $psn['jumlah'] ?></td>
                        <td>Rp <?= number_format($psn['total'],0,',','.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        </div>

        <footer>
            Tugas Akhir Pemrograman Web - Sistem Pemesanan Makanan © 2026
        </footer>
    </div>
    <script src="script.js"></script>
</body>
</html>