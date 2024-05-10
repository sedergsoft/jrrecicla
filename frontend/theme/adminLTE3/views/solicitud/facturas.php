<?php
$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

?>
  <header >
    <table>
      <thead>
          <tr class="info">
            <th colspan="5" ><h1>SOLICITUD</h1></th>
            
            
          </tr>
        </thead>
        <tbody>
          <tr>

            <td>
              <div class="col-6" style="float: left;" >
                <div><span>ID SOLICITUD</span> </div>
                <div><span>CLIENTE</span> </div>
                <div><span>REP.</span> </div>
                <div><span>ADDRESS</span></div>
                <div><span>EMAIL</span></div>
                <div><span>FECHA SOL. </span> </div>
            </div>
          </td>
            <td>
                  
      <?php
      if($modelSolicitud)
      {
        $preciototal = 0;
        $canttotalprod = 0;
        
        ?>
              <div class="col-6" style="float: left;" >
                <div><?=$modelSolicitud->id?></div>
                <div><?=$modelSolicitud->cliente->instalacion?></div>
                <div><?=$modelSolicitud->cliente->representante?></div>
                <div><?=$modelSolicitud->cliente->direccion?></div>
                <div> <?=$modelSolicitud->cliente->email?></div>
                <div><?=$modelSolicitud->fecha_solic?></div>
            </div>
                        <?php
      }
      ?>
          </td>
          
          <td>
            
                <div class="float-right float-end pull-right" >
                  <div>Reyciklando App</div>
                  <div>reyciklando.reciclaje.cu</div>
                
                  <div><a href="mailto:reyciklando@gmail.com">reyciklando@gmail.com</a></div>
                </div>
          </td>

            </tr>
        </tbody>
    </table>
      
    </header>
  
  
      <table class="table table-bordered table-striped ">
        <thead>
          <tr class="info">
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
                            <td  class="service"><?=$producto->productos->producto?></td>
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
                        <tr class="success">
                          
                          <th colspan="2" >T.PRODUCTO</th>
                            <th class="service">CANT DE PRODUCTOS</th>
                            <th>CANT X PROD (g)</th>
                            <th colspan="2">CANT TOTAL(g)</th>
                           
                        </tr>
                        </thead>
                        <?php
                        foreach ($tipoProductosproducto as $key => $tipo) 
                        {
                           
                           if($tipo->productosid ==$producto->productosid)
                           {
                            ?>
                                <tr>
                                 
                                    <td colspan="2"  class="service"><?=$tipo->tipoProducto->tipo?></td>
                                   
                                    <td class="unit"><?=$producto->cant?></td>
                                    <td class="unit"><?=$tipo->cant?></td>
                                    <td colspan="2" class="unit"><?=$tipo->cant*$producto->cant?></td>
                                </tr>
                               

                            <?php
                            $cantpro+= $tipo->cant*$producto->cant;
                           }
                            
                        }
                        ?>
                        <tr class="warning">
                        
                        <td colspan="4" class="service">Cantidad Total de Productos (g)</td>
                       
                        
                        <td class="unit"><?=$cantpro?></td>
                    </tr>
                    <?php
                        $canttotalprod+= $cantpro;
                       }
                    }
                } 
            ?>  
        
          
       
          <tr class="info">
            <td colspan="4"><strong>CANTIDAD TOTAL DE PRODUCTOS</strong></td>
            <td class="total"><strong><?=$canttotalprod?></strong></td>
          </tr>
          <tr class="info">
            <td colspan="4"><strong> TOTAL</strong></td>
            <td ><strong><?=$preciototal?></strong></td>
          </tr>
        </tbody>
      </table>
  