<?php

namespace App;

use Inc\Koneksi as Koneksi;


class Photos extends Koneksi
{

    public function tampil()
    {
        $sql = "SELECT photo_id, photo_title, tb_post.post_name, tb_post.post_user, tb_post.post_text, tb_post.post_date FROM tb_photos INNER JOIN tb_post ON tb_photos.photo_id_post = tb_post.post_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $data = [];

        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
        }

        return $data;
    }

    public function simpan()
    {
        $photo_id_post = $_POST['photo_id_post'];
        $photo_title = $_POST['photo_title'];
        $sql = "INSERT INTO tb_photos (photo_id_post, photo_title) VALUES (:photo_id_post, :photo_title)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":photo_id_post", $photo_id_post);
        $stmt->bindParam(":photo_title", $photo_title);
        $stmt->execute();
    }

    public function edit($id)
    {

        $sql = "SELECT * FROM tb_photos WHERE photo_id=:photo_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":photo_id", $id);
        $stmt->execute();

        $row = $stmt->fetch();

        return $row;
    }

    public function update()
    {
        $photo_id_post = $_POST['photo_id_post'];
        $photo_title = $_POST['photo_title'];
        $photo_id = $_POST['photo_id'];

        $sql = "UPDATE tb_photos SET photo_id_post=:photo_id_post, photo_title=:photo_title WHERE photo_id=:photo_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":photo_id_post", $photo_id_post);
        $stmt->bindParam(":photo_title", $photo_title);
        $stmt->bindParam(":photo_id", $photo_id);
        $stmt->execute();
    }

    public function delete($id)
    {

        $sql = "DELETE FROM tb_photos WHERE photo_id=:photo_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":photo_id", $id);
        $stmt->execute();
    }
}
