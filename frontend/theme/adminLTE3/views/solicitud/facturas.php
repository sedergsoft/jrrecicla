<?php
$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

?>
  <header >
      <div >
        <img style="<?=$assetDir."/img/logoReyciklando.png"?>">
      </div>
      <h1>SOLICITUD</h1>
      <div >
        <div>Reyciklando App</div>
        <div>reyciklando.reciclaje.cu</div>
       
        <div><a href="mailto:reyciklando@gmail.com">reyciklando@gmail.com</a></div>
      </div>
      <?php
      if($modelSolicitud)
      {
        $preciototal = 0;
        $canttotalprod = 0;
        
        ?>
            <div >
                <div><span>ID SOLICITUD</span> <?=$modelSolicitud->id?></div>
                <div><span>CLIENTE</span> <?=$modelSolicitud->cliente->instalacion?></div>
                <div><span>REP.</span> <?=$modelSolicitud->cliente->representante?></div>
                <div><span>ADDRESS</span> <?=$modelSolicitud->cliente->direccion?></div>
                <div><span>EMAIL</span> <?=$modelSolicitud->cliente->email?></div>
                <div><span>FECHA SOL. </span> <?=$modelSolicitud->fecha_solic?></div>
            </div>
        <?php
      }
      ?>
    </header>
  
  
      <table >
        <thead>
          <tr>
            <th >PRODUCTO</th>
            <th >DESCRIPTION</th>
            <th>PRECIO</th>
            <th>CANT</th>
            <th>PRECIO TOTAL</th>
            
          </tr>
        </thead>
        <tbody>
            <?php
                if($modelProductos)
                {
                    foreach ($modelProductos as $key => $producto) 
                    {
                        $cantpro = 0;
                        $preciototal+= $producto->productos->precio*$producto->cant;
                       ?>
                       <tr>
                            <td class="service"><?=$producto->productos->producto?></td>
                            <td class="service"><?=$producto->productos->descripcion?></td>
                            <td class="unit"> $ <?=$producto->productos->precio?></td>
                            <td class="qty"><?=$producto->cant?></td>
                            <td class="total">$ <?=$producto->productos->precio*$producto->cant?></td>
                        </tr>
                       <?php
                       if($tipoProductosproducto)
                       {
                      
                        ?>
                        <thead>
                        <tr>
                          <th  class="service"></th>
                          <th  class="service">T.PRODUCTO</th>
                            <th class="service">CANT DE PRODUCTOS</th>
                            <th>CANT X PROD (g)</th>
                            <th>CANT TOTAL(g)</th>
                           
                        </tr>
                        </thead>
                        <?php
                        foreach ($tipoProductosproducto as $key => $tipo) 
                        {
                           
                           if($tipo->productosid ==$producto->productosid)
                           {
                            ?>
                                <tr>
                                    <td class="desc"></td>
                                    <td class="service"><?=$tipo->tipoProducto->tipo?></td>
                                   
                                    <td class="unit"><?=$producto->cant?></td>
                                    <td class="unit"><?=$tipo->cant?></td>
                                    <td class="unit"><?=$tipo->cant*$producto->cant?></td>
                                </tr>
                               

                            <?php
                            $cantpro+= $tipo->cant*$producto->cant;
                           }
                            
                        }
                        ?>
                        <tr>
                        <td colspan="1" class="desc"></td>
                        <td colspan="3" class="service">Cantidad Total de Productos (g)</td>
                       
                        
                        <td class="unit"><?=$cantpro?></td>
                    </tr>
                    <?php
                        $canttotalprod+= $cantpro;
                       }
                    }
                } 
            ?>  
        
          
       
          <tr>
            <td colspan="4">CANTIDAD TOTAL DE pRODUCTOS</td>
            <td class="total"><?=$canttotalprod?></td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">PRECIO TOTAL</td>
            <td class="grand total">$<?=$preciototal?></td>
          </tr>
        </tbody>
      </table>
  