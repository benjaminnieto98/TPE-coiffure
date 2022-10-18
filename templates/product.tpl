{include file="header.tpl"}

<div class="flexColumna">
    <section class="producto">
        <p><span class="resaltado">Marca:</span> {$product->marca}</p>
        <p><span class="resaltado">Modelo:</span> {$product->modelo}</p>
        <p><span class="resaltado">Precio:</span> ${$product->precio}</p>
    </section>
</div>

{include file="footer.tpl"}