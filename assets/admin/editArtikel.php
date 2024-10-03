<!-- Header -->
<?php
include('template/header.php');
include('template/config_query.php'); //config_query.php file
$db = new database();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="index.php"> Manajemen / </a></span> Edit
        Artikel</h4>

    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Edit Artikel</h4>
                </div>
                <div class="card-body">
                    <?php
                    // Check if id_artikel is set in the URL
                    $id_artikel = isset($_GET["id_artikel"]) ? $_GET["id_artikel"] : null;

                    // Handle the case when id_artikel is not set
                    if ($id_artikel === null) {
                        echo "<div class='alert alert-danger' role='alert'>ID Artikel is not set in the URL.</div>";
                        exit;
                    }

                    // Fetch artikel data based on id_artikel
                    $artikel = $db->get_artikel_by_id($id_artikel);

                    // Check if artikel exists
                    if (!$artikel) {
                        echo "<div class='alert alert-danger' role='alert'>Artikel not found.</div>";
                        exit;
                    }
                    ?>
                    <form action="action_process.php?action=update&id_artikel=<?php echo $id_artikel; ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-9">

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul Artikel*</label>
                                    <input type="text" name="judul_artikel" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Masukkan judul artikel"
                                        value="<?= $artikel['judul_artikel'] ?>" required />
                                </div>

                                <div class=" mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Isi Artikel*</label>
                                    <textarea class="form-control summernote" name="isi_artikel"
                                        id="exampleFormControlTextarea1" rows="3"
                                        required><?= htmlspecialchars($artikel['isi_artikel']) ?></textarea>

                                </div>

                                <div class="mb-3">
                                    <label for="uploadfoto" class="form-label">Ubah foto*</label><br />
                                    <img src="<?= "../files/" . $artikel['foto']; ?>">
                                    <input type="file" name="foto" class="form-control mt-3"
                                        id="exampleFormControlInput1" placeholder="Masukan Gambar foto" />
                                    <input type="hidden" name="id" value="<?= $id_artikel ?>">
                                    <input type="hidden" name="fotolama" value="<?= $artikel['foto'] ?>">
                                    <small class="text-danger">Max Ukuran 5Mb, Format : PNG,JPG,JPEG</small>
                                </div>

                            </div>

                            <div class="col-lg-3">
                                <div class="col-md mb-3">
                                    <small class="form-label d-block">Status Artikel*</small>
                                    <div class="form-check mt-3">
                                        <input name="status_publish" class="form-check-input" type="radio"
                                            value="publish" id="defaultRadio1" <?= $artikel['status_publish'] === 'publish' ? 'checked' : '' ?> required>
                                        <label class="form-check-label" for="defaultRadio1"> Publish </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status_publish" class="form-check-input" type="radio" value="draft"
                                            id="defaultRadio2" <?= $artikel['status_publish'] === 'draft' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="defaultRadio2"> Draft </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="mb-3 float-end">
                            <a href="index.php" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<!-- Footer -->
<?php include('template/footer.php'); ?>