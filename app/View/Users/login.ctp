


<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
          <fieldset>
              <legend>
                  <?php echo __('Ingresar Usuario y Contraseña'); ?>
              </legend>
          </fieldset>
        </div>
        <br>
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('User'); ?>

            <div class="form-group">
                <?php echo $this->Form->input('username',array('placeholder'=>'Usuario','class'=>'form-control','label' => false));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password',array('placeholder'=>'Contraseña','class'=>'form-control','label' => false));?>
            </div>
            <?php echo $this->Form->button('Iniciar Sesion', array('type' => 'submit','class' => 'btn btn-primary block full-width m-b','escape' => true));
            ?>

        <p class="m-t"> <small>Ezentis Colombia &copy; 2017</small> </p>
    </div>
</div>
