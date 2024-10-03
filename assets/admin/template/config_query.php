<?php
// membuat class dengan nama database

class database
{
    var $host = 'localhost';
    var $username = "root";
    var $password = "";
    var $database = "db_emading";
    var $koneksi = "";

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database Gagal : " . mysqli_connect_error();
        }
    }

    //Get Data tb_users
    public function get_data_users($username)
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_user WHERE username ='$username'");

        return $data;
    }

    public function tampil_data()
    {
        $data = mysqli_query($this->koneksi, "SELECT id_artikel, foto, judul_artikel, isi_artikel, status_publish, tba.created_at, tba.updated_at, tba.id_users FROM tb_artikel tba join tb_user tbu on tba.id_users = tbu.id_users");

        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $hasil[] = $row;
                }
            } else {
                $hasil = '0';
            }
            return $hasil;
        }
    }

    public function add_data($foto, $judul_artikel, $isi_artikel, $status_publish, $id_users)
    {
        $dateTime = date("Y-m-d H:i:s");
        $insert = mysqli_query($this->koneksi, "INSERT into tb_artikel (id_users, foto, judul_artikel, isi_artikel, status_publish, created_at) values ('$id_users', '$foto', '$judul_artikel', '$isi_artikel', '$status_publish', '$dateTime')") or die(mysqli_error($this->koneksi));

        return $insert;
    }

    // Get article by ID
    public function get_artikel_by_id($id_artikel)
    {
        $data = mysqli_query($this->koneksi, "SELECT tba.*, tbu.* FROM tb_artikel tba JOIN tb_user tbu ON tba.id_users = tbu.id_users WHERE tba.id_artikel = $id_artikel");

        return $data ? mysqli_fetch_assoc($data) : null;
    }

    // Get article detail
    public function get_artikel_detail($id_artikel)
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_artikel WHERE id_artikel = $id_artikel");

        return $data ? mysqli_fetch_assoc($data) : null;
    }

    // Update article
    public function update_data($id_artikel, $foto, $judul_artikel, $isi_artikel, $status_publish)
    {
        $datetime = date("Y-m-d H:i:s");
        $update = mysqli_query($this->koneksi, "UPDATE tb_artikel SET 
                foto = '$foto',
                judul_artikel = '$judul_artikel',
                isi_artikel = '$isi_artikel',
                status_publish = '$status_publish',
                updated_at = '$datetime'
                WHERE id_artikel = $id_artikel");
        return $update;
    }

    // Delete article
    public function delete_data($id_artikel)
    {
        $delete = mysqli_query($this->koneksi, "DELETE FROM tb_artikel WHERE id_artikel = $id_artikel");

        return $delete;
    }

    // Get data table artikel status publish
    public function show_publish_data()
    {
        $artikel = array();

        $data = mysqli_query($this->koneksi, "SELECT tba.id_artikel, tba.foto, tba.judul_artikel, tba.isi_artikel, tba.status_publish, tba.created_at, tba.id_users FROM tb_artikel tba JOIN tb_user tbu ON tba.id_users = tbu.id_users WHERE tba.status_publish = 'publish'");

        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $artikel[] = $row;
                }
            } else {
                $artikel = "0";
            }
        }

        return $artikel;
    }
}