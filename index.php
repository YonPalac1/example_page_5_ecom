<?php
include "global/config.php";
include "global/conexion.php";
include "carrito.php";
include "templates/header.php";
?>
    <?php if ($mensaje!="") { ?>
      <div class="alert alert-success mt-3">
      <?php echo $mensaje; ?>
      
      <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
    </div>
    <?php } ?>

    <div class="row">
      <?php 
        $sentencia = $pdo->prepare("SELECT * FROM `tiendaOnline`");
        $sentencia->execute();
        $listaProductos = $sentencia->fetchAll(pdo::FETCH_ASSOC);
      ?>
      <?php foreach ($listaProductos as $producto) { ?>
        
        <div class="container">
           <div class="row bg-white mb-3 p-3">
            <div class="col-3">
              <img data-toggle="popover" 
                data-trigger="hover"  
                data-content="<?php echo $producto['descripcion']?>"
                title="<?php echo $producto['nombre'];?>"
                alt="<?php echo $producto['nombre'];?>"
                class="card-img-top"
                src="<?php echo $producto['imagen']?>" alt=""
                height="317px"
              >
            </div>
            <div class="col-sm">
              <h3><?php echo $producto['nombre'];?></h3>
              <p class="card-text"><?php echo $producto['descripcion']?></p>
            </div>

              <div class="col-sm">

              <span class="bg-secondary text-white p-1">HASTA 6 CUOTAS S/I</span>
              <span class="bg-danger text-white p-1">-9%</span>
              <h5 class="card-title mt-3">$<?php echo $producto['precio'];?></h5>
                <form action="" method="post">
                  <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'],COD,KEY) ;?>">
                  <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'],COD,KEY) ;?>">
                  <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'],COD,KEY) ;?>">
                  <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY) ;?>">
                  <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                </form>
              </div>
          </div>
        </div>

    <?php }?>


<?php
include "templates/footer.php";
?>