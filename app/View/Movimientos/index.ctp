<style media="screen">
  #sin_margen th {
    padding-top: 0px;
    padding-bottom: 5px;
  }
</style>

<div class="col-md-12">

  <?php echo $this->Form->create('Movimiento'); ?>

  <div class="ibox float-e-margins">
    <div class="ibox-title ui-sortable-handle">


      <div class="row">

        <div class="col-md-12" align="center">
          <H3><label>Hora y Fecha Actual: </label>
          <label id='date-part'></label>
          <label id='time-part'></label></H3>
        </div>

      </div>

    </div>
    <div class="ibox-content">
      <div class="row">
        <div class="col-md-4">
          <h2>Serial/Codigo</h2>
          <br>

          <br>
        </div>
        <div class="col-md-8">
          <div class="input-group">
            <?php echo $this->Form->input('serie_equipo_id',array('placeholder'=>'Codigo del equipo','class'=>'input-lg form-control','id'=>'serie_equipo_id','type'=>'text','autofocus'=>'autofocus','readonly'=>'readonly','label' => false));?>
            <span class="input-group-btn">
              <?php echo $this->Form->button('buscar',array('type' => 'submit','class' => 'btn btn-lg btn-primary','escape' => true)); ?>
            </span>
          </div>
            <div class="i-checks">
              <label>
                  <?php
                   echo $this->Form->checkbox('modo_manual', array ( 'id'  =>  'modo_manual' , 'hiddenField'  =>  'false'));
                   ?>
                <i></i> Modo manual
              </label>
            </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-4 ">

          <?php if (isset($ingreso) && $boton_ing_sal=="Salida"): ?>
            <div class="bg-warning p-xs b-r-sm"><b>Hora ingreso: <?php echo $ingreso; ?></b></div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
  <div class="ibox float-e-margins">
    <div class="ibox-title ui-sortable-handle">
      <div class="row">
        <div class="col-md-4 col-md-offset-5">
          <h3>Datos Responsable</h3>
        </div>
      </div>
    </div>
    <div class="ibox-content">
      <?php
      echo $this->Form->create('Responsable');
      ?>
      <div class="row">
        <div class="col-md-10 col-md-offset-1  ">

          <?php if (isset($confir_fecha) && $confir_fecha!= null):?>
            <h3><div class="bg-info p-xs b-r-sm"><b>Datos ultimo responsable.</b></div></h3><br>
          <?php endif; ?>
          <?php if (isset($panel_alerta_sin_responsable)&&isset($panel_alerta_sin_codigo)):?>
            <h3><div class="bg-warning p-xs b-r-sm"><b>Añade Responsable</b></div></h3><br>
          <?php endif; ?>
        </div>
      </div>
       <div class="row">
        <div class="col-md-5 col-md-offset-1">
          <div class="input-group">
            <?php echo $this->Form->input('identificacion',array('placeholder'=>'Numero de identificacion', 'disabled' => $disabled_responsable, 'class'=>'input-lg form-control','maxlength'=>'15','minlength'=>'6','type'=>'text','label' => false));?>
            <span class="input-group-btn">
              <?php echo $this->Form->button('buscar', array('type' => 'submit', 'disabled' => $disabled_responsable, 'class' => 'btn btn-lg btn-primary')); ?>
            </span>
          </div>
        </div>
        <div class="col-md-5">
          <?php echo $this->Form->input('telefono',array('placeholder'=>'Telefono', 'disabled' => $disabled_responsable, 'class'=>'input-lg form-control','maxlength'=>'10','minlength'=>'7','type'=>'text','label'=>false)); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5 col-md-offset-1">
          <?php echo $this->Form->input('nombre',array('placeholder'=>'Nombres', 'disabled' => $disabled_responsable, 'class'=>'input-lg form-control','maxlength'=>'30','minlength'=>'3','label'=>false)); ?>
        </div>
        <div class="col-md-5">
          <?php echo $this->Form->input('apellido',array('placeholder'=>'Apellidos', 'disabled' => $disabled_responsable, 'class'=>'input-lg form-control','maxlength'=>'30','minlength'=>'3','label'=>false)); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="ibox float-e-margins">
    <div class="ibox-title ui-sortable-handle">
      <div class="row">
        <div class="col-md-4 col-md-offset-5">
          <h3>Datos Equipo</h3>
        </div>
      </div>
    </div>
    <div class="ibox-content">
      <div class="row">
        <div class="col-md-8 col-md-offset-1">
          <?php
          if (!empty($datos_formularios["Movimiento"]["serie_equipo_id"]) ) {
            echo "<label> Serial: ". $datos_formularios["Movimiento"]["serie_equipo_id"] ."</label>";
          }
          ?>
        </div>
      </div>
      <?php
      echo $this->Form->create('Equipo');
      ?>
      <div class="row">
        <div class="col-md-10 col-md-offset-1  ">
          <?php if (isset($panel_alerta_sin_codigo)):?>
            <h3><div class="bg-warning p-xs b-r-sm"><b>Añade equipo</b></div></h3><br>
          <?php endif; ?>
        </div>
      </div>
        <div class="row">
          <div class="col-md-5 col-md-offset-1">
            <?php echo $this->Form->input('marca', array('placeholder'=>'Marca', 'disabled' => $disabled_equipo, 'class'=>'input-lg form-control','maxlength'=>'20','minlength'=>'2', 'type'=>'text','label'=>false)); ?>
          </div>
          <div class="col-md-5">
            <?php echo $this->Form->input('modelo', array('placeholder'=>'Modelo', 'disabled' => $disabled_equipo, 'class'=>'input-lg form-control','maxlength'=>'20','minlength'=>'2','type'=>'text','label'=>false)); ?>
          </div>
        </div>

    </div>
    <div class="ibox-content">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <?php echo $this->Form->input('Movimiento.observacion',array('placeholder'=>'observacion','class'=>'input-lg form-control','type'=>'text','label'=>false,'rows'=>1)); ?>
        </div>
      </div>
    </div>
    <div class="ibox-content">
      <div class="row">
        <div class="col-md-12 col-md-offset-5">
          <?php
          echo $this->Form->button($boton_ing_sal, array('type' => 'submit','name'=>'guardar','value'=>'guardar','class' => $boton_color,'escape' => true));
          ?>
        </div>
      </div>
    </div>
  </div>
<?php if (isset($ultimos)): ?>

    <div class="ibox float-e-margins">
      <div class="ibox-title ui-sortable-handle">
          <div class="row">
            <div class="col-md-12">
              <center><h3>Ultimos 15 Movimientos</h3></center>
            </div>
          </div>
        </div>

        <div class="ibox-content">
          <div class="project-list">
            <table class="table table-hover">
              <thead>
                <tr id="sin_margen">
                  <th><h3>Estado</h3></th>
                  <th><h3>Responable</h3></th>
                  <th><h3>Equipo</h3></th>
                  <th><h3>Observacion</h3></th>
                  <th><h3>Acción</h3></th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($ultimos as $key => $value): ?>
                <tr>
                <?php
                 if ($ultimos[$key]["Movimiento"]["salida_fecha"]==null){?>
                  <td class="project-status">
                      <span class="label label-primary"> Entrada</span>
                  </td>
                  <?php } else{ ?>
                  <td class="project-status">
                      <span class='label label-warning'> Salida</span>
                  </td>
                  <?php } ?>
                    <td class="project-title">
                        <?php echo $value['Responsable']['nombre']." ".$value['Responsable']['apellido'];?>
                        <br>
                        <small>Fecha y Hora:<?php echo $ultimos[$key]['Movimiento']['modified']; ?></small>
                    </td>
                    <td class="project-title">
                        Serial/Codigo: <?php echo $ultimos[$key]["Movimiento"]["serie_equipo_id"]; ?>
                        <br>
                        <small>Modelo: <?php echo $ultimos[$key]['Equipo']['modelo']; ?></small>
                    </td>
                    <td class="project-completion">
                            <small><?php echo $ultimos[$key]["Movimiento"]["observacion"]; ?></small>
                    </td>
                    <td class="project-actions">

                        <!-- <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a> -->
                        <?php if ($ultimos[$key]['Movimiento']['salida_fecha']==null): ?>
                        <?php
                        echo $this->Html->link(
                            'Salida',
                            array(
                                'controller' => 'movimientos',
                                'action' => 'guardar_boton', $ultimos[$key]["Movimiento"]["id"]
                            ),
                            array(
                              'class' => 'btn btn-danger btn-sm'
                            )
                        );

                        ?>
                        <?php endif; ?>
                    </td>
                </tr>

              <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
    </div>

<?php endif;
  echo $this->Form->end(); ?>

</div>

<script type="text/javascript">

   // espera a que cargue todo el dom
     $(document).ready(function(){

          // hago focus en input cuando el usuario acandona y retoma la pestaña / ventana
          $( "#serie_equipo_id" ).focus();
          $(window).bind("focus",function(event){
              $( "#serie_equipo_id" ).focus();
          }).bind("blur", function(event){
              $( "#serie_equipo_id" ).focus();
          });

          // Inicializa checkbox
         $('.i-checks').iCheck({
             checkboxClass: 'icheckbox_square-green'
         });

       // creo una funcion para llamar la deteccion de escaneo
       var rastrear_escaner = function(){
         $('#serie_equipo_id').scannerDetection({
           timeBeforeScanTest: 200, // wait for the next character for upto 200ms
           avgTimeByChar: 20, // it's not a barcode if a character takes longer than 100ms
           preventDefault: true,
           endChar: [4],
           onComplete: function(barcode, qty){
             validScan = true;
             $('#serie_equipo_id').val(barcode);
             $( "#MovimientoIndexForm" ).submit();
           }, // main callback function	,
           onError: function(string, qty) {
           }
         });
       }

       // llamo mi funcio para iniciar deteccion de escaneo
       rastrear_escaner();

       // funcio con el checkbox
       $('.i-checks').on('ifChecked', function (event){
                 // alert('activado');
                 $('#serie_equipo_id').removeAttr('readonly');
                 $('#serie_equipo_id').scannerDetection(false);
        });

        $('.i-checks').on('ifUnchecked', function (event){
                  // alert('desactivado');
                  $('#serie_equipo_id').attr('readonly', true);
                  $('#serie_equipo_id').val('');
                  rastrear_escaner();
        });

     });
</script>
