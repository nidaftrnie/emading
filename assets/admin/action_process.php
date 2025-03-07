<?php
include('template/config_query.php');
$db = new database();
session_start();
$id_users = $_SESSION['id_users'];
$action = $_GET['action'];


if ($action == "add") {

    //Check foto 

    // echo "<pres>";
    // print_r($_FILES);
    // echo "</pres>";
    // die;

    if ($_FILES["foto"]["name"] != '') {

        $tmp = explode('.', $_FILES["foto"]["name"]); //split name - extensions
        $ext = end($tmp); //Get Ext
        $filename = $tmp[0];  //Get File name without Ext
        $allowed_ext = array("jpg", "png", "jpeg"); //Allow Ext

        if (in_array($ext, $allowed_ext)) { //Check valid Ext

            if ($_FILES["foto"]["size"] <= 5120000) { //check image size, max 5mb
                $name = $filename . '_' . rand() . '.' . $ext; //Rename Image File
                $path = "../files/" . $name; //Path Upload image
                $uploaded = move_uploaded_file($_FILES["foto"]["tmp_name"], $path); //Move file

                if ($uploaded) {
                    $insertData = $db->add_data($name, $_POST["judul"], $_POST["isi"], $_POST["status_publish"], $id_users); //Query Add Data

                    if ($insertData) {
                        echo "<script>alert('Data Berhasil Ditambahkan');</script>";
                        header('Location: index.php');
                        exit();
                    } else {
                        echo "<script>alert('Data Gagal Ditambahkan');</script>";
                        header('Location: TambahArtikel.php');
                        exit();
                    }
                } else {
                    echo "<script>alert('Gagal Upload file');document.location.href = 'TambahArtikel.php';</script>";
                }
            } else {
                echo "<script>alert('Ukuran Gambar lebih dari 5mb');document.location.href = 'TambahArtikel.php';</script>";
            }
        } else {
            echo "<script>alert('File salah ekstensi');document.location.href = 'TambahArtikel.php';</script>";
        }
    } else {
        echo "<script>alert('Gambar tidak boleh kosong');document.location.href = 'TambahArtikel.php';</script>";
    }
    echo $id_users;
} elseif ($action == "update") {

    // Update data

    $id_artikel = $_GET['id_artikel'];
    // Check if article ID is provided
    if (isset($id_artikel)) {
        $artikel = $db->get_artikel_by_id($id_artikel);

        // Check if the article exists
        if ($artikel) {
            // Proceed with update

            // Check foto 
            if ($_FILES["foto"]["name"] != '') {
                $tmp = explode('.', $_FILES["foto"]["name"]);
                $ext = end($tmp);
                $filename = $tmp[0];
                $allowed_ext = array("jpg", "png", "jpeg");

                if (in_array($ext, $allowed_ext)) {
                    if ($_FILES["foto"]["size"] <= 5120000) {
                        $name = $filename . '_' . rand() . '.' . $ext;
                        $path = "../files/" . $name;
                        $uploaded = move_uploaded_file($_FILES["foto"]["tmp_name"], $path);

                        if ($uploaded) {
                            // Update data in the database
                            $updateData = $db->update_data($id_artikel, $name, $_POST["judul_artikel"], $_POST["isi_artikel"], $_POST["status_publish"]);

                            if ($updateData) {
                                echo "<script>alert('Data Berhasil Diupdate');</script>";
                                header('Location: index.php');
                                exit();
                            } else {
                                echo "<script>alert('Data Gagal Diupdate');</script>";
                                header("Location: editArtikel.php?id_artikel=$id_artikel");
                                exit();
                            }
                        } else {
                            echo "<script>alert('Gagal Upload file');document.location.href = 'editArtikel.php?id_artikel=$id_artikel';</script>";
                        }
                    } else {
                        echo "<script>alert('Ukuran Gambar lebih dari 5mb');document.location.href = 'editArtikel.php?id_artikel=$id_artikel';</script>";
                    }
                } else {
                    echo "<script>alert('File salah ekstensi');document.location.href = 'editArtikel.php?id_artikel=$id_artikel';</script>";
                }
            } else {
                // If no new image is uploaded, update data without changing the image
                $updateData = $db->update_data($id_artikel, $artikel['foto'], $_POST["judul_artikel"], $_POST["isi_artikel"], $_POST["status_publish"]);

                if ($updateData) {
                    echo "<script>alert('Data Berhasil Diupdate');</script>";
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<script>alert('Data Gagal Diupdate');</script>";
                    header("Location: editArtikel.php?id_artikel=$id_artikel");
                    exit();
                }
            }
        } else {
            // Article not found
            echo "<script>alert('Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
        }
    } else {
        // ID not provided
        echo "<script>alert('ID Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
    }

    // Update data

    $id_artikel = $_GET['id_artikel'];
    // Check if article ID is provided
    if (isset($id_artikel)) {
        $artikel = $db->get_artikel_by_id($id_artikel);

        // Check if the article exists
        if ($artikel) {
            // Proceed with update

            // Check foto 
            if ($_FILES["foto"]["name"] != '') {
                $tmp = explode('.', $_FILES["foto"]["name"]);
                $ext = end($tmp);
                $filename = $tmp[0];
                $allowed_ext = array("jpg", "png", "jpeg");

                if (in_array($ext, $allowed_ext)) {
                    if ($_FILES["foto"]["size"] <= 5120000) {
                        $name = $filename . '_' . rand() . '.' . $ext;
                        $path = "../files/" . $name;
                        $uploaded = move_uploaded_file($_FILES["foto"]["tmp_name"], $path);

                        if ($uploaded) {
                            // Update data in the database
                            $updateData = $db->update_data($id_artikel, $name, $_POST["judul_artikel"], $_POST["isi_artikel"], $_POST["status_publish"]);

                            if ($updateData) {
                                echo "<script>alert('Data Berhasil Diupdate');</script>";
                                header('Location: index.php');
                                exit();
                            } else {
                                echo "<script>alert('Data Gagal Diupdate');</script>";
                                header("Location: editArtikel.php?id_artikel=$id_artikel");
                                exit();
                            }
                        } else {
                            echo "<script>alert('Gagal Upload file');document.location.href = 'editArtikel.php?id_artikel=$id_artikel';</script>";
                        }
                    } else {
                        echo "<script>alert('Ukuran Gambar lebih dari 5mb');document.location.href = 'editArtikel.php?id_artikel=$id_artikel';</script>";
                    }
                } else {
                    echo "<script>alert('File salah ekstensi');document.location.href = 'editArtikel.php?id_artikel=$id_artikel';</script>";
                }
            } else {
                // If no new image is uploaded, update data without changing the image
                $updateData = $db->update_data($id_artikel, $artikel['foto'], $_POST["judul"], $_POST["isi"], $_POST["status_publish"]);

                if ($updateData) {
                    echo "<script>alert('Data Berhasil Diupdate');</script>";
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<script>alert('Data Gagal Diupdate');</script>";
                    header("Location: editArtikel.php?id_artikel=$id_artikel");
                    exit();
                }
            }
        } else {
            // Article not found
            echo "<script>alert('Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
        }
    } else {
        // ID not provided
        echo "<script>alert('ID Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
    }
} elseif ($action == "delete") {
    $id_artikel = $_POST['id_artikel'];

    // Check if article ID is provided
    if (isset($id_artikel)) {
        // Perform deletion logic here
        $deleteData = $db->delete_data($id_artikel);

        if ($deleteData) {
            echo "<script>alert('Data Berhasil Dihapus');</script>";
            header('Location: index.php');
            exit();
        } else {
            echo "<script>alert('Data Gagal Dihapus');</script>";
            header('Location: index.php');
            exit();
        }
    } else {
        // ID not provided
        echo "<script>alert('ID Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('No Access operations');document.location.href = 'index.php';</script>";
}