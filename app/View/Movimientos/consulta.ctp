
<?php
echo $this->Html->script('/spin/js/plugins/datapicker/bootstrap-datepicker.js');
echo $this->Html->script('/spin/js/plugins/daterangepicker/daterangepicker.js');
echo $this->Html->css('/spin/css/plugins/datapicker/datepicker3.css');
echo $this->Html->script('/spin/js/plugins/datapicker/locales/bootstrap-datepicker.es.min.js');
echo $this->Html->css('/spin/css/plugins/daterangepicker/daterangepicker-bs3.css');


 ?>

<div class="col-md-12">


    <div class="ibox float-e-margins">
      <div class="ibox-title ui-sortable-handle">
        <div class="row">
          <div class="col-md-12">
            <h3>Filtrar Movimientos</h3>
          </div>
        </div>
      </div>
      <div class="ibox-content">
        <?php echo $this->Form->create('Consulta'); ?>
        <div class="form-group">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <?php echo $this->Form->input('serie_equipo_id',array('placeholder'=>'Codigo del equipo','type'=>'text', 'class'=>'input-lg form-control','label'=>false)); ?>
            </div>
          </div>
        </div>

        <div class="form-group">
            <div class="row">
              <div class="col-md-5 col-md-offset-1">
                <?php echo $this->Form->input('identificacion',array('placeholder'=>'Identificacion', 'class'=>'input-lg form-control','label'=>false)); ?>
              </div>
              <div class="col-md-5 ">
                <?php echo $this->Form->input('nombre',array('placeholder'=>'Nombre y/o Apellido', 'class'=>'input-lg form-control','label'=>false)); ?>
              </div>
            </div>
          </div>


            <div class="form-group">
              <div class="row">
                <div class="col-md-5 col-md-offset-1">
                  <?php echo $this->Form->input('telefono',array('placeholder'=>'Telefono', 'class'=>'input-lg form-control','label'=>false)); ?>
                </div>
                <div class="col-md-5 ">
                  <?php echo $this->Form->input('marca',array('placeholder'=>'Marca o Modelo', 'class'=>'input-lg form-control','label'=>false)); ?>
                </div>
              </div>
            </div>
            <div class="form-group" id="data_5">

              <div class="col-md-8 col-md-offset-3">
                <h3 class="font-normal">Rangos de fechas</h3>
                <div class="form-group">
                    <div class="input-daterange input-group" id="datepicker">
                        <?php echo $this->Form->input('fecha_desde',array('class'=>'input-sm form-control', 'type'=>'text','label' => false));?>
                        <span class="input-group-addon">hasta</span>
                        <?php echo $this->Form->input('fecha_hasta',array('class'=>'input-sm form-control', 'type'=>'text','label' => false));?>
                    </div>
                </div>
                  <script type="text/javascript">

                    $('document').ready(function(){
                        $('.input-daterange').datepicker({
                          format: "yyyy-mm-dd",
                          language: "es",
                          autoclose: true
                      });
                    })
                  </script>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                  <?php
                  echo $this->Form->button('consulta', array('type' => 'submit', 'class'=>'btn btn-lg btn-primary','escape' => true));
                  echo $this->Html->link(
                        'Limpiar',
                        array(
                            'controller' => 'movimientos',
                            'action' => 'consulta'
                        ),
                        array(
                          'class'=>'btn btn-lg btn-white',
                        )
                    );

                   ?>
                </div>
                <?php if ($usuario_iniciado['role']=="admin"): ?>
                  <div class="col-md-2 col-md-offset-2">
                    <?php echo $this->Form->button('Reporte Filtrado', array('type' => 'submit', 'name'=>'reporte_filtrado','class'=>'btn btn-primary','escape' => true,'label'=>'Generar reporte filtrado')); ?>
                  </div>

                <?php endif; ?>
              </div>
            </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>


<?php if (!empty($todos)): ?>

    <div class="ibox float-e-margins">
      <div class="ibox-title ui-sortable-handle">
        <div class="row">
          <div class="col-md-12">
            <h3>Movimientos</h3>
          </div>
        </div>
        <div class="ibox-content">
          <div class="project-list">
        <table class="table table-hover">
            <thead>
              <tr>
                <?php echo "<th>" . $this->Paginator->sort('id', 'ID') . "</th>"; ?>
                <th><h3>Responsable</h3></th>
                <th><h3>Equipo</h3></th>
                <th><h3>Fecha Ingreso</h3></th>
                <th><h3>Fecha Salida</h3></th>
                <th><h3>Observacion</h3></th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($todos as $key => $value): ?>
                <tr>


                  <td class="project-completion">
                          <small><?php echo $todos[$key]["Movimiento"]["id"]; ?></small>
                  </td>
                    <td class="project-completion">
                        <?php echo $value['Responsable']['nombre']." ".$value['Responsable']['apellido'];?>
                        <br>
                        <small><?php echo "DI: ".$todos[$key]['Responsable']['identificacion'].' - TEL: '.$todos[$key]['Responsable']['telefono']; ?></small>
                    </td>
                    <td class="project-title">
                        Serial/Codigo: <?php echo $todos[$key]["Movimiento"]["serie_equipo_id"]; ?>
                        <br>
                        <small> <?php echo $todos[$key]['Equipo']['marca']."  ".$todos[$key]['Equipo']['modelo']; ?></small>
                    </td>
                    <td class="project-title">
                      <?php if ($todos[$key]["Movimiento"]["ingreso_fecha"]){?>
                        <span class="label label-primary"> Entrada</span><br>
                      <?php } ?>
                      <small> <?php echo $todos[$key]['Movimiento']['ingreso_fecha']; ?></small>
                    </td>
                    <td class="project-title">
                      <?php if ($todos[$key]["Movimiento"]["salida_fecha"]){?>
                        <span class="label label-warning"> Salida</span><br>
                      <?php } ?>
                      <small> <?php echo $todos[$key]['Movimiento']['salida_fecha']; ?></small>
                    </td>
                    <td class="project-completion">
                            <small><?php echo $todos[$key]["Movimiento"]["observacion"]; ?></small>
                    </td>
                </tr>

              <?php endforeach; ?>
              <?php echo $this->Form->end(); ?>

              </tbody>
            </table>
          </div>




          <?php
              echo "<center><div class='btn-group'>";

                  // the 'first' page button
                  //echo $this->Paginator->first("First");
                  echo $this->Paginator->first('<<', array(
                      'escape' => false,
                      'tag' => 'button',
                      'class' => 'btn btn-white',
                    ));




                  // 'prev' page button,
                  // we can check using the paginator hasPrev() method if there's a previous page
                  // save with the 'next' page button
                  if($this->Paginator->hasPrev()){
                      //echo $this->Paginator->prev('<button type="button" class="btn btn-white"><i class="fa fa-angle-left"></i></button>',  array('escape' => false));
                      echo $this->Paginator->prev('<', array(
                          'escape' => false,
                          'tag' => 'button',
                          'class' => 'btn btn-white',
                        ));

                  }

                  // the 'number' page buttons
                  //echo $this->Paginator->numbers(array('modulus' => 1));
                  echo $this->Paginator->numbers(array(
                    'modulus' => 9,
                     'class' => 'btn btn-white',
                      'tag' => 'button',
                       'separator' => false,
                       'currentClass' => 'btn btn-white active',
                     ));


                  // for the 'next' button
                  if($this->Paginator->hasNext()){
                      //echo $this->Paginator->next('<button type="button" class="btn btn-white"><i class="fa fa-angle-right"></i> </button>',  array('escape' => false));


                      echo $this->Paginator->next('>', array(
                          'escape' => false,
                          'tag' => 'button',
                          'class' => 'btn btn-white',
                        ));

                  }

                  // the 'last' page button
                  //echo $this->Paginator->last('<button type="button" class="btn btn-white"><i class="fa fa-angle-double-right"></i> </button>',  array('escape' => false));

                  echo $this->Paginator->last('>>', array(
                      'escape' => false,
                      'tag' => 'button',
                      'class' => 'btn btn-white',
                    ));

              echo "</div></center>";

           ?>

        </div>


       </div>

    </div>


<?php else: ?>

  <div class=>
    <h2>consulta sin resultados<h2>
  </div>

<?php endif; ?>



</div>
<?php

?>
