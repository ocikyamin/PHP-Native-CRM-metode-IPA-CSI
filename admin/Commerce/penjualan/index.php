<div class="pagetitle">
    <h1>Penjualan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">E-Commerce</li>
            <li class="breadcrumb-item active">Penjualan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card info-card sales-card bg-info shadow">
                <div class="card-body">
                    <h5 class="card-title text-white">Jumlah Pendapatan</h5>
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






    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Pedapatan</h5>
                    <div class="table-responsive">
                        <?php
                        foreach ($trbln as $bln) {
                            // echo "'" . date('d-F', strtotime($bln['wkt'])) . "'" . ',';
                            $bulan = date('Y-m', strtotime($bln['wkt']));
                            echo tgl_indo(date('Y-m', strtotime($bulan)));
                        }

                        ?>
                        <?php
                        foreach ($trbln as $bln) {
                            echo $bln['total'] . ',';
                        }
                        ?>
                        <?php
                        for ($i = 2019; $i <= date('Y'); $i++) {
                            echo $i . '<br>';
                        }

                        ?>

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
                                    echo "'".date('F', strtotime($b['wkt']))."'".",";
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
                                                ?>
                                                {
                                                label: 'Tahun <?=date('Y', strtotime($th['wkt']))?>',
                                                data: [<?php
                                                        foreach ($bln as $d) {
                                                            echo $d['total'] . ',';
                                                        }
                                                        ?>],
                                                backgroundColor: [
                                                    <?php
                                                    if ($getTh == 2020 ) {
                                                        echo "'red'";
                                                    }else if($getTh == 2021){
                                                         echo "'yellow'";
                                                    }                                                    
                                                    else{
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




                        <table class="table datatable table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jumlah Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($trbln as $bln) {
                                    echo "<pre>";
                                    print_r(date('d-m-Y', strtotime($bln['wkt'])));
                                    echo "</pre>";
                                }

                                $i = 1;
                                $transaksi = mysqli_query($con, "SELECT wkt, SUM(jumlah_total) AS total, MAX(jumlah_total) AS max FROM cart GROUP BY date(wkt) ASC ");
                                foreach ($transaksi as $t) {
                                ?>
                                <tr>
                                    <th scope="row"> <?= $i++ ?>. </th>
                                    <td><?= date('d/m/Y', strtotime($t['wkt'])) ?></td>
                                    <td><?= 'Rp. ' . number_format($t['total'], 0) ?>

                                        <!-- <?= $t['max'] ?> -->
                                        <?php
                                            if ($t['total'] > $t['max']) {
                                                echo "<span class='badge rounded-pill bg-success'>Terjadi Peningkatan</span>";
                                            }

                                            ?>

                                    </td>

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