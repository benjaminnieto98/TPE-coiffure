<?php
require_once "app/model/UserModel.php";
require_once "app/helpers/AuthHelper.php";
require_once "app/view/UserView.php";

class UserController
{
    private $model;
    private $view;
    private $authHelper;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
        $this->authHelper = new AuthHelper();
    }

    //VERIFICA LOS CAMPOS PASADOS POR POST EMAIL Y CONTRASEÑA PARA INICIAR SESION
    public function startSession()
    {
        $this->authHelper->checkLoggedIn();
        if (isset($_POST['email']) && isset($_POST['pass']) && !empty($_POST['email'] && !empty($_POST['pass']))) {
            if ($this->serverStartSession($_POST['email'], $_POST['pass'])) {
                header("Location: " . BASE_URL . "home");
            } else {
                $this->view->renderLogIn();
            }
        }
    }

    //VERIFICA SI EXISTE EL EMAIL EN LA BD Y LA CONTRASEÑA COINCIDE E INICIA SESSION EN EL SERVIDOR
    //UTILIZADO POR: startSession, addUser
    public function serverStartSession($userEmail, $pass)
    {
        $user = $this->model->getUser($userEmail);
        if ($user && password_verify($pass, ($user->contraseña))) {
            session_start();
            $_SESSION['id'] = $user->id_usuario;
            $_SESSION['email'] = $userEmail;
            $_SESSION['rol'] = $user->rol;
            return true;
        } else return false;
    }

    //RENDERIZA LA PAGINA DE LOGUEO
    public function showLogIn()
    {
        if ($this->authHelper->isLoggedIn())
            $this->view->renderError("Ya estás logueado");
        else
            $this->view->renderLogIn();
    }

    //RENDERIZA LA PAGINA CON LISTA DE USUARIOS (SOLO ADMINISTRADOR)
    public function showUsers()
    {
        $this->authHelper->checkAdmin();
        $users = $this->model->getUsers();
        $this->view->renderUsers($users);
    }

    //LLEVA A LA PAGINA DE REGISTRO DE USUARIO
    public function showRegister()
    {
        if ($this->authHelper->isLoggedIn())
            $this->view->renderError("Ya estás registrado y logueado");
        else
            $this->view->renderRegister();
    }

    public function showError()
    {
        $this->view->renderError();
    }

    //CIERRA SESIÓN
    public function logOut()
    {
        if (!$this->authHelper->isLoggedIn())
            $this->view->renderError("No iniciaste sesión");
        else
            $this->authHelper->logOut();
    }

    //REGISTRA UN NUEVO USUARIO EN LA BD
    public function addUser()
    {
        if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['pass'])) {
            if (!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['pass'])) {
                if (!$this->model->getUser($_POST['email'])) {
                    $pass = $_POST['pass'];
                    $passCrypted = password_hash($_POST['pass'], PASSWORD_BCRYPT);
                    $this->model->addUser($_POST['nombre'], $_POST['email'], $passCrypted);
                    $this->startSession($_POST['email'], $pass);
                    header("Location: " . BASE_URL . "home");
                } else
                    $this->view->renderError("Ya existe un usuario con ese email");
            } else
                $this->view->renderError("Algún campo está vacío");
        }
    }

    //MODIFICA EL ROL DEL USUARIO
    public function modifyUserRol($idUsuario)
    {
        $this->authHelper->checkAdmin();
        if (isset($_POST['rol']) && !empty($_POST['rol']) && $idUsuario) {
            $this->model->modifyUserRol($idUsuario, $_POST['rol']);
            if ($this->authHelper->getUserId() == $idUsuario) //chequea que si el usuario al que se modifica el rol es el mismo q esta logueado se cierra la sesión
                $this->authHelper->logOut();
            else
                header("Location: " . BASE_URL . "users");
        } else
            $this->view->renderError("No se estableció el rol");
    }

    public function deleteUser($email)
    {
        $this->authHelper->checkAdmin();
        if ($this->model->getUser($email)) { //chequeo si el usuario existe
            $this->model->deleteUserFromDB($email);
            if ($this->authHelper->getUserEmail() == $email) //si es el mismo usuario que cierre sesion
                $this->authHelper->logOut();
            else
                header("Location: " . BASE_URL . "users");
        } else
            $this->view->renderError("No existe el usuario");
    }
}
