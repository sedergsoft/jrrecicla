
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tipo de Producto</th>
      <th scope="col">Cantidad de Productos</th>
      <th scope="col">Cantidad x Producto (g)</th>
      <th scope="col">Cantidad Total (g)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $total =0;
  foreach ($dataProviderprod as $key => $producto) 
  {
    ?>
    <tr>
      <th scope="row"><?=$key+1?></th>
      <td><?=$producto->tipoProducto->tipo?></td>
      <td><?=$cant?></td>
      <td><?=$producto->cant?></td>
      <td><?=$producto->cant*$cant?></td>
    </tr>
    <?php
    $total += $producto->cant*$cant;
  }
  ?>
   <tr class="table-danger">
     <th scope="row "></th>
     <td colspan="3"><strong> Cantidad total de Productos</strong></td>
     <td ><strong><?=$total?></strong></td>
   </tr>
   
  
  </tbody>
</table>
</div>
