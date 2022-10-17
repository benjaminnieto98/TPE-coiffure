{include file="header.tpl" title=$product->marca}

<div class="flexColumna">
  <h1 id="marcaProducto" data-id="{$product->id_producto}" data-rol="{$userRol}">{$product->marca}</h1>
  <section class="producto">
    <p><span class="resaltado">MODELO:</span> {$product->modelo}</p>
    <div class="flexSpaceAround">
      <p><span class="resaltado">CATEGORIA:</span> {$product->categoria}</p>
      <p><span class="resaltado">PRECIO:</span> ${$product->precio}</p>
    </div>
  </section>
</div>
{include file="footer.tpl"}