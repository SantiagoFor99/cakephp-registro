<div class="ibox float-e-margins">
  <div class="ibox-title ui-sortable-handle">
    <div class="row">
      <div class="col-md-12">
            <h1>
                <?php echo('Editar Equipo'); ?>
            </h1>
      </div>
    </div>
  </div>
  <div class="ibox-content">
    <?php echo $this->Form->create('Equipo'); ?>
        <div class="row">
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('marca',array('placeholder'=>'Marca','class'=>'form-control','label' => false,'maxlength'=>'20','minlength'=>'2','required'=>'required'));?>
            </div>
          </div>
          <div class="form-group">
            <br>
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('modelo',array('placeholder'=>'Modelo','class'=>'form-control','label' => false,'maxlength'=>'20','minlength'=>'2','required'=>'required'));?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
              <?php echo $this->Form->button('Editar', array('type' => 'submit','class' => 'btn btn-primary block full-width m-b','escape' => true));?>
            </div>
          </div>
        </div>
  </div>
</div>
