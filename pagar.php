<?php
include "global/config.php";
include 'global/conexion.php';
include "carrito.php";
include "templates/header.php";
?>

<?php
if ($_POST) {
	$sId = session_id();
	$total = 0;
	$correo = $_POST['email'];

	foreach ($_SESSION['CARRITO'] as $indice => $producto) {
		$total = $total + ($producto['cantidad']*$producto['precio']);
	}
	$sentencia = $pdo->prepare("INSERT INTO `tblventas`(`id`, `claveTransaccion`, `paypalDatos`, `fecha`, `correo`, `total`, `status`) 
		VALUES (NULL, :claveTransaccion, '', NOW(), :correo, :total, 'pendiente')");

	$sentencia->bindParam(':claveTransaccion',$sId);
	$sentencia->bindParam(':correo',$correo);
	$sentencia->bindParam(':total',$total);
	$sentencia->execute();
	$idVenta=$pdo->lastInsertId();

	foreach ($_SESSION['CARRITO'] as $indice => $producto) {

	$sentencia = $pdo->prepare(	"INSERT INTO `tbldetalleventa` (`id`, `idVenta`, `idProducto`, `precioUnitario`, `cantidad`, `descargado`) 
		VALUES (NULL, :idVenta, :idProducto, :precioUnitario, :cantidad, '0');");

		$sentencia->bindParam(':idVenta',$idVenta);
		$sentencia->bindParam(':idProducto',$producto['id']);
		$sentencia->bindParam(':precioUnitario',$producto['precio']);
		$sentencia->bindParam(':cantidad',$producto['cantidad']);
		$sentencia->execute();
	}

	//echo "<h3>".$total."</h3>";
}
?>
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }
    
</style>


<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con paypal la cantidad de:<br/>
    <h4>$<?php echo number_format($total,2); ?></h4>
    <div id="paypal-button-container"></div>    
    </p>

    <p>Los productos seran enviados una vez realizado el pago
    <strong>(para aclaraciones: chwilly98@gmail.com)</strong>
    </p>
</div>

<script>
    paypal.Button.render({
        env: 'sandbox', // sandbox | production
        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'blue'   // gold | blue | silver | black
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox:   'AUyLblKd2C9NhJo4T_7Ca1iRNGdsdxrbLAvYv46aLB9LFv4UlOgCyn3mBT4di7ziXmepvjHR2jjk7Nh3',
            production: 'AeqXaCrmxq2rSNnrcw13l_b61uXDkRSKe2-vN0TNlBn2jckfZGxtakB-DEYymDqYAU3QbJscqlNwuZRs'
        },

        // Wait for the PayPal button to be clicked

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $total;?>', currency: 'MXN' }, 
                            description:"Compra de productos a Develoteca:<?php echo number_format($total,2); ?>",
                            custom:"<?php echo $sId; ?>#<?php echo openssl_encrypt($idVenta, COD, KEY)?>"
                        }
                    ]
                }
            });
        },

        // Wait for the payment to be authorized by the customer

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                window.alert("Pyment complete");
                console.log(data);
                window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
            });
        }
    
    }, '#paypal-button-container');

</script>

<?php
include 'templates/footer.php';
?>