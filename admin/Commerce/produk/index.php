<div class="pagetitle">
    <h1>Produk</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Masters</li>
            <li class="breadcrumb-item active">Produk</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Produk</h5>
                    <p>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah-data" class="btn btn-primary"><i
                                class="bx bxs-file-plus me-1"></i> Add</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table datatable table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col"><i class="bx bxs-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $produk = mysqli_query($con, "SELECT * FROM tm_produk ORDER BY id ASC");
                                foreach ($produk as $p) {
                                ?>
                                <tr>
                                    <th scope="row"> <?= $i++ ?>. </th>
                                    <td><?= $p['kode'] ?></td>
                                    <td><?= $p['nm_produk'] ?></td>
                                    <td><?= $p['harga'] ?></td>
                                    <td><?php if ($p['jml_stok'] == 0) {
                                                echo "<span class='badge bg-danger'>Stok Habis</span>";
                                            } else {
                                                echo $p['jml_stok'];
                                            } ?></td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#stok-<?= $p['id'] ?>"
                                            class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit-<?= $p['id'] ?>"
                                            class="btn btn-success"><i class="bi bi-pencil me-1"></i></a>

                                        <a href="#" data-bs-toggle="modal" data-bs-target="#gambar-<?= $p['id'] ?>"
                                            class="btn btn-warning"><i class="bi bi-image-alt me-1"></i></a>
                                        <form method="post" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                            <input type="hidden" name="oldimg" value="<?= $p['gambar'] ?>">
                                            <button type="submit" name="del" class="btn btn-danger"
                                                onclick="return confirm('Apakah Yakin ?')"><i
                                                    class="bx bx-trash-alt me-1"></i></button>
                                        </form>
                                        <div class="modal fade" id="stok-<?= $p['id'] ?>" tabindex="-1"
                                            data-bs-backdrop="false">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <b><i class="bi bi-plus-circle"></i> Re Stok Produk</b>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                        <div class="modal-body">
                                                            <div class="alert alert-info">
                                                                <h2>
                                                                    Jumlah Stok Saat Ini : <b><?= $p['jml_stok'] ?></b>
                                                                </h2>
                                                            </div>

                                                            <div class="form-group mb-2">
                                                                <label for="stok">Jumlah Stok</label>
                                                                <input type="number" name="new_jml_stok" id="stok"
                                                                    class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="re_stok"
                                                                class="btn btn-primary">Re Stok</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="gambar-<?= $p['id'] ?>" tabindex="-1"
                                            data-bs-backdrop="false">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <b><i class="bi bi-image"></i> Gambar Produk</b>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                        <input type="hidden" name="oldimg" value="<?= $p['gambar'] ?>">
                                                        <div class="modal-body">
                                                            <p>
                                                                <img src="../public/product/<?= $p['gambar'] ?>"
                                                                    class="img-thumbnail"
                                                                    style="min-height:420px; min-width:750px;height:420px;width:750px;">
                                                            </p>

                                                            <div class="form-group mb-2">
                                                                <label for="images">Pilih Gambar</label>
                                                                <input type="file" name="file" id="images"
                                                                    class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="replace_img"
                                                                class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="edit-<?= $p['id'] ?>" tabindex="-1"
                                            data-bs-backdrop="false">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <b><i class="bi bi-pencil"></i> Edit Produk</b>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post">
                                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                        <div class="modal-body">

                                                            <div class="form-group mb-2">
                                                                <label for="kode">Kode Produk</label>
                                                                <input type="text" name="kode" id="kode"
                                                                    class="form-control" value="<?= $p['kode'] ?>"
                                                                    required>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="nm_produk"> Nama Produk </label>
                                                                <input type="text" name="nm_produk" id="nm_produk"
                                                                    class="form-control" value="<?= $p['nm_produk'] ?>"
                                                                    required>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="harga"> Harga Produk </label>
                                                                <input type="number" name="harga" id="harga"
                                                                    class="form-control" value="<?= $p['harga'] ?>"
                                                                    required>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="stok"> Jumlah Stok </label>
                                                                <input type="number" name="stok" id="stok"
                                                                    class="form-control" value="<?= $p['jml_stok'] ?>"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="deskripsi"> Deskripsi Produk </label>
                                                                <textarea type="text" name="deskripsi" id="deskripsi"
                                                                    class="form-control"><?= $p['deskripsi'] ?></textarea>
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="edit"
                                                                class="btn btn-primary">Update</button>
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
                    <b><i class="bi bi-plus-circle"></i> Tambah Produk</b>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">

                    <div class="form-group mb-2">
                        <label for="kode">Kode Produk</label>
                        <input type="text" name="kode" id="kode" class="form-control" placeholder="Kode" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="nm_produk"> Nama Produk </label>
                        <input type="text" name="nm_produk" id="nm_produk" class="form-control"
                            placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="harga"> Harga Produk </label>
                        <input type="number" name="harga" id="harga" class="form-control" placeholder="Rp.****"
                            required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="stok"> Jumlah Stok </label>
                        <input type="number" name="stok" id="stok" class="form-control" placeholder="0" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi"> Deskripsi Produk </label>
                        <textarea type="text" name="deskripsi" id="deskripsi" class="form-control"
                            placeholder="Description"></textarea>
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
    $oldImg = $_POST['oldimg'];

    $delete = mysqli_query($con, "DELETE FROM `tm_produk` WHERE id=$id ");
    if ($delete) {
        $fimg = '../public/product/' . $oldImg;
        unlink("$fimg");
        echo "<script>
alert('Deleted Suscess');
window.location='?/=" . $_GET['/'] . "';
</script> ";
    }
}

// add
if (isset($_POST['add'])) {

    $kode    = addslashes($_POST['kode']);
    $nm_produk = $_POST['nm_produk'];
    $harga = $_POST['harga'];
    $jml_stok = $_POST['stok'];
    $deskripsi = htmlspecialchars(addslashes($_POST['deskripsi']));


    $save = mysqli_query($con, "INSERT INTO 
    `tm_produk`(`kode`, `nm_produk`, `harga`, `jml_stok`, `deskripsi`)
     VALUES ('$kode','$nm_produk','$harga','$jml_stok','$deskripsi')");
    if ($save) {
        echo "<script>
    alert('Inserted Suscess');
    window.location='?/=" . $_GET['/'] . "';
    </script> ";
    }
}


// edit

if (isset($_POST['edit'])) {

    $id = intval($_POST['id']);
    $kode    = addslashes($_POST['kode']);
    $nm_produk = $_POST['nm_produk'];
    $harga = $_POST['harga'];
    $jml_stok = $_POST['stok'];
    $deskripsi = htmlspecialchars(addslashes($_POST['deskripsi']));


    $edit = mysqli_query($con, "UPDATE 
    `tm_produk` SET `kode`='$kode', `nm_produk`='$nm_produk', `harga`='$harga', `jml_stok`='$jml_stok', `deskripsi`='$deskripsi' WHERE id=$id ");
    $edit = mysqli_query($con, "UPDATE `tm_atribut` SET kode='$kode', atribut='$atribut' WHERE id=$id  ");
    if ($edit) {
        echo "<script>
alert('Updated Suscess');
window.location='?/=" . $_GET['/'] . "';
</script> ";
    }
}

// upload gambar 
if (isset($_POST['replace_img'])) {

    $allowed_ext = array('jpg', 'jpeg', 'png', 'pdf');
    $file_name   = $_FILES['file']['name'];
    @$file_ext   = strtolower(end(explode('.', $file_name)));
    $file_size   = $_FILES['file']['size'];
    $file_tmp    = $_FILES['file']['tmp_name'];
    $id = $_POST['id'];
    $oldImg = $_POST['oldimg'];
    $kodefile    = 'IMG-' . time();
    $dok = $kodefile . '.' . $file_ext;
    if (in_array($file_ext, $allowed_ext) === true) {
        if ($file_size < 3044070) {
            $lokasi = '../public/product/' . $kodefile . '.' . $file_ext;
            move_uploaded_file($file_tmp, $lokasi);
            $in = mysqli_query($con, "UPDATE `tm_produk` SET `gambar`='$dok' WHERE id=$id");
            if ($in) {
                $fimg = '../public/product/' . $oldImg;
                unlink("$fimg");
                echo "<script>
                                                alert('Image Uploaded');
                                                window.location='?/=" . $_GET['/'] . "';
                                                </script>";
            } else {
                // $msg = ['error' => 'Gagal Mengunggah File'];
                echo "<script>
                                                alert('Gagal Mengunggah File');
                                                window.location='?/=" . $_GET['/'] . "';
                                                </script>";
            }
        } else {
            echo "<div class='alert alert-danger'>Besar ukuran file (file size) maksimal 2 Mb!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Ekstensi file tidak di izinkan!</div>";
    }
}

if (isset($_POST['re_stok'])) {
    var_dump($_POST);
    $id = intval($_POST['id']);
    $new_jml_stok = $_POST['new_jml_stok'];
    $edit = mysqli_query($con, "UPDATE `tm_produk` SET `jml_stok`=jml_stok+$new_jml_stok WHERE id=$id ");
    if ($edit) {
        echo "<script>
alert('Stok Ditambahkan');
window.location='?/=" . $_GET['/'] . "';
</script> ";
    }
}

?>