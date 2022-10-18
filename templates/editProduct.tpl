{include file="header.tpl" title='Editar producto'}
<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 py-4 h-100 p-5 text-bg-dark rounded-3">
    <h1>Editar Producto</h1>
    <form action="updateProduct/{$product->id_producto}" method="POST">
        <div class="form-floating text-dark mb-1">
            <input type="text" class="form-control" name="marca" value="{$product->marca}" autofocus />
            <input type="text" class="form-control" name="modelo" value="{$product->modelo}" autofocus />
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="text" class="form-control" aria-label="Amount" value="{$product->precio}">
            </div>
            <div class="form-floating mb-1">
                <select name="id_categoria" class="form-select">
                    {foreach from=$categories item=$category}
                        {if $category->id_categoria == $product->id_categoria}
                            <option value="{$category->id_categoria}" selected>{$category->nombre}</option>
                        {else}
                            <option value="{$category->id_categoria}">{$category->nombre}</option>
                        {/if}
                    {/foreach}
                </select>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>
{include file="footer.tpl"}