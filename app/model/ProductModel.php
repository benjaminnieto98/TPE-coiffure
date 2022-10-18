<?php

class ProductModel
{

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db-coiffure;charset=utf8', 'root', '');
    }

    //DEVUELVE TODOS LOS PRODUCTOS AGREGANDO LA COLUMNA DEL NOMBRE DE LA CATEGORIA A LA QUE PERTENECE
    function getProducts()
    {
        $sentence = $this->db->prepare(
            "SELECT productos.*, categorias.nombre AS categoria
            FROM productos
            JOIN categorias ON productos.id_categoria = categorias.id_categoria"
        );
        $sentence->execute();
        $products = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    //DEVUELVE EL PORDUCTO CON EL ID PASADO POR PARAMETRO
    function getProduct($id_producto)
    {
        $sentence = $this->db->prepare(
            "SELECT productos.*, categorias.nombre AS categoria
            FROM productos
            JOIN categorias ON productos.id_categoria = categorias.id_categoria
            WHERE id_producto=?"
        );
        $sentence->execute(array($id_producto));
        $product = $sentence->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    //DEVUELVE LOS PRODUCTOS PERTENECIENTES A LA CATEGORIA PASADA POR PARAMETRO
    function getProductsCategory($id_category)
    {
        $sentence = $this->db->prepare(
            "SELECT productos.*, categorias.nombre AS categoria
            FROM productos
            JOIN categorias ON productos.id_categoria = categorias.id_categoria
            WHERE categorias.id_categoria=?"
        );
        $sentence->execute(array($id_category));
        $products = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    //AÑADE UN PRODUCTO
    function addProductToDB($marca, $modelo, $precio, $id_categoria)
    {
        $sentence = $this->db->prepare("INSERT INTO productos(marca, modelo, precio, id_categoria) VALUES(?,?,?,?)");
        $sentence->execute(array($marca, $modelo, $precio, $id_categoria));
    }

    //ACTUALIZA LOS DATOS DE UN PRODUCTO
    function updateProduct($id_product, $marca, $modelo, $precio, $id_categoria)
    {
        $sentence = $this->db->prepare("UPDATE productos SET marca=?, modelo=?, precio=?, id_categoria=? WHERE id_producto=?");
        $sentence->execute(array($marca, $modelo, $precio, $id_categoria, $id_product));
    }

    //ELIMINA EL PRODUCTO, YA POR DECISIÓN LA CLAVE FORÁNEA ESTA CONFIGURADA CON "ON DELETE CASCADE"
    function deleteProductFromDB($id_producto)
    {
        $sentence = $this->db->prepare("DELETE FROM `productos` WHERE id_producto=?");
        $sentence->execute(array($id_producto));
    }
}
