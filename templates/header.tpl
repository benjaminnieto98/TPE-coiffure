<!DOCTYPE html>
<html lang="en">

<head>
  <base href="{BASE_URL}">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <title>Barber Shop | Coiffure</title>
</head>

<body>
  <header class="pb-3 mb-4 border-bottom">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="home">Coiffure</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link" href="products">Productos</a>
            <a class="nav-link" href="categories">Categorias</a>
            {if $userRol == 2}
              <a class="nav-link" href="users">Usuarios</a>
            {/if}
            {if $userRol == 0}
                <a class="btn btn-outline-success" href="logIn" type="button">Iniciar sesion</a>
                <a class="btn btn-outline-primary" href="register" type="button">Registrarse</a>
            {/if}
            {if $userRol != 0}
              <a class="btn btn-outline-danger" href="logOut" type="button">Cerrar sesión</a>
            {/if}
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- inicio main container -->
<main class="container">