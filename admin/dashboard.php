<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Selamat Datang <code>[ <?= strtoupper($user['username']) ?> ]</code></li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <p>
        <center>
            <!-- <img src="../public/assets/img/usiusi.png" alt=""> <br> -->
            CUSTOMER RELATIONSHIP MANAGEMENT (CRM) <br>
            <b>USIUSI</b> INTERIOR BUKITTINGGI
        </center>
    </p>
    <div class="row">
        <!-- Sales Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card info-card sales-card bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title text-white">Jumlah Pelanggan</h5>
                    <div class="d-flex align-items-center">
                        <div
                            class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-black text-white">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-white"><?= $jmlPelanggan['jml'] ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Sales Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card info-card sales-card bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title text-white">Jumlah Produk</h5>
                    <div class="d-flex align-items-center">
                        <div
                            class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-black text-white">
                            <i class="bi bi-columns-gap"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-white"><?= $jmlProduk['jml'] ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Sales Card -->

        <div class="col-lg-3 col-md-6">
            <div class="card info-card sales-card bg-warning shadow">
                <div class="card-body">
                    <h5 class="card-title text-white">Jumlah Transaksi</h5>
                    <div class="d-flex align-items-center">
                        <div
                            class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-black text-white">
                            <i class="bi bi-cart4"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-white"><?= $jmlTransaksi['jml'] ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Sales Card -->

        <div class="col-lg-3 col-md-6">
            <div class="card info-card sales-card bg-info shadow">
                <div class="card-body">
                    <h5 class="card-title text-white">Total Pemasukan</h5>
                    <div class="d-flex align-items-center">
                        <div
                            class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-black text-white">
                            <i class="bi bi-credit-card-2-front"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-white"><?= 'Rp.' . number_format($jmlPemasukan['jml'], 0) ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Sales Card -->




    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Perbulan Setiap Tahun</h5>
                    <div class="table-responsive">

                        <canvas id="penjualan" style="max-height: 400px;"></canvas>
                        <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#penjualan'), {
                                type: 'bar',
                                data: {
                                    labels: [
                                        <?php
                                            //  daftar bulan 
                                            $trBlan = mysqli_query($con, "SELECT wkt FROM cart GROUP BY MONTH(wkt) ORDER BY MONTH(wkt) ASC");
                                            foreach ($trBlan as $b) {
                                                // echo "'" . date('d-F', strtotime($bln['wkt'])) . "'" . ',';
                                                $bulan = date('Y-m', strtotime($b['wkt']));
                                                echo "'" . date('F', strtotime($b['wkt'])) . "'" . ",";
                                            }

                                            ?>
                                    ],
                                    datasets: [
                                        <?php
                                            // buat daftar Tahun 
                                            $tahun = mysqli_query($con, "SELECT wkt FROM cart GROUP BY YEAR(wkt) ORDER BY wkt ASC; ");
                                            foreach ($tahun as $th) {
                                                // dapatkan Transaksi perbulan berdasarkan setiap tahun
                                                $getTh = date('Y', strtotime($th['wkt']));
                                                $bln = mysqli_query($con, "SELECT wkt, SUM(jumlah_total) AS total FROM cart WHERE YEAR(wkt)='$getTh' GROUP BY month(wkt) ASC ");
                                            ?> {
                                            label: 'Tahun <?= date('Y', strtotime($th['wkt'])) ?>',
                                            data: [<?php
                                                            foreach ($bln as $d) {
                                                                echo $d['total'] . ',';
                                                            }
                                                            ?>],
                                            backgroundColor: [
                                                <?php
                                                        if ($getTh == 2020) {
                                                            echo "'red'";
                                                        } else if ($getTh == 2021) {
                                                            echo "'yellow'";
                                                        } else {
                                                            echo "'green'";
                                                        }
                                                        ?>


                                            ],
                                            borderWidth: 3
                                        },
                                        <?php
                                            }
                                            ?>


                                    ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                        </script>
                        <!-- End Bar CHart -->
                        <h5 class="card-title">Grafik Setiap Tahun</h5>
                        <!-- Line Chart -->
                        <canvas id="lineChart" style="max-height: 400px;"></canvas>
                        <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#lineChart'), {
                                type: 'line',
                                data: {
                                    labels: [
                                        <?php
                                            $list_tahun = mysqli_query($con, "SELECT wkt, SUM(jumlah_total) AS total FROM cart GROUP BY YEAR(wkt) ASC ");
                                            foreach ($list_tahun as $t) {
                                                echo "'" . date('Y', strtotime($t['wkt'])) . "'" . ',';
                                            }

                                            ?>
                                    ],
                                    datasets: [{
                                        label: 'Pendapatan',
                                        data: [<?php

                                                    foreach ($list_tahun as $t) {
                                                        echo $t['total'] . ',';
                                                    }

                                                    ?>],
                                        fill: false,
                                        borderColor: '#4B0082',
                                        tension: 0.1,
                                        borderWidth: 5,
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                        </script>
                        <!-- End Line CHart -->
                        <hr>



                        <table class="table datatable table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Jumlah Pemasukan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                $i = 1;
                                $transaksi = mysqli_query($con, "SELECT wkt, SUM(jumlah_total) AS total FROM cart GROUP BY YEAR(wkt) DESC ");
                                foreach ($transaksi as $t) {
                                    // $ts = date('Y', strtotime($t['wkt']))-1;
                                    // $thsebelum = mysqli_fetch_assoc(mysqli_query($con, "SELECT wkt, SUM(jumlah_total) AS total FROM cart WHERE YEAR(wkt)='$ts' GROUP BY YEAR(wkt) DESC "));
                                    // $selisih = abs($t['total'] - $thsebelum['total']);
                                    // $persen = $t['total']/$thsebelum['total']*100;




                                ?>
                                <tr>
                                    <th scope="row"> <?= $i++ ?>. </th>
                                    <td><?= date('Y', strtotime($t['wkt'])) ?></td>
                                    <td><?= 'Rp. ' . number_format($t['total'], 0) ?></td>

                                </tr>
                                <?php
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


    </div>

</section>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>