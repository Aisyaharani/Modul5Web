<?php

namespace Codelab\Models;

include "Codelab/Config/DatabaseConfig.php";

use Codelab\Config\DatabaseConfig;
use mysqli;

class Product extends DatabaseConfig
{
  public $con;

  public function __construct()
  {
    $this->con = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
    if ($this->con->connect_error) {
      die("Connection failed :" . $this->con->connect_error);
    }
  }

  public function findAll()
  {
    $sql = "SELECT * FROM products";
    $result = $this->con->query($sql);
    $this->con->close();
    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    return $data;
  }
  public function findById($id){
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $this->con->prepare($sql);
    $stmt ->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $this->con->close();
    $data =[];
    while ($row = $result->fetch_assoc()){
      $data[] = $row;
    }
    return $data;
  }
  public function create($data){
    $productNAme = $data ['product_name'];
    $query = "INSERT INTO products (product_name) VALUES (?)";
    $stmt = $this->con->prepare($query);
    $stmt->bind_param("s",$productNAme);
    $stmt->execute();
    $this->con->close();
  }

  public function update($data,$id){
    $productNAme = $data['product_name'];

    $query = "UPDATE products SET product_name =? WHERE id = ?";
    $stmt = $this->con->prepare($query);
    $stmt->bind_param("si", $productNAme,$id);
    $stmt->execute();
    $this->con->close();
  }

  public function destroy($id){
    $query = "DELETE FROM products WHERE id=?";
    $stmt = $this->con->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $this->con->close();
  }
}
