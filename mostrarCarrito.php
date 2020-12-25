<?php
include "global/config.php";
include "carrito.php";
include "templates/header.php";
?>
<br>
<h3>Lista del carrito</h3>


<?php if ($mensaje!="") { ?>
      <div class="alert alert-danger mt-3">
      <?php echo $mensaje; ?>
      
    </div>
    <?php } ?>
<?php if(!empty($_SESSION['CARRITO'])){ ?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th width="40%">Descripcion</th>
            <th width="5%">id</th>
            <th width="5%" class="text-center">Cantidad</th>
            <th width="20%"class="text-center">Precio</th>
            <th width="20%"class="text-center">Total</th>
            <th width="5%">--</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){ ?>
        <tr>
            <td width="40%"><?php echo $producto['nombre'] ?></td>
            <td width="5%"><?php echo $producto['id'] ?></td>
            <td width="10%"class="text-center"><?php echo $producto['cantidad'] ?></td>
            <td width="20%"class="text-center"><?php echo $producto['precio'] ?></td>
            <td width="20%"class="text-center"><?php echo number_format($producto['precio']*$producto['cantidad'], 2); ?></td>
            <td width="5%">
                <form action="" method="post">

                <input
                 type="hidden"
                  name="id"
                   id="id" 
                   value="<?php echo openssl_encrypt($producto['id'],COD,KEY) ;?>">

                    <button 
                    class="btn btn-danger" 
                    type="submit"
                    name="btnAccion"
                    value="Eliminar"
                    >Eliminar</button>
                </form>
            </td>
        </tr>
        <?php $total=$total + ($producto['precio']*$producto['cantidad']);?>
        <?php } ?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td colspan="3" align="right"><h3>$<?php echo number_format($total,2); ?></h3></td>
            
        </tr>

        <td colspan="6">
            <form action="pagar.php" method="post">
                <div class="alert alert-success">
                    <div class="form-group">
                        <label for="my-input"></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Por favor ingrese su email" required>
                    </div>
                    <small id="emailHelp" class="form-text text-muted">
                        Los productos se enviaran a este email
                    </small>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit" value="Proceder" name="btnAccion">
                    Proceder a pagar >>>
                </button>
            </form>
        </td>
    </tbody>
</table>


<?php } else { ?>
     <div class="alert alert-success">
         No hay productos en el carrito...
         <a href="index.php" class="badge badge-success">Ir a la tienda</a>
     </div>
<?php } ?> 

<?php
include "templates/footer.php";
?>