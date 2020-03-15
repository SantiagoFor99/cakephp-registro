<?php
class AppController extends Controller {

  public $components = array(
    'Session',
    'Auth' => array(
      'loginAction' => array(
        'controller' => 'users',
        'action' => 'login'
      ),

      'loginRedirect' => array(
        'controller' => 'movimientos',
        'action' => 'index'
      ),
      'authError' => 'Usted no esta autorizado para acceder a esta pagina',

      'logoutRedirect' => array(
        'controller' => 'movimientos',
        'action' => 'index'
      ),
      'authenticate' => array(
        'Form' => array(
          'passwordHasher' => 'Blowfish'
        )
      ),
      'authorize' => array('Controller') // permisos
    )
  );

  // antes de los controladores
  public function beforeFilter() {

    $this->Auth->allow('login','logout');
    $this->set('usuario_iniciado', $this->Auth->user());

  }

  public function isAuthorized($user) {

    // administrador puede acceder a cualquier accion
    if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }

    // denegado todo acceso por defecto
    $this->Session->delete('Message.flash');
    $this->Session->setFlash('Permiso denegado.', 'flash_rojo');
    $this->redirect(array('controller' => 'movimientos', 'action' => 'index'));
    return false;
}

}
?>
