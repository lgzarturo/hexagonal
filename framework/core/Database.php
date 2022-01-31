<?php

class Database
{
  private $uri;
  private $engine;
  private $db_host;
  private $db_name;
  private $db_user;
  private $db_password;
  private $charset;
  private $connection;

  public function __construct()
  {
    $this->engine = DB_ENGINE;
    $this->db_host = DB_HOST;
    $this->db_name = DB_NAME;
    $this->db_user = DB_USER;
    $this->db_password = DB_PASS;
    $this->charset = DB_CHARSET;
    $this->uri = $this->engine . ':host=' . $this->db_host;
    $this->uri .= ';dbname=' . $this->db_name;
    $this->uri .= ';charset=' . $this->charset;
    $this->connect();
    return $this;
  }

  private function connect()
  {
    try {
      $this->connection = new PDO($this->uri, $this->db_user, $this->db_password);
      return $this->connection;
    } catch (PDOException $e) {
      throw new Exception("Error al conectar a la base de datos: " . $e->getMessage());
      die;
    }
  }

  public static function query($sql, $params = [])
  {
    $self = new self();
    $self->connection->beginTransaction();
    $query = $self->connection->prepare($sql);
    $result = $query->execute($params);
    if (!$result) {
      $self->connection->rollBack();
      $error = $query->errorInfo();
      /**
       * $error[0] = SQLSTATE error code (a driver-specific error code)
       * $error[1] = Driver-specific error code
       * $error[2] = Driver-specific error message
       */
      throw new Exception('Error de consulta: ' . $error[2]);
    }

    // SELECT, INSERT, UPDATE, DELETE
    $command = strtoupper(explode(' ', trim($sql))[0]);
    if ($command == 'SELECT') {
      return $query->rowCount() > 0 ? $query->fetchAll(PDO::FETCH_ASSOC) : [];
    } elseif ($command == 'INSERT') {
      $id = $self->connection->lastInsertId();
      $self->connection->commit();
      return $id;
    } elseif ($command == 'UPDATE') {
      if (strpos($sql, 'WHERE') === false) {
        $self->connection->rollBack();
        throw new Exception('Error de consulta: No se encontró la cláusula WHERE');
      }
      $self->connection->commit();
      return $query->rowCount();
    } elseif ($command == 'DELETE') {
      if (strpos($sql, 'WHERE') === false) {
        $self->connection->rollBack();
        throw new Exception('Error de consulta: No se encontró la cláusula WHERE');
      }
      if ($query->rowCount()) {
        $self->connection->commit();
        return true;
      }
      $self->connection->rollBack();
      return false;
    } else {
      $self->connection->commit();
      return true;
    }
    return $result;
  }

  public function escape($value)
  {
    return $this->connection->real_escape_string($value);
  }

  public function close()
  {
    $this->connection->close();
  }
}
