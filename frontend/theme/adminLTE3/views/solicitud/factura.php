<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Compra</title>
</head>
<body>
    <h1>Factura de Compra</h1>
    
    <h2>Datos del Comprador</h2>
    <p>Nombre: Juan Pérez</p>
    <p>Dirección: Calle Principal 123</p>
    <p>Ciudad: Ciudad de Ejemplo</p>
    
    <h2>Detalles de la Compra</h2>
    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>Producto 1</td>
            <td>2</td>
            <td>$10.00</td>
            <td>$20.00</td>
        </tr>
        <tr>
            <td>Producto 2</td>
            <td>1</td>
            <td>$15.00</td>
            <td>$15.00</td>
        </tr>
        <tr>
            <td colspan="3">Total</td>
            <td>$35.00</td>
        </tr>
    </table>
    
    <button onclick="exportToPdf()">Exportar a PDF</button>

    <script>
        function exportToPdf() {
            // Lógica para exportar la factura a PDF
            // Puedes utilizar una librería como jsPDF para generar el PDF
        }
    </script>


<div id="w0-container" class="kv-container-bs4 kv-flat-b">
    <div class="card border-info">
        <div class="card-header bg-info text-dark">
            <div class="float-right float-end pull-right">
                <span class="kv-buttons-1"> </span>
            </div>
            <h5 class="m-0">Solicitud - No.<?=$modelSolicitud->id?></h5>
            <div class="clearfix"></div>
        </div>
        <div class="kv-panel-before">
            <div class="card-body kv-alert-container" style="display:none;">
            </div>
        </div>
        <div class="kv-detail-view table-responsive">
            <table id="w0" class="table table-sm table-hover table-bordered table-striped detail-view" data-krajee-kvdetailview="kvDetailView_3bb76958">
                <tbody>
                    <tr>
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Cliente</th>
                        <td>
                            <div class="kv-attribute"><?=$modelSolicitud->cliente->instalacion?>
                            </div>
                        </td>
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Cadena</th>
                        <td>
                            <div class="kv-attribute"><?=$modelSolicitud->cliente->grupoHotelero->grupo?>
                            </div>
                        </td>
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Dirección</th>
                        <td>
                            <div class="kv-attribute"><?=$modelSolicitud->cliente->direccion?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Representante
                        </th>
                        <td>
                            <div class="kv-attribute"><?=$modelSolicitud->cliente->representante?>
                        </div>
                        </td>
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Email
                        </th>
                        <td>
                            <div class="kv-attribute"><?=$modelSolicitud->cliente->email?>
                            </div>
                        </td>
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Telefono
                        </th>
                        <td>
                            <div class="kv-attribute"><?=$modelSolicitud->cliente->telefono?>
                            </div>
                        </td>
                       
                </tr>
                <th style="width: 20%; text-align: right; vertical-align: middle;">Fecha de Solicitada
                        </th>
                        <td>
                            <div class="kv-attribute"><?=$modelSolicitud->fecha_solic?>
                            </div>
                        </td>
                    <!-- <tr class="kv-view-hidden"> -->
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Fecha de Recepción</th>
                        <td>
                            <div class="kv-attribute"><span class="not-set"><?=$modelSolicitud->fecha_rec?$modelSolicitud->fecha_rec:''?></span></div>
                        </td>
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Fecha de Aprobación</th>
                        <td>
                            <div class="kv-attribute"><?=$modelSolicitud->fecha_aprob?$modelSolicitud->fecha_aprob:''?></div>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Fecha de Ejececución</th>
                        <td  colspan="2">
                            <div class="kv-attribute"><span class="not-set"><?=$modelSolicitud->fecha_ejec?$modelSolicitud->fecha_ejec:''?></span></div>
                        </td>
                        <th style="width: 20%; text-align: right; vertical-align: middle;">Estado de Solicitud</th>
                        <td colspan="2">
                            <div class="kv-attribute">Aprobado</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="w2-pjax" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000"><div class="kv-loader-overlay"><div class="kv-loader"></div></div><div id="w2" class="grid-view is-bs4 kv-grid-bs4 kv-grid-panel hide-resize" data-krajee-grid="kvGridInit_8bae1b86" data-krajee-ps="ps_w2_container"><div class="card border-info"><div class="card-header bg-info text-dark">    <div class="float-right"><div class="summary">Mostrando <b>1-1</b> de <b>1</b> elemento.</div></div>
    <h5 class="m-0"><h4 class="panel-title"><i class="fa fa fa-address-book"></i> Productos (Solicitud - No.8) </h4></h5>
    <div class="clearfix"></div></div>
<div class="kv-panel-before">    <div class="btn-toolbar kv-grid-toolbar toolbar-container float-right">

<div id="w4" class="dropdown-menu dropdown-menu-right"><li role="presentation" class="dropdown-header">Exportar los Datos de esta Página</li>
<a class="export-html dropdown-item" href="#" data-mime="text/plain" data-hash="56fcdf16d18da8423b1472a2d9bab44ecbe2ba407f5437d08cfd02a3f3d89873gridviewexportar-cuadrículatext/plainutf-811{&quot;cssFile&quot;:[&quot;https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css&quot;,&quot;https://use.fontawesome.com/releases/v5.3.1/css/all.css&quot;]}" data-hash-export-config="1" data-css-styles='{".kv-group-even":{"background-color":"#f0f1ff"},".kv-group-odd":{"background-color":"#f9fcff"},".kv-grouped-row":{"background-color":"#fff0f5","font-size":"1.3em","padding":"10px"},".kv-table-caption":{"border":"1px solid #ddd","border-bottom":"none","font-size":"1.5em","padding":"8px"},".kv-table-footer":{"border-top":"4px double #ddd","font-weight":"bold"},".kv-page-summary td":{"background-color":"#ffeeba","border-top":"4px double #ddd","font-weight":"bold"},".kv-align-center":{"text-align":"center"},".kv-align-left":{"text-align":"left"},".kv-align-right":{"text-align":"right"},".kv-align-top":{"vertical-align":"top"},".kv-align-bottom":{"vertical-align":"bottom"},".kv-align-middle":{"vertical-align":"middle"},".kv-editable-link":{"color":"#428bca","text-decoration":"none","background":"none","border":"none","border-bottom":"1px dashed","margin":"0","padding":"2px 1px"}}'><i class="text-info fas fa-file-alt"></i> HTML</a>
<a class="export-csv dropdown-item" href="#" data-mime="application/csv" data-hash="665f79e654387d51f63486d8a86c7c22d47aea2597e2ce0860e41d4a4ce76d08gridviewexportar-cuadrículaapplication/csvutf-811{&quot;colDelimiter&quot;:&quot;,&quot;,&quot;rowDelimiter&quot;:&quot;\r\n&quot;}" data-hash-export-config="1" data-css-styles='[]'><i class="text-primary fas fa-file-code"></i> CSV</a>
<a class="export-txt dropdown-item" href="#" data-mime="text/plain" data-hash="9fe57c2de51275f6f6c21a34881363e3dc1eba9679d4f670bce6276882baa475gridviewexportar-cuadrículatext/plainutf-811{&quot;colDelimiter&quot;:&quot;\t&quot;,&quot;rowDelimiter&quot;:&quot;\r\n&quot;}" data-hash-export-config="1" data-css-styles='[]'><i class="text-muted far fa-file-alt"></i> Texto</a>
<a class="export-xls dropdown-item" href="#" data-mime="application/vnd.ms-excel" data-hash="f1d43823c97ccc31d974875ee9b9b784f50baa6640f133c3d6d48cb15ae10643gridviewexportar-cuadrículaapplication/vnd.ms-excelutf-811{&quot;worksheet&quot;:&quot;Exportar Hoja de Trabajo&quot;,&quot;cssFile&quot;:&quot;&quot;}" data-hash-export-config="1" data-css-styles='{".kv-group-even":{"background-color":"#f0f1ff"},".kv-group-odd":{"background-color":"#f9fcff"},".kv-grouped-row":{"background-color":"#fff0f5","font-size":"1.3em","padding":"10px"},".kv-table-caption":{"border":"1px solid #ddd","border-bottom":"none","font-size":"1.5em","padding":"8px"},".kv-table-footer":{"border-top":"4px double #ddd","font-weight":"bold"},".kv-page-summary td":{"background-color":"#ffeeba","border-top":"4px double #ddd","font-weight":"bold"},".kv-align-center":{"text-align":"center"},".kv-align-left":{"text-align":"left"},".kv-align-right":{"text-align":"right"},".kv-align-top":{"vertical-align":"top"},".kv-align-bottom":{"vertical-align":"bottom"},".kv-align-middle":{"vertical-align":"middle"},".kv-editable-link":{"color":"#428bca","text-decoration":"none","background":"none","border":"none","border-bottom":"1px dashed","margin":"0","padding":"2px 1px"}}'><i class="text-success far fa-file-excel"></i> Excel</a>
<a class="export-pdf dropdown-item" href="#" data-mime="application/pdf" data-hash="66154f0ad4f5a5204fcf792844b3b33a74a03413556877b5b7196ef6a8511170gridviewReyciklando-Exportapplication/pdfutf-811{&quot;mode&quot;:&quot;UTF-8&quot;,&quot;format&quot;:&quot;A4-L&quot;,&quot;destination&quot;:&quot;D&quot;,&quot;marginTop&quot;:20,&quot;marginBottom&quot;:20,&quot;cssInline&quot;:&quot;.kv-wrap{padding:20px}&quot;,&quot;methods&quot;:{&quot;SetHeader&quot;:[{&quot;odd&quot;:{&quot;L&quot;:{&quot;content&quot;:&quot;&lt;img src=\&quot;/jrrecicla/frontend/web/assets/f24771d2/img/logoReyciklando.png\&quot; alt=\&quot;\&quot; style=\&quot;margin-bottom: 5px;\&quot;&gt;&quot;},&quot;C&quot;:{&quot;content&quot;:&quot;Reyciklando Export&quot;,&quot;font-size&quot;:10,&quot;color&quot;:&quot;#333333&quot;},&quot;R&quot;:{&quot;content&quot;:&quot;Generado: Mon, 06-May-2024&quot;,&quot;font-size&quot;:8,&quot;color&quot;:&quot;#333333&quot;}},&quot;even&quot;:{&quot;L&quot;:{&quot;content&quot;:&quot;&lt;img src=\&quot;/jrrecicla/frontend/web/assets/f24771d2/img/logoReyciklando.png\&quot; alt=\&quot;\&quot; style=\&quot;margin-bottom: 5px;\&quot;&gt;&quot;},&quot;C&quot;:{&quot;content&quot;:&quot;Reyciklando Export&quot;,&quot;font-size&quot;:10,&quot;color&quot;:&quot;#333333&quot;},&quot;R&quot;:{&quot;content&quot;:&quot;Generado: Mon, 06-May-2024&quot;,&quot;font-size&quot;:8,&quot;color&quot;:&quot;#333333&quot;}}}],&quot;SetFooter&quot;:[{&quot;odd&quot;:{&quot;L&quot;:{&quot;content&quot;:&quot;© Reyciklando App&quot;,&quot;font-size&quot;:8,&quot;font-style&quot;:&quot;B&quot;,&quot;color&quot;:&quot;#999999&quot;},&quot;R&quot;:{&quot;content&quot;:&quot;[ {PAGENO} ]&quot;,&quot;font-size&quot;:10,&quot;font-style&quot;:&quot;B&quot;,&quot;font-family&quot;:&quot;serif&quot;,&quot;color&quot;:&quot;#333333&quot;},&quot;line&quot;:true},&quot;even&quot;:{&quot;L&quot;:{&quot;content&quot;:&quot;© Reyciklando App&quot;,&quot;font-size&quot;:8,&quot;font-style&quot;:&quot;B&quot;,&quot;color&quot;:&quot;#999999&quot;},&quot;R&quot;:{&quot;content&quot;:&quot;[ {PAGENO} ]&quot;,&quot;font-size&quot;:10,&quot;font-style&quot;:&quot;B&quot;,&quot;font-family&quot;:&quot;serif&quot;,&quot;color&quot;:&quot;#333333&quot;},&quot;line&quot;:true}}]},&quot;options&quot;:{&quot;title&quot;:&quot;Reyciklando Export&quot;,&quot;subject&quot;:&quot;PDF Generado por Reyciklando App&quot;,&quot;keywords&quot;:&quot;Reyciklando, krajee, grid, export, yii2-grid, pdf&quot;},&quot;contentBefore&quot;:&quot;&quot;,&quot;contentAfter&quot;:&quot;&quot;}" data-hash-export-config="1" data-css-styles='{".kv-group-even":{"background-color":"#f0f1ff"},".kv-group-odd":{"background-color":"#f9fcff"},".kv-grouped-row":{"background-color":"#fff0f5","font-size":"1.3em","padding":"10px"},".kv-table-caption":{"border":"1px solid #ddd","border-bottom":"none","font-size":"1.5em","padding":"8px"},".kv-table-footer":{"border-top":"4px double #ddd","font-weight":"bold"},".kv-page-summary td":{"background-color":"#ffeeba","border-top":"4px double #ddd","font-weight":"bold"},".kv-align-center":{"text-align":"center"},".kv-align-left":{"text-align":"left"},".kv-align-right":{"text-align":"right"},".kv-align-top":{"vertical-align":"top"},".kv-align-bottom":{"vertical-align":"bottom"},".kv-align-middle":{"vertical-align":"middle"},".kv-editable-link":{"color":"#428bca","text-decoration":"none","background":"none","border":"none","border-bottom":"1px dashed","margin":"0","padding":"2px 1px"}}'><i class="text-danger far fa-file-pdf"></i> PDF</a>
<a class="export-json dropdown-item" href="#" data-mime="application/json" data-hash="42daae19cb13dc55a770dedb654e3430f1c7dd6069decde6b42777d266da3f91gridviewexportar-cuadrículaapplication/jsonutf-811{&quot;colHeads&quot;:[],&quot;slugColHeads&quot;:false,&quot;indentSpace&quot;:4}" data-hash-export-config="1" data-css-styles='[]'><i class="text-warning far fa-file-code"></i> JSON</a></div></div></div>
    
    <div class="clearfix"></div></div>
<div id="w2-container" class="table-responsive kv-grid-container"><table class="kv-grid-table table table-bordered table-striped kv-table-wrap"><colgroup><col>
<col class="skip-export">
<col>
<col>
<col>
<col>
<col></colgroup>
<thead class="kv-table-header w2">
<tr><th>#</th><th class="kartik-sheet-style kv-align-center kv-align-middle skip-export kv-expand-header-cell kv-batch-toggle w2_61d33237 kv-merged-header" title="Expandir Todo" style="width:50px;" rowspan="2" data-col-seq="1"><div class='kv-expand-header-icon kv-state-expanded'><span class="far fa-plus-square"></span></div></th><th data-col-seq="2">Producto</th><th data-col-seq="3">Descripcion</th><th data-col-seq="4"><a href="/jrrecicla/frontend/web/solicitud/detalles?id=8&amp;sort=cant" data-sort="cant">Cant</a></th><th data-col-seq="5">Precio Unitario</th><th class="kv-align-right kv-align-middle kv-merged-header" style="width:150px;" rowspan="2" data-col-seq="6">Precio de Total (Producto)</th></tr><tr id="w2-filters" class="filters skip-export"><td>&nbsp;</td><td data-col-seq="2">&nbsp;</td><td data-col-seq="3">&nbsp;</td><td data-col-seq="4"><input type="text" class="form-control" name="ProductosSolicitudSearch[cant]"></td><td data-col-seq="5">&nbsp;</td></tr>
</thead>
<tbody>
<tr class="w2" data-key="11"><td>1</td><td class="skip-export kv-align-center kv-align-middle w2 kv-expand-icon-cell w2_61d33237" title="Expandir" style="width:50px;" data-col-seq="1">        <div class="kv-expand-row ">
            <div class="kv-expand-icon kv-state-init-collapsed"><span class="far fa-plus-square"></span></div>
            <div class="kv-expand-detail skip-export" style="display:none;">
                <div class="skip-export kv-expanded-row w2_61d33237" data-index="0" data-key="11">
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
      <tr>
      <th scope="row">1</th>
      <td>Plastico</td>
      <td>3</td>
      <td>4.00</td>
      <td>12</td>
    </tr>
        <tr>
      <th scope="row">2</th>
      <td>Cristal</td>
      <td>3</td>
      <td>0.20</td>
      <td>0.6</td>
    </tr>
        <tr>
      <th scope="row">3</th>
      <td>aluminio</td>
      <td>3</td>
      <td>0.75</td>
      <td>2.25</td>
    </tr>
       <tr class="table-danger">
     <th scope="row "></th>
     <td colspan="3"><strong> Cantidad total de Productos</strong></td>
     <td ><strong>14.85</strong></td>
   </tr>
   
  
  </tbody>
</table>
</div>
</div>
            </div>
        </div></td><td class="w2" data-col-seq="2">TV analogico</td><td class="w2" data-col-seq="3">Televisor analogico de 28 pulgadas</td><td class="w2" data-col-seq="4">3</td><td class="w2" data-col-seq="5">$ 234.23</td><td class="kv-align-right kv-align-middle w2" style="width:150px;" data-col-seq="6">$ 702.69</td></tr>
</tbody><tbody class="kv-page-summary-container"><tr class="table-warning kv-page-summary w2"><td></td><td class="kv-align-center kv-align-middle skip-export" style="width:50px;">&nbsp;</td><td class="text-right text-end">Total Solicitud</td><td>&nbsp;</td><td>3</td><td>&nbsp;</td><td class="kv-align-right kv-align-middle" style="width:150px;">$ 702.69</td></tr></tbody></table></div>
<div class="kv-panel-after"></div>
<div class="card-footer">    <div class="kv-panel-pager">
        
    </div>
    
    <div class="clearfix"></div></div></div></div></div>    </div>
<!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>


</body>
</html>