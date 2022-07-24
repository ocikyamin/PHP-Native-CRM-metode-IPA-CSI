<div class="pagetitle">
      <h1>Responden</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">CRM</li>
          <li class="breadcrumb-item active">Responden</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List Responden</h5>
              <p>
<form method="post" action="../report/responden/" target="_blank" style="display: inline;">
<button type="submit" name="print" class="btn btn-warning"><i class="bx bx-printer me-1"></i> Print</button>
<!-- <button type="submit" name="print" class="btn btn-success"><i class="bx bxs-file-export me-1"></i> Ekport To Excel</button> -->
</form> 
              </p>	
      <div class="table-responsive">
                   <table class="table datatable table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Responden</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Pendidikan</th>
                    <th scope="col">Pekerjaan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  $listResponden = mysqli_query($con,"SELECT customer.nama,customer.jk,tm_education.education_level,tm_job.job_name
                  	FROM skors
                   JOIN customer ON skors.user_id=customer.id
                   JOIN tm_education ON customer.education_id=tm_education.id
                   JOIN tm_job ON customer.job_id=tm_job.id
                    GROUP BY skors.user_id ORDER BY skors.id ASC ");
                  $jmlResponden = mysqli_num_rows($listResponden);
                  foreach ($listResponden as $a) {
                  ?>
                  <tr>
                  <th scope="row"> <?= $i++ ?>. </th>
                  <td><?= $a['nama'] ?></td>
                  <td><?= $a['jk'] ?></td>
                  <td><?= $a['education_level'] ?></td>
                  <td><?= $a['job_name'] ?></td>
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
      <div class="row">
			<div class="col-lg-12">
			<div class="card">
			<div class="card-body">
			<h5 class="card-title">Jumlah Responden Menurut Jenis Kelamin</h5>
			<div class="table-responsive">
			<table class="table table-sm">
			<thead>
			<tr>
			<th scope="col">Jenis Kelamin</th>
			<th scope="col">Jumlah (Responden)</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$listResponden = mysqli_query($con,"SELECT customer.nama,customer.jk FROM skors JOIN customer ON skors.user_id=customer.id GROUP BY customer.jk ORDER BY skors.id ASC ");
			foreach ($listResponden as $jk) {
				$jg = mysqli_num_rows(mysqli_query($con,"SELECT * FROM skors JOIN customer ON skors.user_id=customer.id WHERE customer.jk='$jk[jk]'  GROUP BY user_id"));
			    ?>
			    	<tr>
			<td><?= $jk['jk'] ?> <?php if ( $jk['jk']=='P') { echo '( Perempuan )';}else{ echo '( Laki-laki )'; } ?> </td>
			<td><?= $jg ?></td>
			</tr>
			    <?php
			}
			?>
		
			<tr>
			<td>Total</td>
			<td><?= $jmlResponden ?></td>
			</tr>


			</tbody>
			</table>
			</div>
			</div>
			</div>

			</div>
			<!-- col 2 -->
			<div class="col-lg-12">
			<div class="card">
			<div class="card-body">
			<h5 class="card-title">Jumlah Responden Menurut Tingkat Pendidikan</h5>
			<div class="table-responsive">
					<table class="table table-sm">
					<thead>
					<tr>
					<th scope="col">Pendidikan</th>
					<th scope="col">Jumlah (Responden)</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$listRespondenPendidikan = mysqli_query($con,"SELECT tm_education.id,tm_education.education_level FROM skors
					JOIN customer ON skors.user_id=customer.id
					JOIN tm_education ON customer.job_id=tm_education.id
					GROUP BY tm_education.id ORDER BY skors.id ASC ");
					foreach ($listRespondenPendidikan as $p) {
					$je = mysqli_num_rows(mysqli_query($con,"SELECT * FROM skors JOIN customer ON skors.user_id=customer.id WHERE customer.education_id='$p[id]'  GROUP BY user_id"));
					?>
					<tr>
					<td> <?= $p['education_level'] ?> </td>
					<td> <?= $je ?> </td>
					</tr>
					<?php
					}

					?>
					<tr>
					<td>Total</td>
					<td><?= $jmlResponden ?></td>
					</tr>
					</tbody>
					</table>
			</div>
			</div>
			</div>

			</div>
			<!-- col 3 -->
			<div class="col-lg-12">
			<div class="card">
			<div class="card-body">
			<h5 class="card-title">Jumlah Responden Menurut Pekerjaan</h5>
			<div class="table-responsive">
					<table class="table table-sm">
					<thead>
					<tr>
					<th scope="col">Pekerjaan</th>
					<th scope="col">Jumlah (Responden)</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$listRespondenPekerjaan = mysqli_query($con,"SELECT tm_job.id,tm_job.job_name
					FROM skors
					JOIN customer ON skors.user_id=customer.id
					JOIN tm_job ON customer.job_id=tm_job.id
					GROUP BY tm_job.id ORDER BY skors.id ASC ");
					foreach ($listRespondenPekerjaan as $j) {
					$jj = mysqli_num_rows(mysqli_query($con,"SELECT * FROM skors JOIN customer ON skors.user_id=customer.id WHERE customer.job_id='$j[id]'  GROUP BY user_id"));
					?>
					<tr>
					<td> <?= $j['job_name'] ?> </td>
					<td> <?= $jj ?> </td>
					</tr>
					<?php
					}

					
					?>
					<tr>
					<td>Total</td>
					<td><?= $jmlResponden ?></td>
					</tr>
					</tbody>
					</table>
			</div>
			</div>
			</div>

			</div>


      </div>
    </section>
