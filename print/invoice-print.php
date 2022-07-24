 <!DOCTYPE html>
 <html lang="en">

 <head>
     <title>INVOICE <?= time() ?></title>
     <style>
     body {

         font-family: Arial, Helvetica, sans-serif;
     }
     </style>

 </head>

 <body>
     <?php
        include "../env.php";
        session_start();
        if (isset($_SESSION['userLogin'])) {
            $id_pembelian = intval($_POST['id']);
            $get_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE id=$id_pembelian");
            if (mysqli_num_rows($get_cart) < 1) {
                echo "<script>location='../../';</script>";
            } else {
                $cart = mysqli_fetch_assoc($get_cart);
                $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM customer WHERE id=$cart[user_id] "));
            }


        ?>
     <center>
         <h1>INVOICE <br>
             <b><?= $cart['kode'] ?></b>
         </h1>
     </center>

     <table width="100%">
         <tr>
             <td>
                 <ul style="list-style:none;padding:0;margin:0">
                     <li><b><?= $user['nama'] ?></b></li>
                     <li><?= $user['user_email'] ?></li>
                     <li><?= $user['user_hp'] ?></li>

                     <li>Tgl.Transaksi : <?= date('d/m/Y H:i:s', strtotime($cart['wkt'])) ?></li>
                     <li><b>Total Belanja : Rp. <?= number_format($cart['jumlah_total']) ?></b>
                     </li>
                 </ul>
             </td>

         </tr>
     </table>
     <hr style="border: 1px dotted;">

     <table width="100%" border="1px" celpadding="3" style="border-collapse:collapse;font-size:12px">
         <thead>
             <tr>
                 <th>No</th>
                 <th>Produk</th>
                 <th>Harga</th>
                 <th>Jumlah</th>
                 <th>Sub Total</th>
             </tr>
         </thead>
         <tbody>
             <?php
                    $totalBelanja = 0;
                    $no = 1;
                    $produk = mysqli_query($con, "SELECT tm_produk.kode, tm_produk.nm_produk, tm_produk.gambar, cart_detail.harga_beli, cart_detail.jumlah, cart_detail.sub_total FROM `cart_detail` JOIN tm_produk ON cart_detail.produk_id=tm_produk.id WHERE cart_detail.cart_id=$id_pembelian ORDER BY cart_detail.id ASC ");
                    foreach ($produk as $s) {
                    ?>
             <tr>
                 <td><?= $no++ ?></td>
                 <td> <?= $s['nm_produk'] ?> </td>
                 <td>Rp. <?= number_format($s['harga_beli']) ?></td>
                 <td><?= $s['jumlah'] ?></td>
                 <td>Rp. <?= number_format($s['sub_total']) ?></td>

             </tr>

             <?php
                        $totalBelanja += $s['sub_total'];
                    } ?>
             <tr>
                 <td colspan="5" align="center">
                     Jumlah yang harus dibayarkan : <b> Rp.
                         <?= number_format($totalBelanja) ?></b>
                 </td>
             </tr>
         </tbody>
     </table>
     <p>
     <div style="border: 1px dotted;padding:5px">
         STATUS : <?php
                        if ($cart['status'] == 'new') {
                            echo "<b>Belum Konfirmasi Pembayaran</b>";
                        } else {
                            echo "<b>" . $cart['status'] . "</b>";
                        }

                        ?>
     </div>
     </p>
     <p>

     <ul style="list-style:none;padding:0;margin:0">
         <li>Provinsi : <b><?= $user['prov'] ?></b></li>
         <li>Kab : <?= $user['kab'] ?></li>
         <li>Alamat : <?= $user['alamat'] ?></li>
     </ul>
     </p>
     <p>
     <div>
         <ul style="list-style: none;font-size:12px">
             <li><b>SISTEM TRANSFER</b></li>
             <ul>
                 <li>Anda harus membayar dengan cara transfer Sejumlah <b> Rp.
                         <?= number_format($totalBelanja) ?></b> ke salah satu Rekening
                     dibawah
                     ini.</li>
                 <li>
                     <b>BRI
                         Norek : 787301003830533 / AN : Susi Rahmatul Fitri
                     </b>
                 </li>
                 <li>
                     <b>MANDIRI
                         Norek : 65322232 / AN : Mulyadi
                     </b>
                 </li>
                 <li>Setelah anda melakukan Pembayaran, Konfirmasi pembayaran kepda admin
                     kami /
                     melalui tombol Konfirmasi Pembayaran. Setelah Konfirmasi pembayaran
                     valid
                     kami akan mengirimkan pesanan anda.</li>
             </ul>
             <li><b>PEMBAYARAN TUNAI</b></li>
             <ul>
                 <li>Untuk anda yang berada di wilayah bukittinggi dan sekitarnya Sistem pembayaran bisa lansung atau
                     kami jemput sekaligus mengantar pesanan anda / COD (Cash On Delivery)
                 </li>
             </ul>
         </ul>
     </div>
     </p>
     <div style="border: 1px dotted;padding:5px">
         CONTACT : <br>
         Alamat : Jl.Parit Putus No.41 (Samping Amelia Cafe) Bukittinggi<br>
         Phone 1 : 082129869908 <br>
         Phone 2 : 082257461369
     </div>
     </p>
     <?php
        } else {
            echo "<script>location='login.php';</script>";
        }

        ?>




 </body>
 <script>
window.print();
 </script>

 </html>