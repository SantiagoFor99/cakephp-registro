<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

  public function beforeFilter() {
      parent::beforeFilter();
        $this->Auth->allow('login','logout');
  }
  function listado_editar_usuario(){
    $this->set('title_for_layout', 'Usuarios');
    $this->loadModel("User");
    $condiciones = array();

    if($this->request->is(array('get')) ) {
      if (isset($this->params["named"]["page"]) || isset($this->params["named"]["sort"]) ||isset($this->params["named"]["direction"])) {
        $condiciones = $this->Session->read('condiciones2');
      } else {
        $this->Session->delete('condiciones2');
        $this->Session->delete('request_data');

      }
    }

    if($this->request->is(array('post', 'put')) ) {

      $this->Session->write('request_data', $this->request->data);
          if(!empty($this->request->data['Consulta']['identificacion'])){
            $condiciones = array_merge_recursive($condiciones, array(
                                'AND' => array(
                                  array('User.identificacion LIKE' => '%'.$this->request->data['Consulta']['identificacion'].'%')
                                ),
                            ));
          }
          if(!empty($this->request->data['Consulta']['nombre_completo'])){
            $condiciones = array_merge_recursive($condiciones, array(
                                'AND' => array(
                                  array('User.nombre_completo LIKE' => '%'.$this->request->data['Consulta']['nombre_completo'].'%')
                                ),
                            ));
          }
          if(!empty($this->request->data['Consulta']['username'])){
            $condiciones = array_merge_recursive($condiciones, array(
                                'AND' => array(
                                  array('User.username LIKE' => '%'.$this->request->data['Consulta']['username'].'%')
                                ),
                            ));
          }
          $this->Session->write('condiciones2', $condiciones);

    }

    $this->paginate = array(
        'conditions' => $condiciones,
        'limit' => 10
    );

    $todos = $this->paginate('User');
    $this->set('todos',$todos);
  }

  public function login() {
    $this->set('title_for_layout', 'Iniciar Sesión');
    $this->layout = 'login';
      if ($this->request->is('post')) {
          if ($this->Auth->login()) {
              return $this->redirect($this->Auth->redirectUrl());
          }
          $this->Session->setFlash(__('Usuario o Contraseña Invalidos, vuelve a intentar'));
      }
  }

  public function logout() {
      return $this->redirect($this->Auth->logout());
  }

    public function index() {
        // $this->User->recursive = 0;
        // $this->set('users', $this->paginate());
        return $this->redirect(array('controller' => 'users', 'action' => 'listado_editar_usuario'));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario Invalido'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario Guardado'));
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(
                __('El Usuario no pudo ser guardado, vuelve a intentar.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario Invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario Editado'));
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(
                __('El Usuario no pudo ser editado, vuelve a intentar.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->allowMethod('post','get');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario Invalido'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Usuario eliminado'));
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Session->setFlash(__('No se pudo eliminar usuario'));
        return $this->redirect($this->Auth->redirectUrl());
    }

}
?>
