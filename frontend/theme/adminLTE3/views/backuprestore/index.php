<div class="backup-default-index">

    <?php
    $this->params ['breadcrumbs'] [] = [
        'label' => 'Base de Datos',
        'url' => array(
            'index'
        )
    ];
   $this->params['tittle'][]= 'Gestionar Salvas de Base de Datos';
    ?>

<div class="backup-default-index">





    <div class="row">
        <div class="col-md-12">
            <?php
            echo $this->render('_list', array(
                'dataProvider' => $dataProvider
            ));
            ?>
        </div>
    </div>

</div>
</div>