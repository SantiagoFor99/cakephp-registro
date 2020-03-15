<div class="ibox float-e-margins">
  <div class="ibox-title ui-sortable-handle">
    <div class="row">
      <div class="col-md-12">
        <h3>Filtrar Equipos</h3>
      </div>
    </div>
  </div>
  <div class="ibox-content">
    <?php echo $this->Form->create('Consulta'); ?>
    <div class="form-group">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <?php echo $this->Form->input('serie',array('placeholder'=>'Codigo del equipo','type'=>'text', 'class'=>'input-lg form-control','label'=>false)); ?>
        </div>
      </div>
    </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-5 col-md-offset-1">
              <?php echo $this->Form->input('marca',array('placeholder'=>'Marca', 'class'=>'input-lg form-control','label'=>false)); ?>
            </div>
            <div class="col-md-5 ">
              <?php echo $this->Form->input('modelo',array('placeholder'=>'Modelo', 'class'=>'input-lg form-control','label'=>false)); ?>
            </div>
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
                        'action' => 'listado_editar_equipo'
                    ),
                    array(
                      'class'=>'btn btn-lg btn-white',
                    )
                );

               ?>
            </div>
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
        <h3>Equipos</h3>
      </div>
    </div>
    <div class="ibox-content">
      <div class="project-list">
    <table class="table table-hover">
        <thead>
          <tr>
            <?php echo "<th>" . $this->Paginator->sort('id', 'ID') . "</th>"; ?>
            <th><h3>Serie</h3></th>
            <th><h3>Marca</h3></th>
            <th><h3>Modelo</h3></th>
            <th><h3>Editar</h3></th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($todos as $key => $value): ?>
            <tr>


              <td class="project-completion">
                      <small><?php echo $todos[$key]["Equipo"]["id"]; ?></small>
              </td>
              <td class="project-completion">
                  <?php echo $value['Equipo']['serie'];?>
                  <br>
              </td>
                <td class="project-completion">
                    <?php echo $value['Equipo']['marca'];?>
                    <br>
                </td>
                <td class="project-completion">
                    <?php echo $value['Equipo']['modelo'];?>
                    <br>
                </td>
                <td class="project-actions">


                    <?php
                    echo $this->Html->link(
                        'Editar',
                        array(
                            'controller' => 'movimientos',
                            'action' => 'editar_equipo', $todos[$key]["Equipo"]["serie"]
                        ),
                        array(
                          'class' => 'btn btn-warning btn-sm'
                        )
                    );  ?>
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
