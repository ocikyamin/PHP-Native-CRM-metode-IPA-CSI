<?php
error_reporting(0);
// FUNGSI
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

// jumlah pelanggan
$jmlPelanggan = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id)AS jml FROM customer"));
// jumlah produk 
$jmlProduk = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id)AS jml FROM tm_produk"));
// jumlah Transaksi 
$jmlTransaksi = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id)AS jml FROM cart"));
// jumlah Pemasukan
## Jumlah pemasukan diambil dari table bukti_pembayaran, dimana status pembayaran adalah diterima
$jmlPemasukan = mysqli_fetch_assoc(mysqli_query($con, "SELECT SUM(jumlah_total)AS jml FROM cart "));

$trbln = mysqli_query($con, "SELECT wkt, SUM(jumlah_total) AS total FROM cart GROUP BY month(wkt) ASC ");