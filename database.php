<?php
require_once __DIR__."./Config.php";

//create a class Users
class Database extends Config 
{
      //fetch all or a single user from dadabase
    public function fetch($id = 0)
    {
        $sql = 'SELECT * FROM users';
        if ($id != 0) {
            # code...
            $sql = 'SELECT * FROM users WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id'=> $id]);
            $row = $stmt->fetchAll();
            return $row;
          } else {
              $stmt = $this->conn->prepare($sql);
              $stmt->execute(['id'=> $id]);
              $row = $stmt->fetchAll();
              return $row;
        }
    }

    //insert a user in the database 
    public  function insert($name, $email, $phone)
    {
        $sql = 'INSERT INTO users (name, email, phone ) VALUE (:name,:email,:phone)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ]);
        return true;
    }

    //update a user in the database 
    public function update($name,$email, $phone, $id)
    {
        $sql = 'UPDATE users SET 
        name = :name,email = :email, phone = :phone
        WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'id' => $id
        ]);
        return true;
    }
    //delete a user from database 
    public function delete($id)
    {
        $sql = 'DELETE FROM users WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        return true;
    }
}
?>