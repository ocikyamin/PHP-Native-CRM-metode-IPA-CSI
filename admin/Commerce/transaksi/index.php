<div class="pagetitle">
    <h1>Transaksi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">E-Commerce</li>
            <li class="breadcrumb-item active">Transaksi</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Transaksi</h5>

                    <div class="table-responsive">
                        <table class="table datatable table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Wkt</th>
                                    <th scope="col">Total Belanja</th>
                                    <th scope="col">Status Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $transaksi = mysqli_query($con, "SELECT cart.*,customer.nama FROM `cart` JOIN customer ON cart.user_id=customer.id ORDER BY cart.id ASC");
                                foreach ($transaksi as $t) {
                                ?>
                                <tr>
                                    <th scope="row"> <?= $i++ ?>. </th>
                                    <td><a
                                            href="?/=invoice&q=<?= base64_encode($t['id']) ?>"><b><?= $t['kode'] ?></b></a>
                                    </td>
                                    <td><?= $t['nama'] ?></td>
                                    <td><?= $t['wkt'] ?></td>
                                    <td><?= $t['jumlah_total'] ?></td>
                                    <td>
                                        <ul>
                                            <li><?php
                                                    if ($t['status'] == 'new') {
                                                        echo "<span class='badge rounded-pill bg-warning text-dark'>Belum Konfirmasi Pembayaran</span>";
                                                    } else {
                                                        echo "<span class='badge rounded-pill bg-secondary'>" . $t['status'] . "</span>";
                                                    }

                                                    ?></li>
                                            <li><?php
                                                    if ($t['stt_transaksi'] == 1) {
                                                        echo "<span class='badge rounded-pill bg-success'>Transaksi Selesai</span>";
                                                    } else {
                                                        echo "<span class='badge rounded-pill bg-danger'>Transaksi Pending</span>";
                                                    }

                                                    ?></li>
                                        </ul>




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