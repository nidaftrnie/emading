<!-- Header -->
<?php
include('template/header.php');
include("assets/admin/template/config_query.php");
$db = new database();
$data = $db->show_publish_data();
$i = 1;
?>
<!-- Start retroy layout blog posts -->
<section class="section bg-light">
    <div class="container">
        <h1 class="fw-bold text-center mb-5" style="color: #214252; font-size:60px;">JeWePe <br> E-MADING</h1>
        <?php
        foreach ($data as $row):
            if ($i === 1):
                ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="blog-entry">
                            <a href=" detail.php?id_artikel=<?= $row['id_artikel']; ?>" class="img-link">
                                <img src="assets/files/<?= $row['foto']; ?>" alt="Image" class="img-fluid rounded">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="date"><?php
                        $harijam = $row['created_at'];
                        $date = strtotime($harijam);
                        echo date('F, d Y', $date);
                        ?></span>
                        <h2><a href=" detail.php?id_artikel=<?= $row['id_artikel']; ?>"><?= $row['judul_artikel'] ?></a>
                        </h2>
                        <p><?= strlen($row['isi_artikel']) > 200 ? substr($row['isi_artikel'], 0, 200) . '...' : $row['isi_artikel']; ?>
                        </p>
                        <p><a href=" detail.php?id_artikel=<?= $row['id_artikel']; ?>"
                                class="btn btn-sm btn-outline-primary">Read More</a></p>
                    </div>
                    <?php
                    $i++;
            endif;
        endforeach;
        ?>
        </div>
        <div class="row align-items-stretch retro-layout mb-3">
            <?php
            $i = 0;
            $colCount = 0;
            foreach (array_slice($data, 1) as $row): // Skip the first element
                if ($i < 4):
                    if ($colCount == 0):
                        echo '<div class="col-md-6">';
                    endif;
                    ?>
                    <a href="detail.php?id_artikel=<?= $row['id_artikel']; ?>" class="h-entry mb-30 v-height gradient">
                        <div class="featured-img" style="background-image: url('assets/files/<?= $row['foto']; ?>');">
                        </div>
                        <div class="text">
                            <span class="date"><?php
                            $harijam = $row['created_at'];
                            $date = strtotime($harijam);
                            echo date('F, d Y', $date);
                            ?></span>
                            <h2><?= $row['judul_artikel'] ?></h2>
                        </div>
                    </a>
                    <?php
                    $i++;
                    $colCount++;
                    if ($colCount == 2):
                        echo '</div>';
                        $colCount = 0;
                    endif;
                endif;
            endforeach;
            ?>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
            </ul>
        </nav>
    </div>
</section>
<!-- End retroy layout blog posts -->

<?php include('template/footer.php') ?>