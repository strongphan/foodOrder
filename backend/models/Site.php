<?php
require_once 'models/Model.php';

class Site extends Model {
    public $id;
    public $name;
    public $email;
    public $contact;
    public $cover_img;
    public $content;

    public function insertData(){
        $sql_insert = "insert into system_settings(name, email, contact, cover_img, about_content)
        values (:name, :email, :contact, :cover_img, :about_content) ";
        $obj_insert =$this->connection->prepare($sql_insert);
        $inserts = [
            ':name' => $this->name,
            ':email' => $this->email,
            ':contact' => $this->contact,
            ':cover_img' => $this->cover_img,
            ':about_content' => $this->content
        ];
        return $obj_insert->execute($inserts);
    }
    public function listData(){
        $sql_select_all = "select * from system_settings ";
        $obj_select_all = $this->connection->prepare($sql_select_all);
        $obj_select_all->execute();
        $sites = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
        return $sites;
    }
    public function updateData($id){
        $sql_update = "update system_settings set name = :name, email = :email, contact =:contact, 
                           cover_img = :cover_img, about_content = :about_content";
        $obj_update = $this->connection->prepare($sql_update);
        $updates = [
            ':name' => $this->name,
            ':email' => $this->email,
            ':contact' => $this->contact,
            ':cover_img' => $this->cover_img,
            ':about_content' => $this->content
        ];
        return $obj_update->execute($updates);
    }
    public function delete($id){
        $obj_delete = $this->connection
            ->prepare("DELETE FROM system_settings WHERE id = $id");
        return $obj_delete->execute();
    }
}