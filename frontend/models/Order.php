<?php
require_once 'models/Model.php';
class Order extends Model {
    public function insertData($fullname, $price_total){
        $sql_insert = "insert into orders(fullname, price_total) values (:fullname, :price_total)";
        $obj_insert = $this->connection->prepare($sql_insert);
        $inserts = [
            ':fullname' => $fullname,
            ':price_total' => $price_total
        ];
        $is_insert = $obj_insert->execute($inserts);
        $order_id = $this->connection->lastInsertId($is_insert);
        return $order_id;
    }
}