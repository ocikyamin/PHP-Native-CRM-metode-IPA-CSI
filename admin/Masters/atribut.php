<div class="pagetitle">
      <h1>Atribut</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Masters</li>
          <li class="breadcrumb-item active">Atribut</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List Atribut</h5>
<p>
  <a href="#" data-bs-toggle="modal" data-bs-target="#tambah-data" class="btn btn-primary"><i class="bx bxs-file-plus me-1"></i> Add</a>
</p>
              <div class="table-responsive">
                   <table class="table datatable table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Atribut</th>
                    <th scope="col"><i class="bx bxs-cog"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  $listAtribut = mysqli_query($con,"SELECT * FROM tm_atribut ORDER BY id ASC");
                  foreach ($listAtribut as $a) {
                  ?>
                  <tr>
                  <th scope="row"> <?= $i++ ?>. </th>
                  <td><?= $a['kode'] ?></td>
                  <td><?= $a['atribut'] ?></td>
                  <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit-<?=$a['id']?>" class="btn btn-success"><i class="bx bxs-comment-edit me-1"></i></a>
                    <form method="post" style="display: inline;">
                      <input type="hidden" name="id" value="<?= $a['id'] ?>">
                      <button type="submit" name="del" class="btn btn-danger" onclick="return confirm('Apakah Yakin ?')"><i class="bx bx-trash-alt me-1"></i></button></form>

<div class="modal fade" id="edit-<?=$a['id']?>" tabindex="-1" data-bs-backdrop="false">
<div class="modal-dialog modal-lg">
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
  <div class="form-group mb-2">
    <label for="kode">Kode</label>
    <input type="text" name="kode" id="kode" class="form-control" value="<?=$a['kode']?>" required>
  </div>
  <div class="form-group">
    <label for="atribut"> Nama Atribut </label>
    <input type="text" name="atribut" id="atribut" class="form-control" value="<?=$a['atribut']?>" required>
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
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title">
    Tambah Data
  </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="post">
<div class="modal-body">

  <div class="form-group mb-2">
    <label for="kode">Kode</label>
    <input type="text" name="kode" id="kode" class="form-control" placeholder="Kode" required>
  </div>
  <div class="form-group">
    <label for="atribut"> Nama Atribut </label>
    <input type="text" name="atribut" id="atribut" class="form-control" placeholder="Nama Atribut" required>
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
$delete = mysqli_query($con,"DELETE FROM `tm_atribut` WHERE id=$id ");
if ($delete) {
echo "<script>
alert('Deleted Suscess');
window.location='?/=".$_GET['/']."';
</script> ";
}
}

// add
if (isset($_POST['add'])) {

$kode    = addslashes($_POST['kode']);
$atribut = htmlspecialchars(addslashes($_POST['atribut']));

$save = mysqli_query($con,"INSERT INTO `tm_atribut`(`kode`, `atribut`) VALUES ('$kode','$atribut')");
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
$kode    = addslashes($_POST['kode']);
$atribut = htmlspecialchars(addslashes($_POST['atribut']));
$edit = mysqli_query($con,"UPDATE `tm_atribut` SET kode='$kode', atribut='$atribut' WHERE id=$id  ");
if ($edit) {
echo "<script>
alert('Updated Suscess');
window.location='?/=".$_GET['/']."';
</script> ";
}
}

?>
