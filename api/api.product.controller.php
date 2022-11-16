<?php
require_once './app/model/ProductModel.php';
require_once 'api/api.view.php';

class ApiProductController {
    private $model;
    private $view;

    function __construct() {
        $this->model = new ProductModel();
        $this->view = new ApiView();
    }

    public function getAll($params = null) {
        $products = $this->model->getProducts();
        $this->view->response($products);
    }

    public function get ($params = null) {
        $id = $params [':ID'];
        $product = $this->model->getProduct($id);
        if ($product)
            $this->view->response($product);
        else
            $this->view->response("Product id= $id not found", 404);
    }

    public function remove ($params = null) {
        $id = $params [':ID'];
        $product = $this->model->getProduct($id);
        if ($product) {
            $product = $this->model->deleteProductFromDB($id);
            $this->view->response("Product id= $id remove successfuly");
        } else {
            $this->view->response("Product id= $id not found", 404);
        }
        
    }
    
}