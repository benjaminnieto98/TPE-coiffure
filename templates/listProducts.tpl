{include file="header.tpl" title="Productos"}

<div class="row">
    {if $userRol == 2}
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 py-4 bg-white">
            <h1>Añadir producto</h1>
            <form action="addProduct" method="POST">
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" name="marca" placeholder="Marca" autofocus />
                    <label for="marca">Marca</label>
                </div>
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" name="modelo" placeholder="Modelo" autofocus />
                    <label for="modelo">Modelo</label>
                </div>
                <div class="form-floating mb-1">
                    <input type="number" class="form-control" name="precio" placeholder="Precio" autofocus />
                    <label for="precio">Precio</label>
                </div>
                <div class="form-floating mb-1">
                    <select name="id_categoria" class="form-select">
                        {foreach from=$categories item=$category}
                            <option value="{$category->id_categoria}">{$category->nombre}</option>
                        {/foreach}
                    </select>
                    <label for="id_categoria">Categoria</label>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-success" type="submit">Añadir</button>
                </div>
            </form>
        </div>
    {/if}
    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 py-4 bg-white">
        <h1>Listado de productos</h1>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                    <th>Detalle</th>
                    {if $userRol == 2}
                        <th>Editar</th>
                        <th>Borrar</th>
                    {/if}
                </tr>
            </thead>
            <tbody>
                {foreach from=$products item=$product}
                    <tr>
                        <td>{$product->marca}</td>
                        <td>{$product->modelo}</td>
                        <td>${$product->precio}</td>
                        <td><a href="product/{$product->id_producto}">+</a></td>
                        {if $userRol == 2}
                            <td><a href="editProduct/{$product->id_producto}">+</a></td>
                            <td><a href="deleteProduct/{$product->id_producto}">x</a></td>
                        {/if}
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>

{include file="footer.tpl"}