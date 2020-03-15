<div class="ibox float-e-margins">
  <div class="ibox-title ui-sortable-handle">
    <div class="row">
      <div class="col-md-12">
            <h1>
                <?php echo('Editar Usuario'); ?>
            </h1>
      </div>
    </div>
  </div>
  <div class="ibox-content">
    <?php echo $this->Form->create('User'); ?>
        <div class="row">
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('identificacion',array('placeholder'=>'Identificacion','class'=>'form-control','label' => false));?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('nombre_completo',array('placeholder'=>'Nombre Completo','class'=>'form-control','label' => false));?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('username',array('placeholder'=>'Usuario','class'=>'form-control','label' => false));?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('password',array('placeholder'=>'Contraseña','class'=>'form-control','label' => false));?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('role', array( 'options' => array('admin' => 'Admin', 'user' => 'User') )); ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
            <?php echo $this->Form->button('Editar', array('type' => 'submit','class' => 'btn btn-primary block full-width m-b','escape' => true)); ?>            </div>
          </div>
        </div>
  </div>
</div>
