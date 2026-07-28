function validasiForm() {
    const nama = document.getElementById('nama').value.trim();
    const meja = document.getElementById('meja').value;
    const menu = document.getElementById('menu').value;
    const jumlah = document.getElementById('jumlah').value;

    if (nama === "") {
        tampilkanPesan("Nama pemesan tidak boleh kosong!", "error");
        return false;
    }
    if (meja < 1 || meja > 20) {
        tampilkanPesan("Nomor meja harus 1-20!", "error");
        return false;
    }
    if (menu === "") {
        tampilkanPesan("Silakan pilih menu!", "error");
        return false;
    }
    if (jumlah < 1 || jumlah > 10) {
        tampilkanPesan("Jumlah pesanan 1-10 per menu!", "error");
        return false;
    }
    return true;
}

function tampilkanPesan(teks, tipe) {
    const elemen = document.getElementById('pesan');
    elemen.innerHTML = `<div class="pesan ${tipe}">${teks}</div>`;
    setTimeout(() => elemen.innerHTML = "", 3000);
}