<?php 

class ProductoModel {
	private $pdo;

    public function __CONSTRUCT()
    {
        try
        {
            $this->pdo = new PDO('mysql:host=localhost;dbname=pvp1', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Listar()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM producto");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $pro= new Producto();

                $pro->__SET('IDProducto',                              $r->IDProducto);
                $pro->__SET('DescripcionPro',                          $r->DescripcionPro);
                $pro->__SET('PrecioUnitarioPro',                       $r->PrecioUnitarioPro);
                $pro->__SET('ObservPro',                               $r->ObservPro);
                $pro->__SET('Productocol',                             $r->Productocol);
                $pro->__SET('TamanoPresentacion_IdTamanoPresentacion', $r->TamanoPresentacion_IdTamanoPresentacion);
                $pro->__SET('TipoProducto_IdTipoProducto',             $r->TipoProducto_IdTipoProducto);

                $result[] = $pro;
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Obtener($IDProducto)
    {
        try 
        {
            $stm = $this->pdo->prepare("SELECT * FROM producto WHERE IDProducto = ?");
                      

            $stm->execute(array($IDProducto));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $pro = new Producto();

                $pro->__SET('IDProducto',                              $r->IDProducto);
                $pro->__SET('DescripcionPro',                          $r->DescripcionPro);
                $pro->__SET('PrecioUnitarioPro',                       $r->PrecioUnitarioPro);
                $pro->__SET('ObservPro',                               $r->ObservPro);
                $pro->__SET('Productocol',                             $r->Productocol);
                $pro->__SET('TamanoPresentacion_IdTamanoPresentacion', $r->TamanoPresentacion_IdTamanoPresentacion);
                $pro->__SET('TipoProducto_IdTipoProducto',             $r->TipoProducto_IdTipoProducto);

            return $pro;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Eliminar($IDProducto)
    {
        try 
        {
            $stm = $this->pdo->prepare("DELETE FROM producto WHERE IDProducto= ?");                      

            $stm->execute(array($IDProducto));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Registrar(Producto $data)
    {
        try 
        {
        $sql = "INSERT INTO producto (IDProducto,DescripcionPro,PrecioUnitarioPro,ObservPro,Productocol,TamanoPresentacion_IdTamanoPresentacion,TipoProducto_IdTipoProducto) VALUES (?,?,?,?,?,?,?)";

        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('IDProducto'), 
                $data->__GET('DescripcionPro'), 
                $data->__GET('PrecioUnitarioPro'),
                $data->__GET('ObservPro'),
                $data->__GET('Productocol'),
                $data->__GET('TamanoPresentacion_IdTamanoPresentacion'),
                $data->__GET('TipoProducto_IdTipoProducto')
                )
            );
			
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Actualizar(Producto $data)
    {
        try 
        {
            $sql = "UPDATE producto SET 
                        DescripcionPro                                 = ?, 
                        PrecioUnitarioPro                              = ?,
                        ObservPro                                      = ?, 
                        Productocol                                    = ?,
                        TamanoPresentacion_IdTamanoPresentacion        = ?,
                        TipoProducto_IdTipoProducto                    = ?
                    WHERE IDProducto = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->__GET('DescripcionPro'), 
                    $data->__GET('PrecioUnitarioPro'), 
                    $data->__GET('ObservPro'),
                    $data->__GET('Productocol'),
                    $data->__GET('TamanoPresentacion_IdTamanoPresentacion'),
                    $data->__GET('TipoProducto_IdTipoProducto'),
                    $data->__GET('IDProducto')
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
?>