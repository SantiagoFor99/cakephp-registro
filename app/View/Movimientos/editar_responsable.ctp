
<div class="ibox float-e-margins">
  <div class="ibox-title ui-sortable-handle">
    <div class="row">
      <div class="col-md-12">
            <h1>
                <?php echo('Editar Responsable'); ?>
            </h1>
      </div>
    </div>
  </div>
  <div class="ibox-content">
    <?php echo $this->Form->create('Responsable'); ?>
        <div class="row">
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('identificacion',array('placeholder'=>'Identificacion','class'=>'form-control','label' => false,'required'=>'required','maxlength'=>'15','minlength'=>'6'));?>
            </div>
          </div>
          <div class="form-group">
            <br>
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('nombre',array('placeholder'=>'Nombre','class'=>'form-control','label' => false,'required'=>'required','maxlength'=>'30','minlength'=>'3'));?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('apellido',array('placeholder'=>'Apellido','class'=>'form-control','label' => false,'required'=>'required','maxlength'=>'30','minlength'=>'3'));?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <?php echo $this->Form->input('telefono',array('placeholder'=>'telefono','class'=>'form-control','label' => false,'maxlength'=>'10','minlength'=>'7'));?>
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
