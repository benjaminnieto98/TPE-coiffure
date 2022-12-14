<?php
require_once "app/model/CategoryModel.php";
require_once "app/view/CategoryView.php";
require_once "app/helpers/AuthHelper.php";

class CategoryController
{
    private $model;
    private $view;
    private $authHelper;

    function __construct()
    {
        $this->model = new CategoryModel();
        $this->view = new CategoryView();
        $this->authHelper = new AuthHelper();
    }

    function showCategories()
    {
        $categories = $this->model->getCategories();
        $this->view->renderCategories($categories);
    }

    function showCategory($id)
    {
        $category = $this->model->getCategory($id);
        $this->view->renderCategory($category);
    }

    function showEditCategory($id)
    {
        $this->authHelper->checkAdmin();
        $category = $this->model->getCategory($id);
        $this->view->renderEditCategory($category);
    }

    function getCategories()
    {
        $categories = $this->model->getCategories();
        return $categories;
    }

    function getCategory($id_category)
    {
        $category = $this->model->getCategory($id_category);
        return $category;
    }

    function addCategory()
    {
        $this->authHelper->checkAdmin();
        if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
            $this->model->addCategory($_POST['nombre']);
            header("Location: " . BASE_URL . "categories");
        }
    }

    function updateCategory($id_categoria)
    {
        $this->authHelper->checkAdmin();
        if ($_SESSION['rol'] == 2) {
            if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
                $this->model->updateCategoryToDB($id_categoria, $_POST['nombre']);
                header("Location: " . BASE_URL . "categories");
            }
        } else 
        header("Location: " . BASE_URL . "logIn");
    }

    function deleteCategory($id_category)
    {
        $this->authHelper->checkAdmin();
        if ($_SESSION['rol'] == 2) {
            $this->model->deleteCategory($id_category);
            header("Location: " . BASE_URL . "categories");
        } else 
        header("Location: " . BASE_URL . "logIn");
    }
}
