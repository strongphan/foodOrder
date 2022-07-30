<?php
require_once 'models/Model.php';
class Category extends Model {

  public function getAll() {
    $sql_select_all = "SELECT * FROM categories WHERE `status` = 1";
    $obj_select_all = $this->connection->prepare($sql_select_all);
    $obj_select_all->execute();
    $categories = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
  }
    public function get3() {
        $sql_select_all = "SELECT * FROM categories WHERE `status` = 1 limit 3";
        $obj_select_all = $this->connection->prepare($sql_select_all);
        $obj_select_all->execute();
        $categories = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
  public function getByID($id){
      $obj_select = $this->connection->prepare(
          "SELECT * FROM products 
          INNER JOIN categories ON products.category_id = categories.id WHERE categories.id = $id");

      $obj_select->execute();
      $products =  $obj_select->fetchAll(PDO::FETCH_ASSOC);
      return $products;
  }
}