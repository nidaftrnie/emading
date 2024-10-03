<?php include('template/header.php');
include("assets/admin/template/config_query.php");
$db = new database();
?>

<?php
// Check if id_artikel is set in the URL
$id_artikel = isset($_GET["id_artikel"]) ? $_GET["id_artikel"] : null;

// Handle the case when id_artikel is not set
if ($id_artikel === null) {
    echo "<div class='alert alert-danger' role='alert'>ID Artikel is not set in the URL.</div>";
    exit;
}

// Fetch artikel data based on id_artikel
$artikel = $db->get_artikel_detail($id_artikel);

// Check if artikel exists
if (!$artikel) {
    echo "<div class='alert alert-danger' role='alert'>Artikel not found.</div>";
    exit;
}
?>

<div class="site-cover site-cover-sm same-height overlay single-page"
    style="background-image: url('assets/files/<?= $artikel['foto']; ?>');">
    <div class="container">
        <div class="row same-height justify-content-center">
            <div class="col-md-6">
                <div class="post-entry text-center">
                    <h1 class="mb-4"><?= $artikel['judul_artikel'] ?></h1>
                    <div class="post-meta align-items-center text-center">
                        <span><?php
                        $harijam = $artikel['created_at'];
                        $date = strtotime($harijam);
                        echo date('F, d Y', $date);
                        ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">

        <div class="row blog-entries element-animate">

            <div class="col-md-12 main-content">

                <div class="post-content-body">
                    <p><?= $artikel['isi_artikel'] ?></p>
                </div>

            </div>

            <!-- END main-content -->

        </div>
    </div>
</section>

<?php include('template/footer.php') ?>