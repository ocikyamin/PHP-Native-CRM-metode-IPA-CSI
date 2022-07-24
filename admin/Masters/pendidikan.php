<div class="pagetitle">
      <h1>Pendidikan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Masters</li>
          <li class="breadcrumb-item active">Pendidikan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List Pendidikan</h5>
<p>
  <a href="#" data-bs-toggle="modal" data-bs-target="#tambah-data" class="btn btn-primary"><i class="bx bxs-file-plus me-1"></i> Add</a>
</p>
              <div class="table-responsive">
                   <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Jenjang Pendidikan</th>
                    <th scope="col"><i class="bx bxs-cog"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  $listPendidikan = mysqli_query($con,"SELECT * FROM tm_education ORDER BY id ASC");
                  foreach ($listPendidikan as $a) {
                  ?>
                  <tr>
                  <th scope="row"> <?= $i++ ?>. </th>
                  <td><?= $a['education_level'] ?></td>
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
                    <label for="education"> Jenjang Pendidkan </label>
                    <input type="text" name="educate" id="education" class="form-control" value="<?=$a['education_level']?>" required>
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
    <label for="educate"> Jenjang Pendidkan </label>
    <input type="text" name="educate" id="educate" class="form-control" autofocus="on" placeholder="Ex : S1" required>
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
$delete = mysqli_query($con,"DELETE FROM `tm_education` WHERE id=$id ");
if ($delete) {
echo "<script>
alert('Deleted Suscess');
window.location='?/=".$_GET['/']."';
</script> ";
}
}

// add
if (isset($_POST['add'])) {
$education = addslashes($_POST['educate']);
$save = mysqli_query($con,"INSERT INTO `tm_education`(`education_level`) VALUES ('$education')");
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
$educate = htmlspecialchars(addslashes($_POST['educate']));
$edit = mysqli_query($con,"UPDATE `tm_education` SET education_level='$educate' WHERE id=$id  ");
if ($edit) {
echo "<script>
alert('Updated Suscess');
window.location='?/=".$_GET['/']."';
</script> ";
}
}


?>
