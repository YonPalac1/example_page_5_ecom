<?php
session_start();

$mensaje = "";

if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'Agregar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $id = openssl_decrypt($_POST['id'], COD, KEY);
                $mensaje.= "OK, id correcto".$id."<br />";
            } else {
                $mensaje.= "Error con el id".$id."<br />";
            }

            if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
                $nombre = openssl_decrypt($_POST['nombre'],COD,KEY);
                $mensaje.="Ok nombre".$nombre."<br />";
            } else {
                $mensaje.= "Ups, algo pasa con el nombre"."<br />";
            break;
            }

            if(is_string(openssl_decrypt($_POST['cantidad'],COD,KEY))){
                $cantidad = openssl_decrypt($_POST['cantidad'],COD,KEY);
                $mensaje.="Ok cantidad".$cantidad."<br />";
            } else {
                $mensaje.= "Ups, algo pasa con el cantidad"."<br />";
            break;
            }

            if(is_string(openssl_decrypt($_POST['precio'],COD,KEY))){
                $precio = openssl_decrypt($_POST['precio'],COD,KEY);
                $mensaje.="Ok precio".$precio."<br />";
            } else {
                $mensaje.= "Ups, algo pasa con el precio"."<br />";
            break;
            }
        
           if (!isset($_SESSION['CARRITO'])) {
               $producto = array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => $cantidad
               );
               $_SESSION['CARRITO'][0] = $producto;
               $mensaje = 'Producto agregado al carrito';
           } else {
                $idProductos = array_column($_SESSION['CARRITO'], 'id');
                if (in_array($id, $idProductos)) {
                    echo "<script>alert('Este producto ya fue agregado')</script>";
                } else {
                    $numeroProducto = count($_SESSION['CARRITO']);
                    $producto = array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => $cantidad
                    );
                    $_SESSION['CARRITO'][$numeroProducto] = $producto;
                    $mensaje = 'Producto agregado al carrito';
                }
           }

        break;
           case 'Eliminar':
               if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                   $id = openssl_decrypt($_POST['id'], COD, KEY);

                   foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                       if ($producto['id'] == $id) {
                           unset($_SESSION['CARRITO'][$indice]);
                           $mensaje = 'Este elemento va a ser eliminado';
                       } 
                   }
               } else {
                    echo "<script>'hubo un error con el ID...'</script>";
               }

               break;
    }
}


?>