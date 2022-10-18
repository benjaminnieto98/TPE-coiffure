{include file="header.tpl" title='Editar Categoría'}
<h1>Editar Categoria</h1>
<form action="updateCategory/{$category->id_categoria}" method="POST">
    <div class="form-floating text-dark mb-1">
        <input type="text" class="form-control" name="nombre" value="{$category->nombre}" placeholder="Nombre" autofocus />
        <label for="categoria">Categoria</label>
    </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-success">Guardar</button>
    </div>
</form>
{include file="footer.tpl"}