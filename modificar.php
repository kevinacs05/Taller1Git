<?php
require_once 'producto.entidad.php';
require_once 'producto.model.php';

// Logica
$pro = new Producto();
$model = new ProductoModel();

if(isset($_REQUEST['action']))
{
    switch($_REQUEST['action'])
    {
        case 'actualizar':
            $pro->__SET('IDProducto',                    $_REQUEST['IDProducto']);
            $pro->__SET('DescripcionPro',                $_REQUEST['DescripcionPro']);
            $pro->__SET('PrecioUnitarioPro',             $_REQUEST['PrecioUnitarioPro']);
            $pro->__SET('ObservPro',                     $_REQUEST['ObservPro']);
            $pro->__SET('Productocol',                   $_REQUEST['Productocol']);
            $pro->__SET('TamanoPresentacion_IdTamanoPresentacion',    $_REQUEST['TamanoPresentacion_IdTamanoPresentacion']);
            $pro->__SET('TipoProducto_IdTipoProducto',    $_REQUEST['TipoProducto_IdTipoProducto']);

            $model->Actualizar($pro);
            header('Location: modificar.php');
            break;

        case 'registrar':
            $pro->__SET('IDProducto',                    $_REQUEST['IDProducto']);
            $pro->__SET('DescripcionPro',                $_REQUEST['DescripcionPro']);
            $pro->__SET('PrecioUnitarioPro',             $_REQUEST['PrecioUnitarioPro']);
            $pro->__SET('ObservPro',                     $_REQUEST['ObservPro']);
            $pro->__SET('Productocol',                   $_REQUEST['Productocol']);
            $pro->__SET('TamanoPresentacion_IdTamanoPresentacion',    $_REQUEST['TamanoPresentacion_IdTamanoPresentacion']);
            $pro->__SET('TipoProducto_IdTipoProducto',    $_REQUEST['TipoProducto_IdTipoProducto']);

            $model->Registrar($pro);
            header('Location: modificar.php');
            break;

        case 'eliminar':
            $model->Eliminar($_REQUEST['IDProducto']);
            header('Location: mensaje3.php');
            break;

        case 'editar':
            $pro = $model->Obtener($_REQUEST['IDProducto']);
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>CRUD Producto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="">
      <h2>Registro Producto.</h2>
      <form class="form-horizontal" action="?action=<?php echo $pro->IDProducto > 0 ? 'actualizar' : 'registrar'; ?>" method="post"">
        <input type="hidden" name="IDProducto" value="<?php echo $pro->__GET('IDProducto'); ?>" />
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Id Producto:</label>
          <div class="col-sm-10">
            <input type="text" name="IDProducto" value="<?php echo $pro->__GET('IDProducto'); ?>"  />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Descripcion Producto:</label>
          <div class="col-sm-10">          
            <input type="text" name="DescripcionPro" value="<?php echo $pro->__GET('DescripcionPro'); ?>"  />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Precio Unitario:</label>
          <div class="col-sm-10">          
            <input type="text" name="PrecioUnitarioPro" value="<?php echo $pro->__GET('PrecioUnitarioPro'); ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Observacion:</label>
          <div class="col-sm-10">          
            <input type="text" name="ObservPro" value="<?php echo $pro->__GET('ObservPro'); ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Producto Col:</label>
          <div class="col-sm-10">          
            <input type="text" name="Productocol" value="<?php echo $pro->__GET('Productocol'); ?>"  />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Tipo Producto:</label>
          <div class="col-sm-10">          
            <input type="text" name="TipoProducto_IdTipoProducto" value="<?php echo $pro->__GET('TipoProducto_IdTipoProducto'); ?>"  />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Tamaño-Presentacion:</label>
          <div class="col-sm-10">          
            <input type="text" name="TamanoPresentacion_IdTamanoPresentacion" value="<?php echo $pro->__GET('TamanoPresentacion_IdTamanoPresentacion'); ?>"  />
          </div>
        </div>
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Enviar</button>
          </div>
        </div>
      </form>
    </div>    
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Descripcion Pro</th>
                        <th>Precio Unitario</th>
                        <th>Observacion</th>
                        <th>Producto Col</th>
                        <th>Tamaño-Presentacion</th>
                        <th>Tipo Producto</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <?php foreach($model->Listar() as $r): ?>
                    <tr>
                        <td><?php echo $r->__GET('DescripcionPro'); ?></td>
                        <td><?php echo $r->__GET('PrecioUnitarioPro'); ?></td>
                        <td><?php echo $r->__GET('ObservPro'); ?></td>
                        <td><?php echo $r->__GET('Productocol'); ?></td>
                        <td><?php echo $r->__GET('TamanoPresentacion_IdTamanoPresentacion'); ?></td>
                        <td><?php echo $r->__GET('TipoProducto_IdTipoProducto'); ?></td>
                        <td>
                            <a href="?action=editar&IDProducto=<?php echo $r->IDProducto; ?>">Editar</a>
                        </td>
                        <td>
                            <a href="?action=eliminar&IDProducto=<?php echo $r->IDProducto; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>        
    </div>
</body>
</html>