<div class="pagetitle">
      <h1>Pekerjaan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Masters</li>
          <li class="breadcrumb-item active">Pekerjaan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List Pekerjaan</h5>
<p>
  <a href="#" data-bs-toggle="modal" data-bs-target="#tambah-data" class="btn btn-primary"><i class="bx bxs-file-plus me-1"></i> Add</a>
</p>
              <div class="table-responsive">
                   <table class="table datatable table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col"><i class="bx bxs-cog"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  $listPekerjaan = mysqli_query($con,"SELECT * FROM tm_job ORDER BY id ASC");
                  foreach ($listPekerjaan as $a) {
                  ?>
                  <tr>
                  <th scope="row"> <?= $i++ ?>. </th>
                  <td><?= $a['job_name'] ?></td>
                  <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit-<?=$a['id']?>" class="btn btn-success"><i class="bx bxs-comment-edit me-1"></i></a>
                    <form method="post" style="display: inline;">
                      <input type="hidden" name="id" value="<?= $a['id'] ?>">
                      <button type="submit" name="del" class="btn btn-danger" onclick="return confirm('Apakah Yakin ?')"><i class="bx bx-trash-alt me-1"></i></button></form>

<div class="modal fade" id="edit-<?=$a['id']?>" tabindex="-1" data-bs-backdrop="false">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title">
    Edit Data
  </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="post">
  <input type="hidden" name="id" value="<?=$a['id']?>">
<div class="modal-body">
  <div class="form-group">
    <label for="job_name"> Nama Atribut </label>
    <input type="text" name="job" id="job_name" class="form-control" value="<?=$a['job_name']?>" required>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  <button type="submit" name="edit" class="btn btn-success">Update</button>
</div>
</form>
</div>
</div>
</div>



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

<div class="modal fade" id="tambah-data" tabindex="-1" data-bs-backdrop="false">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title">
    Tambah Data
  </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="post">
<div class="modal-body">
  <div class="form-group">
    <label for="job"> Nama Pekerjaan </label>
    <input type="text" name="job" id="job" class="form-control" placeholder="Ex : Dosen" required="" autofocus>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  <button type="submit" name="add" class="btn btn-primary">Save</button>
</div>
</form>
</div>
</div>
</div>
<!-- End Disabled Backdrop Modal-->

<?php   

// script PHP Atribut
// delete record
if (isset($_POST['del'])) {
  $id = intval($_POST['id']);
$delete = mysqli_query($con,"DELETE FROM `tm_job` WHERE id=$id ");
if ($delete) {
echo "<script>
alert('Deleted Suscess');
window.location='?/=".$_GET['/']."';
</script> ";
}
}

// add
if (isset($_POST['add'])) {

$job = addslashes($_POST['job']);

$save = mysqli_query($con,"INSERT INTO `tm_job`(`job_name`) VALUES ('$job')");
if ($save) {
echo "<script>
alert('Inserted Suscess');
window.location='?/=".$_GET['/']."';
</script> ";
}
}

// edit
if (isset($_POST['edit'])) {
$id = intval($_POST['id']);
$job = htmlspecialchars(addslashes($_POST['job']));
$edit = mysqli_query($con,"UPDATE `tm_job` SET job_name='$job' WHERE id=$id  ");
if ($edit) {
echo "<script>
alert('Updated Suscess');
window.location='?/=".$_GET['/']."';
</script> ";
}
}


?>
