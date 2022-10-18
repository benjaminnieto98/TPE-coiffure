<?php
require_once "app/view/ProductView.php";
require_once "app/model/ProductModel.php";
require_once "app/helpers/AuthHelper.php";

class ProductController
{

    private $model;
    private $view;
    private $authHelper;

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->view = new ProductView();
        $this->authHelper = new AuthHelper();
    }


    function showProducts($categories)
    {
        $products = $this->model->getProducts();
        $this->view->renderProducts($products, $categories);
    }

    function showProduct($id_product)
    {
        $product = $this->model->getProduct($id_product);
        $this->view->renderProduct($product);
    }
    
    function showProductsByCategory($id_category, $categories)
    {
        $products = $this->model->getProductsCategory($id_category);
        $this->view->renderProducts($products, $categories);
    }
    
    function showEditProduct($id_product, $categories)
    {
        $this->authHelper->checkAdmin();
        $product = $this->model->getProduct($id_product);
        $this->view->renderEditProduct($product, $categories);
    }

    function addProduct()
    {
        $this->authHelper->checkAdmin();
        if (isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['precio']) && isset($_POST['id_categoria'])) {
            if (!empty($_POST['marca']) && !empty($_POST['modelo']) && !empty($_POST['precio']) && !empty($_POST['id_categoria'])) {
                $this->model->addProductToDB($_POST['marca'], $_POST['modelo'], $_POST['precio'], $_POST['id_categoria']);
                header("Location: " . BASE_URL . "products");
            }
        }
    }

    function deleteProduct($id_producto)
    {
        $this->authHelper->checkAdmin();
        $this->model->deleteProductFromDB($id_producto);
        header("Location: " . BASE_URL . "products");
    }

    function updateProduct($id_producto)
    {
        $this->authHelper->checkAdmin();
        if (isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['precio']) && isset($_POST['id_categoria'])) {
            if (!empty($_POST['marca']) && !empty($_POST['modelo']) && !empty($_POST['precio']) && !empty($_POST['id_categoria'])) {
                $this->model->updateProduct($_POST['marca'], $_POST['modelo'], $_POST['precio'], $_POST['id_categoria'], $id_producto);
                header("Location: " . BASE_URL . "products");
            }
        }
    }
}
