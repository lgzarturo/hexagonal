<?php

class UserModel extends Model
{
  public $id;
  public $name;
  public $email;
  public $username;
  public $password;
  public $created_at;
  public $updated_at;

  public function add()
  {
    $sql = "INSERT INTO users (name, email, username, password) VALUES (:name, :email, :username, :password)";
    $params = [
      ':name' => $this->name,
      ':email' => $this->email,
      ':username' => $this->username,
      ':password' => $this->password
    ];
    try {
      return ($this->id = parent::query($sql, $params)) ? $this->id : false;
    } catch (Exception $e) {
      throw new Exception('Error de consulta: ' . $e->getMessage());
    }
  }

  public function update()
  {
    $sql = "UPDATE users SET name = :name, email = :email, username = :username, password = :password WHERE id = :id LIMIT 1";
    $params = [
      ':id' => $this->id,
      ':name' => $this->name,
      ':email' => $this->email,
      ':username' => $this->username,
      ':password' => $this->password
    ];
    try {
      return parent::query($sql, $params);
    } catch (Exception $e) {
      throw new Exception('Error de consulta: ' . $e->getMessage());
    }
  }
}
