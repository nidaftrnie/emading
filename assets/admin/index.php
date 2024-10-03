<!-- Header -->
<?php
include('template/header.php');
include("template/config_query.php");
$db = new database();
$data_artikel = $db->tampil_data();
?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manajemen /</span> Artikel</h4>

    <!-- Responsive Table -->
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-6">
            <h5>Daftar Artikel</h5>
          </div>
          <div class="col-lg-6">
            <div class="float-end">
              <a href="TambahArtikel.php" class="btn btn-primary">
                <i class="bx bx-plus"></i>
                Tambah Artikel
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr class="text-nowrap">
                <th class="text-center bg-primary text-white">No</th>
                <th class="text-center bg-primary text-white">Gambar</th>
                <th class="text-center bg-primary text-white">Judul Artikel</th>
                <th class="text-center bg-primary text-white">Isi Artikel</th>
                <th class="text-center bg-primary text-white">Status Artikel</th>
                <th class="text-center bg-primary text-white">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (empty($data_artikel)) {
                echo "<tr><td>Data Tidak Tersedia!</td></tr>";
              } else {
                $no = 1;
                foreach ($data_artikel as $row) {
                  ?>
                  <tr>
                    <th><?= $no++; ?></th>
                    <td>
                      <a href="../files/<?= $row['foto']; ?>" target="_blank">
                        <img src="../files/<?= $row['foto']; ?>" class="img-thumbnail rounded" style="max-width: 80px" ;>
                      </a>
                    </td>
                    <td>
                      <?= strlen($row['judul_artikel']) > 30 ? substr($row['judul_artikel'], 0, 30) . '...' : $row['judul_artikel']; ?>
                    </td>
                    <td class="pt-4">
                      <?= strlen($row['isi_artikel']) > 25 ? substr($row['isi_artikel'], 0, 20) . '...' : $row['isi_artikel']; ?>
                    </td>
                    <td><?= $row['status_publish']; ?></td>
                    <td>
                      <a href="editArtikel.php?id_artikel=<?= $row['id_artikel']; ?>"
                        class="btn btn-sm btn-warning">Edit</a>
                      <button class="btn btn-sm btn-danger"
                        onclick="deleteArticle(<?= $row['id_artikel']; ?>)">Hapus</button>
                    </td>
                  </tr>
                  <!-- script delete data -->
                  <script>
                    function deleteArticle(articleId) {
                      if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
                        // If user confirms the deletion, perform AJAX request to delete the article
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'action_process.php?action=delete', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState == 4 && xhr.status == 200) {
                            // Reload the page after successful deletion
                            window.location.reload();
                          }
                        };
                        xhr.send('id_artikel=' + articleId);
                      }
                    }
                  </script>
                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!--/ Responsive Table -->
  </div>
  <!-- / Content -->

  <!-- footer -->
  <?php
  include('template/footer.php');
  ?>