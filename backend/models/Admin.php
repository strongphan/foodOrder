<?php
require_once 'models/Model.php';

class Admin extends Model
{
    public $id;
    public $adminname;
    public $password;
    public $first_name;
    public $last_name;
    public $phone;
    public $address;
    public $email;
    public $avatar;
    public $jobs;
    public $last_login;
    public $facebook;
    public $status;
    public $created_at;
    public $updated_at;

    public $str_search;

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['adminname']) && !empty($_GET['adminname'])) {
            $adminname = addslashes($_GET['adminname']);
            $this->str_search .= " AND admins.adminname LIKE '%$adminname%'";
        }
    }

    public function getAll()
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM admins ORDER BY id");
        $obj_select->execute();
        $admins = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $admins;
    }

    public function register() {
        $sql_insert = "
        INSERT INTO admins(adminname, password) VALUES(:adminname, :password)";
        $obj_insert = $this->connection
            ->prepare($sql_insert);
        $inserts = [
            ':adminname' => $this->adminname,
            ':password' => $this->password,
        ];
        $is_insert = $obj_insert->execute($inserts);
        return $is_insert;
    }

    public function getUser($adminname)
    {
        $sql_select_one =
            "SELECT * FROM admins WHERE adminname = :adminname";
        $obj_select_one = $this->connection
            ->prepare($sql_select_one);
        $selects = [
            ':adminname' => $adminname
        ];
        $obj_select_one->execute($selects);
        $admin = $obj_select_one
            ->fetch(PDO::FETCH_ASSOC);
        return $admin;
    }

    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT * FROM admins WHERE TRUE $this->str_search
              ORDER BY created_at DESC
              LIMIT $start, $limit");

        $obj_select->execute();
        $admins = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $admins;
    }

    public function getTotal()
    {
        $obj_select = $this->connection
            ->prepare("SELECT COUNT(id) FROM admins WHERE TRUE $this->str_search");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }

    public function getById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM admins WHERE id = $id");
        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($adminname)
    {
        $obj_select = $this->connection
            ->prepare("SELECT COUNT(id) FROM admins WHERE adminname='$adminname'");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }

    public function insert()
    {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO admins(adminname, password, first_name, last_name, phone, address, email, avatar, jobs, facebook, status)
VALUES(:adminname, :password, :first_name, :last_name, :phone, :address, :email, :avatar, :jobs, :facebook, :status)");
        $arr_insert = [
            ':adminname' => $this->adminname,
            ':password' => $this->password,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':phone' => $this->phone,
            ':address' => $this->address,
            ':email' => $this->email,
            ':avatar' => $this->avatar,
            ':jobs' => $this->jobs,
            ':facebook' => $this->facebook,
            ':status' => $this->status,
        ];
        return $obj_insert->execute($arr_insert);
    }

    public function update($id)
    {
        $obj_update = $this->connection
            ->prepare("UPDATE admins SET first_name=:first_name, last_name=:last_name, phone=:phone, 
            address=:address, email=:email, avatar=:avatar, jobs=:jobs, facebook=:facebook, status=:status, updated_at=:updated_at
             WHERE id = $id");
        $arr_update = [
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':phone' => $this->phone,
            ':address' => $this->address,
            ':email' => $this->email,
            ':avatar' => $this->avatar,
            ':jobs' => $this->jobs,
            ':facebook' => $this->facebook,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];
        $obj_update->execute($arr_update);

        return $obj_update->execute($arr_update);
    }

    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM admins WHERE id = $id");
        return $obj_delete->execute();
    }

    public function getUserByUsernameAndPassword($adminname, $password)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM admins WHERE adminname=:adminname AND password=:password LIMIT 1");
        $arr_select = [
            ':adminname' => $adminname,
            ':password' => $password,
        ];
        $obj_select->execute($arr_select);

        $admin = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $admin;
    }

    public function insertRegister()
    {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO admin(adminname, password, status)
VALUES(:adminname, :password, :status)");
        $arr_insert = [
            ':adminname' => $this->adminname,
            ':password' => $this->password,
            ':status' => $this->status,
        ];
        return $obj_insert->execute($arr_insert);
    }

}