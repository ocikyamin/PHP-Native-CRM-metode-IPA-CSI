<?php 
// master atribut
$sqlAtribut = mysqli_query($con,"SELECT * FROM tm_atribut ORDER BY id ASC ");
$jmlAtribut = mysqli_num_rows($sqlAtribut);

 ?>
 <div class="pagetitle">
      <h1>Skor Analisis</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">CRM</li>
          <li class="breadcrumb-item active">Analysis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Perhitungan Importance Performance Analysis (IPA)</h5>     
              <p>
	<form method="post" action="../report/analis/" target="_blank" style="display: inline;">
	<button type="submit" name="print" class="btn btn-secondary"><i class="bx bx-printer me-1"></i> Print</button>
	</form> 
	<!-- <button type="submit" name="del" class="btn btn-success"><i class="bx bxs-file-export me-1"></i> Ekport To Excel</button> -->
<form method="post"style="display: inline;">
<button type="submit" name="delAll" class="btn btn-danger" onclick="return confirm('Apakah Yakin ?')"><i class="bx bx-trash-alt me-1"></i> Kosongkan Tabel</button>
</form>
<?php 
// koseongkan table skors
if (isset($_POST['delAll'])) {
	$delSkors = mysqli_query($con,"DELETE FROM `skors`");
	$delUsers = mysqli_query($con,"DELETE FROM `customer`");
	   echo " <script>
   alert('Table Telah dikosongkan');
   window.location='?/=analyze';
 </script>"; 

}
 ?>

              </p>         

<?php 
$type= array('Kepuasan','Kepentingan');
foreach ($type as $tipe) {
?>
<p>
Skor : <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <b><?= $tipe ?></b></span> 
</p>
<div class="table-responsive">
<table class="table table-sm">
<thead>
<tr class="table-dark">
<th>No</th>
<th>Responden</th>
<!-- buat kolom atribut 1 ++ -->
<?php for ($i = 1; $i <$jmlAtribut+1 ; $i++) {echo "<th>".'A '.$i."</th>";}?>
</tr>
</thead>
<tbody>
<?php 
// list data customer
$no=1;
$listResponden = mysqli_query($con,"SELECT skors.*, customer.nama FROM skors JOIN customer ON skors.user_id=customer.id WHERE skors.type='$tipe' GROUP BY skors.user_id ORDER BY skors.id ASC ");
foreach ($listResponden as $r) {
	?>
<tr>
<td> <?= $no++ ?>. </td>
<td> <?= $r['nama'] ?> </td>
<?php 
for ($i = 1; $i <$jmlAtribut+1 ; $i++) {
$d=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM skors WHERE atribut_id='$i' AND user_id='$r[user_id]' AND type='$tipe' ORDER BY atribut_id ASC "));
echo "<td align='center'><span>".$d['skor']."</span></td>";
}
?>

</tr>
<?php } ?>
<tr>
<td></td>
<td></td>
<?php 
for ($i = 1; $i <$jmlAtribut+1 ; $i++) {
$d=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(skor) AS jumlah FROM skors WHERE atribut_id='$i' AND type='$tipe' ORDER BY atribut_id ASC "));
echo "<td align='center'><b>".$d['jumlah']."</b></td>";
}
?>

</tr>
</tbody>

</table>
</div>
<?php

}

?>	
<!-- <h5 class="card-title">Menghitung Tingkat Kesesuaian dan Keputusan Hold (H) & Action (A)</h5> -->
	<div class="alert alert-info  alert-dismissible fade show mt-3" role="alert">
	<h4 class="alert-heading">Menghitung Tingkat Kesesuaian dan Keputusan Hold (H) & Action (A)</h4>
	<p>Ketentuan Keputusan Hold (H) & Action (A)</p>
	<hr>
	<p class="mb-0">
	<ul>
	<li>a. <b>< 89</b> maka dilakukan perbaikan /action (A)</li>
	<li>b. <b>≥ 89</b> maka dilakukan usaha untuk mempertahankan prestasi</li>
	</ul>
	</p>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<div class="table-responsive">
<table class="table table-dark table-sm">
<thead>
<tr>
<!-- buat kolom atribut 1 ++ -->
<?php for ($i = 1; $i <$jmlAtribut+1 ; $i++) {echo "<th>".'A'.$i."</th>";}?>
</tr>
</thead>
<tbody>
<tr>
<?php 
error_reporting(0);
for ($i = 1; $i <$jmlAtribut+1 ; $i++) {
$skorKepuasan=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(skor) AS jumlah FROM skors WHERE atribut_id='$i' AND type='Kepuasan' ORDER BY atribut_id ASC "));
$skorKepentingan=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(skor) AS jumlah FROM skors WHERE atribut_id='$i' AND type='Kepentingan' ORDER BY atribut_id ASC "));
// echo "<td><h1><b>".$skorKepuasan['jumlah']/$skorKepentingan['jumlah']*100."</b></h1></td>";
?>
<td align="center">
<?php 
$jml = $skorKepuasan['jumlah']/$skorKepentingan['jumlah']*100;
echo number_format($jml,3);
?>
</td>
<?php
}
?>

</tr>
<tr>
<?php 
for ($i = 1; $i <$jmlAtribut+1 ; $i++) {
$skorKepuasan=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(skor) AS jumlah FROM skors WHERE atribut_id='$i' AND type='Kepuasan' ORDER BY atribut_id ASC "));
$skorKepentingan=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(skor) AS jumlah FROM skors WHERE atribut_id='$i' AND type='Kepentingan' ORDER BY atribut_id ASC "));
?>
<td align="center">
<?php 
$jml = $skorKepuasan['jumlah']/$skorKepentingan['jumlah']*100;

if ($jml <89) {
echo '<b class="text-warning">A</b>';
}elseif ($jml >=89) {
echo 'H';
}

?>

</td>
<?php
}
?>
</tr>
</tbody>
</table>
</div>

		<p>
		<h5 class="card-title">Menghitung Rata-Rata Tingkat Kepentingan dan Tingkat Kepuasan</h5> 
		</p>
		<div class="table-responsive">
<table class="table table-sm">
<thead>
<tr>
<th>No</th>
<th>Atribut</th>
<th>Rata-rata Kepentingan</th>
<th>Rata-rata Kepuasan</th>
</thead>
<tbody>
</tr>
<?php 
// list data customer
$totalKepentingan=0;
$totalKeputusan=0;
$no=1;
$listAtribut = mysqli_query($con,"SELECT skors.*, tm_atribut.kode,tm_atribut.atribut FROM skors JOIN tm_atribut ON skors.atribut_id=tm_atribut.id GROUP BY skors.atribut_id ORDER BY skors.atribut_id ASC ");
if (mysqli_num_rows($listAtribut) < 1) {
echo "<td>Belum ada data</td>";
}
foreach ($listAtribut as $r) {
$skorKepentingan=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(skor) AS jumlah FROM skors WHERE atribut_id='$r[atribut_id]' AND type='Kepentingan' "));
$skorKepuasan=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(skor) AS jumlah FROM skors WHERE atribut_id='$r[atribut_id]' AND type='Kepuasan' "));
?>
<tr>
<td><?= $no++ ?>. </td>
<td> <?= $r['atribut'] ?> </td>
<td><?=number_format($skorKepentingan['jumlah']/100,2)?></td>
<td><?=number_format($skorKepuasan['jumlah']/100,2);?></td>
</tr>
<?php 
$totalKepentingan += $skorKepentingan['jumlah'];
$totalKeputusan += $skorKepuasan['jumlah'];

} ?>
<tr>
<td colspan="2">Total</td>
<td><?=number_format($totalKepentingan/100,2);?></td>
<td><?=number_format($totalKeputusan/100,2);?></td>
</tr>
</tbody>
</table>
</div>


		<p>
		<!-- <h3>3. Perhitungan Manual CSI</h3> -->
		<div class="alert alert-success  alert-dismissible fade show mt-3" role="alert">
		<h4 class="alert-heading">Hasil Perhitungan Customer Satisfaction Index (CSI)</h4>
		<p>Perhitungan CSI didapat dari nilai rataan tingkat kepentingan dan nilai rataan tingkat pelaksanaan kinerja dari masing-masing bobot.</p>
		<hr>
		<p class="mb-0">
		Berikut Hasil Perhitungan Customer Satisfaction Index (CSI)
		</p>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		</p>
<div class="table-responsive">
<table class="table table-sm">
<thead>
<tr>
<th>No</th>
<th>Atribut</th>
<th>Rata-rata Kepentingan</th>
<th>WF %</th>
<th>Rata-rata Kepuasan</th>
<th>WS</th>
</tr>
</thead>
<tbody>
<?php 
// list data customer
$no=1;
$ikp =0;
$listAtribut = mysqli_query($con,"SELECT skors.*, tm_atribut.kode,tm_atribut.atribut FROM skors JOIN tm_atribut ON skors.atribut_id=tm_atribut.id GROUP BY skors.atribut_id ORDER BY skors.atribut_id ASC ");
$jmlAtribut= mysqli_num_rows($listAtribut);
if ($listAtribut< 1) {
echo "<td>Belum ada data</td>";
}
foreach ($listAtribut as $r) {
$skorKepentingan=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(skor) AS jumlah FROM skors WHERE atribut_id='$r[atribut_id]' AND type='Kepentingan' "));
$skorKepuasan=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(skor) AS jumlah FROM skors WHERE atribut_id='$r[atribut_id]' AND type='Kepuasan' "));

$wf    = $skorKepentingan['jumlah']/0.56;
$twf   = number_format($wf/100,2);
$tpuas = number_format($skorKepuasan['jumlah']/100,2);
$ws    = number_format($twf*$tpuas);
?>
</tr>
<td><?= $no++ ?>. </td>
<td> <?= $r['kode'] ?> </td>
<td><?=number_format($skorKepentingan['jumlah']/100,2);?></td>
<td><?=number_format($wf/100,2)?></td>
<td><?= number_format($skorKepuasan['jumlah']/100,2);?></td>
<td><?=number_format($ws,2)?></td>
<tr>
<?php 
$ikp += $ws;
} ?>
<tr>
<td colspan="5"><b>Total</b></td>
<td>
	<?php 
	$totalWS = floor($ikp);
	echo round($totalWS); 

	 ?>

</td>
</tr>
<tr>
<td colspan="5"><b>IKP (Indek Kepuasan Pelanggan )</b></td>
<td>
	<?php $totalIKP = number_format($totalWS/5);?>
	
	<?php
	$totalWS = number_format($totalIKP,3);
	// echo number_format($totalWS,2);
	echo number_format($totalWS,3);

	// echo ceil($final);


	
	?>
	
	</td>
</tr>
</tbody>

</table>


<p>
	<div class="row">
		<div class="col-lg-4">
			<p>
				<h5 class="card-title">Skala Kriteria Customer Satisfaction Index</h5> 
			</p>
			<img src="../public/assets/img/Gambar2.png" alt="">
		</div>
				<div class="col-lg-8">
			
		<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show mt-3" role="alert">
		<h4 class="alert-heading">Kesimpulan</h4>
		<p>
		Berdasarkan dari hasil tabel perhitungan yang telah dilakukan menggunakan CSI dapat diketahui bahwa indeks kepuasan pelanggan terhadap peningkatan penjualam gorden sebesar <b><?= number_format($totalIKP,3) ?></b>  % jika dibulatkan menjadi <b><?= number_format($totalIKP,0) ?></b>  %. Dapat dikatakan bahwa tingkat kepuasan pelanggan disana secara umum berada pada kategori 
<b>		<?php 
		
		    if (totalIKP == "") {
                echo "";
            } else if ($totalIKP >= 0 && $totalIKP <= 34) {
                echo 'TIDAK PUAS';
            } else if ($totalIKP >= 35 && $totalIKP <= 50) {
                echo 'KURANG PUAS';
            } else if ($totalIKP >= 51 && $totalIKP <= 65) {
                echo 'CUKUP PUAS';
            } else if ($totalIKP >= 66 && $totalIKP <= 80) {
                echo 'PUAS';
            } else if ($totalIKP >= 81) {
                echo 'SANGAT PUAS';
            }
		
	

		 ?></b>

	
		</p>

		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>


		</div>
	</div>
		<!-- <h3>3. Perhitungan Manual CSI</h3> -->

		</p>
</div>


</div>
</div>
</div>
</div>
</div>
</section>





