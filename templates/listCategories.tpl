{include file="header.tpl" title="Categorias"}

<div class="row">
    {if $userRol == 2}
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 py-4 h-100 p-5 text-bg-dark rounded-3">
            <h2>Añadir categoria</h2>
            <form action="addCategory" method="POST">
                <div class="form-floating text-dark mb-1">
                    <input type="text" class="form-control" name="nombre" placeholder="Categoria" autofocus />
                    <label for="categoria">Categoria</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Añadir</button>
                </div>
            </form>
            <small>*Si se elimina una categoria se perderan todos los productos asociados</small>
        </div>
    {/if}
    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 py-4 h-100 p-5">
        <h2>Listado de categorias</h2>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Productos</th>
                    {if $userRol == 2}
                        <th>Editar</th>
                        <th>Borrar</th>
                    {/if}
                </tr>
            </thead>
            <tbody>
                {foreach from=$categories item=$category}
                    <tr>
                        <td>{$category->nombre}</td>
                        <td><a href="category/{$category->id_categoria}">+</a></td>
                        {if $userRol == 2}
                            <td><a href="editCategory/{$category->id_categoria}">+</a></td>
                            <td><a href="deleteCategory/{$category->id_categoria}">x</a></td>
                        {/if}
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>

{include file="footer.tpl"}