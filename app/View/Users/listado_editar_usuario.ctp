<div class="ibox float-e-margins">
  <div class="ibox-title ui-sortable-handle">
    <div class="row">
      <div class="col-md-12">
        <h3>Filtrar Usuarios</h3>
      </div>
    </div>
  </div>
  <div class="ibox-content">
    <?php echo $this->Form->create('Consulta'); ?>
    <div class="form-group">
        <div class="row">
          <div class="col-md-5 col-md-offset-1">
            <?php echo $this->Form->input('identificacion',array('placeholder'=>'Identificacion', 'class'=>'input-lg form-control','label'=>false)); ?>
          </div>
          <div class="col-md-5 ">
            <?php echo $this->Form->input('nombre_completo',array('placeholder'=>'Nombre Completo', 'class'=>'input-lg form-control','label'=>false)); ?>
          </div>
        </div>
      </div>
      <div class="form-group">
          <div class="row">
            <div class="col-md-5 col-md-offset-1">
              <?php echo $this->Form->input('username',array('placeholder'=>'Nombre de usuario', 'class'=>'input-lg form-control','label'=>false)); ?>
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
                        'controller' => 'users',
                        'action' => 'listado_editar_usuario'
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

<div class="ibox float-e-margins">
  <div class="ibox-title ui-sortable-handle">
    <div class="row">
      <div class="col-md-12">
        <h3>Usuarios <?php echo $this->Html->link( 'Añadir', array( 'controller' => 'users', 'action' => 'add' ), array( 'class'=>'btn btn-info', ) ); ?></h3>

      </div>
    </div>
    <div class="ibox-content">
      <div class="project-list">
    <table class="table table-hover">
        <thead>
          <tr>
            <?php echo "<th>" . $this->Paginator->sort('id', 'ID') . "</th>"; ?>
            <th><h3>Identificacion</h3></th>
            <th><h3>Nombre Completo</h3></th>
            <th><h3>Nombre Usuario</h3></th>
            <th><h3>Fecha creacion</h3></th>
            <th><h3>Fecha modificacion</h3></th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($todos as $key => $value): ?>
            <tr>


              <td class="project-completion">
                      <small><?php echo $todos[$key]["User"]["id"]; ?></small>
              </td>
              <td class="project-completion">
                  <?php echo $value['User']['identificacion'];?>
                  <br>
              </td>
                <td class="project-completion">
                    <?php echo $value['User']['nombre_completo'];?>
                    <br>
                </td>
                <td class="project-completion">
                    <?php echo $value['User']['username'];?>
                    <br>
                </td>
                <td class="project-completion">
                    <?php echo $value['User']['created'];?>
                    <br>
                </td>
                <td class="project-completion">
                    <?php echo $value['User']['modified'];?>
                    <br>
                </td>
                <td class="project-actions">


                    <?php
                    echo $this->Html->link(
                        'Editar',
                        array(
                            'controller' => 'users',
                            'action' => 'edit', $todos[$key]["User"]["id"]
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
