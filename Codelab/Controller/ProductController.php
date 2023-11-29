<?php
namespace Codelab\Controller;

include "Codelab/Traits/ApiResourceFormatter.php";
include "Codelab/Models/Product.php";

use Codelab\Models\Product;
use Codelab\Traits\ApiResponseFormatter;

class ProductController{
  use ApiResponseFormatter;

  public function index(){
    $productModel = new Product();
    $response = $productModel->findAll();
    return $this->apiResponse(200,"succes",$response);
  }

  public function getById($id){
    $productModel = new Product();
    $response = $productModel->findById($id);
    return $this->apiResponse(200,"succes",$response);
  }

  public function insert(){
    $jsonInput = file_get_contents('php://input');
    $inputData = json_decode($jsonInput,true);

    if(json_last_error()){
      return $this->apiResponse(400,"error invalid input",null);
    }

    $productModel = new Product();
    $response = $productModel->create([
      "product_name"=>$inputData['product_name']
    ]);
    return $this->apiResponse(200,"succes",$response);
  }
  public function update($id){
    $jsonInput = file_get_contents('php://input');
    $inputData = json_decode($jsonInput,true);

    if(json_last_error()){
      return $this->apiResponse(400,"error invalid input",null);
    }

    $productModel = new Product();
    $response = $productModel->update([
      "product_name"=>$inputData['product_name']
    ],$id);
    return $this->apiResponse(200,"succes",$response);
  }
  public function delele($id){
    $productModel = new Product();
    $response = $productModel->destroy($id);
    return $this->apiResponse(200,"succes",$response);
  }
}
?>