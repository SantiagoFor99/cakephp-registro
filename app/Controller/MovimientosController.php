<?php
App::uses('AppController', 'Controller');

class MovimientosController extends AppController {

  // permisos por rol
  public function isAuthorized($user) {
      // todos los usuarios registrados pueden acceder a la accion index
      if ($this->action === 'index'||$this->action === 'guardar_boton'||$this->action === 'consulta') {
          return true;
      }

      // retorno autorizacion actual al app controller
      return parent::isAuthorized($user);
  }


  function index(){
    $this->set('title_for_layout', 'Ingresos / Salidas');
    // cargo modelos ajenos al contexto
    $this->loadModel('Equipo');
    $this->loadModel('Responsable');
    $this->set('boton_color', 'btn btn-lg btn-primary');
    $this->set('boton_ing_sal', "Entrada");
    $this->set('disabled_equipo', "false");
    $this->set('disabled_responsable', "false");
    $sin_datos_busca_movimientos=0;
    $guardar="no";
    $mensaje1="";
    $mensaje2="";
    $mensaje3="";
    $mensaje4="";
    $mensaje5="";
    //traemos la funcion ultimovimientos que tiene los ultimos 15 movimientos
    $this->ultimovimientos();
    if(isset($this->request->data['guardar'])){
      $guardar="si";
    }

    //verifica si los es post o put
    if ( $this->request->is(array('post', 'put')) ) {
      if ( !empty($this->request->data["Movimiento"]["serie_equipo_id"]) ) {
        // busca ultimo movimiento con el serial digitado
        $busca_movimientos = $this->Movimiento->find('first', array(
          'conditions' => array('serie_equipo_id' => $this->request->data["Movimiento"]["serie_equipo_id"]),
          'order' => array('Movimiento.id' => 'desc'))
        );
        //verifica si la var datos_formulario tiene datos y si no los tiene los escribe con los datos del datos_formulario
        if(!$this->Session->read('datos_formulario')){
          $this->Session->write('datos_formulario',$this->request->data);
        }
        if ($busca_movimientos) {
          $this->set('disabled_equipo', "true");
          $this->Session->write('datos_formulario',$busca_movimientos);
          if ($busca_movimientos["Movimiento"]["salida_fecha"] == null) {

            //se envian valores por defecto de los campos en la vista
            $this->set('disabled_responsable', "true");
            $this->set('boton_ing_sal', "Salida");
            $this->set('boton_color', 'btn btn-lg btn-danger');
            $this->set('ingreso',$busca_movimientos['Movimiento']['ingreso_fecha']);
          }
        }else{
          $mensaje1="-No se encontro codigo.<br>";

          //envia la notificacion de que debe añadir el equipo
          $this->set('panel_alerta_sin_codigo', "sin_cod");

          //verifica si el serial de los datos del formulario guardados en la sesion es igual al de el formulario actual
          $sin_datos_busca_movimientos=1;
        }

        if ( !empty($this->request->data["Responsable"]["identificacion"])) {
          $busca_responsable = $this->Responsable->findByIdentificacion($this->request->data["Responsable"]["identificacion"]);
          if (!$busca_responsable) {
            //envia mensaje si no encuentra el responsable por la identificacion del formulario
            $mensaje2="-No se encontro responsable con esa identificación.<br>";
            $this->set('panel_alerta_sin_responsable', "sin_responsable");
          }
        }else{
          $this->set('panel_alerta_sin_responsable', "sin_responsable");
        }

        //verifica si la variable $sin_datos_busca_movimientos del else buscamovimientos esta declarada con 1
        if ($sin_datos_busca_movimientos==1) {
          if($this->Session->read('datos_formulario.Movimiento.serie_equipo_id')!=$this->request->data["Movimiento"]["serie_equipo_id"]){

            //elimina los datos del formulario guardado en la sesion y le escribe el serial actual del formulario
            $this->Session->delete('datos_formulario');
            $this->Session->write('datos_formulario.Movimiento.serie_equipo_id',$this->request->data['Movimiento']['serie_equipo_id']);
          }else{
            /*si los seriales del formulario guardado y del formulario actual son iguales,
            si la busqueda de responsables se hizo y no hay resultados
            de responsables escribe los datos del formulario actual*/
            $this->Session->write('datos_formulario',$this->request->data);
            if (isset($busca_responsable)&&$busca_responsable) {
              //escribe los datos del responsable en la sesion
              $this->Session->write('datos_formulario.Responsable',$busca_responsable["Responsable"]);
            }else {
              $this->Session->delete('datos_formulario');
              $this->Session->write('datos_formulario.Responsable.identificacion',$this->request->data["Responsable"]["identificacion"]);
              $this->Session->write('datos_formulario.Movimiento.serie_equipo_id',$this->request->data["Movimiento"]["serie_equipo_id"]);
            }
          }
        }
        $this->request->data=$this->Session->read('datos_formulario');

      }else{
        $mensaje1="-No se encontro codigo.<br>";
      }
      if ($guardar=="si") {
        $this->request->data["Movimiento"]["serie_equipo_id"] = trim($this->request->data["Movimiento"]["serie_equipo_id"]);
        $campos_vacios=0;
        if (empty($this->request->data['Responsable']['nombre'])||empty($this->request->data['Responsable']['apellido'])) {
          $mensaje3="-Por favor llene los campos nombre y apellido.<br>";
          $campos_vacios=1;
        }
        if (empty($this->request->data['Equipo']['marca'])||empty($this->request->data['Equipo']['modelo'])) {
          $mensaje4="-Por favor llene los campos marca y modelo.<br>";
          $campos_vacios=1;
        }
        if (empty($this->request->data['Responsable']['identificacion'])){
          $mensaje5="-Por favor ponga la identificacion. <br>";
          $campos_vacios=1;
        }
        if($campos_vacios==0){
          //se agrego el arreglo guardar de manera manual por algunas condiciones en la funcion guardar
          $this->request->data['guardar']='guardar';
          $this->guardar($this->request->data);
          $this->Session->delete('datos_formulario');
        }else{
          $this->Session->write('datos_formulario',$this->request->data);
        }

      }
      if($mensaje1||$mensaje2||$mensaje3||$mensaje4||$mensaje5){
        $this->Session->setFlash($mensaje1.$mensaje2.$mensaje3.$mensaje4.$mensaje5,'flash_rojo');
      }
    }
  }
  function editar_responsable($id){
    $this->loadModel('Responsable');
    if ($id==null) {
      throw new NotFoundException(__('Responsable Invalido'));
    }
    $this->Responsable->id = $id;
    if ($this->request->is('post') || $this->request->is('put')) {
      if ($this->Responsable->save($this->request->data)) {
        $this->Session->setFlash('Responsable Editado','flash_verde');
        return $this->redirect(array('action' => 'listado_editar_responsable'));
      }
      $this->Session->setFlash(__('El Responsable no pudo ser editado, vuelve a intentar.','flash_rojo'));
    }
    $this->request->data =$this->Responsable->findById($id);
  }
  function editar_equipo($serie){
    $this->loadModel('Equipo');

    if ($serie==null) {
      throw new NotFoundException(__('Equipo Invalido'));
    }
    //le decimos al software que id queremos modificar
    // model->id igual a la segue (primaryKey en el modelo)
    $this->Equipo->id = $serie;

    if ($this->request->is('post') || $this->request->is('put')) {
      if ($this->Equipo->save($this->request->data)) {
        $this->Session->setFlash('Equipo Editado','flash_verde');
        return $this->redirect(array('action' => 'listado_editar_equipo'));
      }
      $this->Session->setFlash(__('El Equipo no pudo ser editado, vuelve a intentar.','flash_rojo'));
    }
    $this->request->data =$this->Equipo->findBySerie($serie);

  }
  function listado_editar_responsable(){
    $this->set('title_for_layout', 'Responsables');
    $this->loadModel("Responsable");
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
            array('Responsable.identificacion LIKE' => '%'.$this->request->data['Consulta']['identificacion'].'%')
          ),
        ));
      }
      if(!empty($this->request->data['Consulta']['nombre'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('Responsable.nombre LIKE' => '%'.$this->request->data['Consulta']['nombre'].'%')
          ),
        ));
      }
      if(!empty($this->request->data['Consulta']['apellido'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('Responsable.apellido LIKE' => '%'.$this->request->data['Consulta']['apellido'].'%')
          ),
        ));
      }
      if(!empty($this->request->data['Consulta']['telefono'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('Responsable.telefono LIKE' => '%'.$this->request->data['Consulta']['telefono'].'%')
          ),
        ));
      }
      $this->Session->write('condiciones2', $condiciones);

    }

    $this->paginate = array(
      'conditions' => $condiciones,
      'limit' => 10
    );

    $todos = $this->paginate('Responsable');
    $this->set('todos',$todos);
  }
  //
  function listado_editar_equipo(){
    $this->set('title_for_layout', 'Equipos');
    $this->loadModel('Equipo');

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

      if(!empty($this->request->data['Consulta']['serie'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('serie LIKE' => '%'.$this->request->data['Consulta']['serie'].'%')
          ),
        ));
      }
      if(!empty($this->request->data['Consulta']['marca'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('marca LIKE' => '%'.$this->request->data['Consulta']['marca'].'%')
          ),
        ));
      }
      if(!empty($this->request->data['Consulta']['modelo'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('modelo LIKE' => '%'.$this->request->data['Consulta']['modelo'].'%')
          ),
        ));
      }

      $this->Session->write('condiciones2', $condiciones);

    }

    $this->paginate = array(
      'conditions' => $condiciones,
      'limit' => 10
    );
    $todos = $this->paginate('Equipo');
    $this->set('todos',$todos);
  }
  function recorre_arreglo_multi($array){
    $tmp = array();
    foreach($array as $key => $value){
      if(is_array($value)){
        $tmp[$key] = $this->recorre_arreglo_multi($value);
      }else{
        $tmp[$key] = strtoupper($value);
        //$tmp[$key] = trim($tmp[$key]);
      }
    }
    return $tmp;
  }
  function ultimovimientos(){
    $this->loadModel("Movimiento");
    $ultimos = $this->Movimiento->find('all', array(
      'order' => array(
        'Movimiento.modified' => 'desc'
      ),
      'limit'=>15)
    );
    $this->set('ultimos',$ultimos);
  }
  function guardar($datos_guardar) {
    $datos_guardar["Movimiento"]["user_id"]=$this->Auth->user('id');
    $serial_tmp = $datos_guardar["Movimiento"]["serie_equipo_id"];
    $datos_guardar = $this->recorre_arreglo_multi($datos_guardar);
    $datos_guardar["Movimiento"]["serie_equipo_id"] = $serial_tmp;
    unset($serial_tmp);
    if (isset($datos_guardar["guardar"])) {
      $salida = 0;
      $ultimo_movimiento = $this->Movimiento->find('first', array(
        'conditions' => array('serie_equipo_id' => $datos_guardar["Movimiento"]["serie_equipo_id"]),
        'order' => array('Movimiento.id' => 'desc'))
      );


      if ( !empty($ultimo_movimiento) && !$ultimo_movimiento["Movimiento"]["salida_fecha"] ) {
        $salida = 1;
        $observacion = $datos_guardar["Movimiento"]["observacion"];
        unset($datos_guardar);
        $datos_guardar["Movimiento"]["observacion"] = $observacion;
        $datos_guardar["Movimiento"]["salida_fecha"] = date("Y-m-d H:i:s");

        $this->Movimiento->id = $ultimo_movimiento["Movimiento"]["id"];
        $this->Movimiento->save($datos_guardar);
        $this->Session->setFlash('Salida guardada.', 'flash_verde');
        $this->redirect(array('action' => 'index'));
        exit;

      }
      $ver_id = $this->Responsable->findByIdentificacion($datos_guardar['Responsable']['identificacion']);

      if ( $ver_id ) {
        // actualiza datos de responsable para guardar movimiento
        $datos_guardar['Movimiento']['responsable_id'] = $ver_id["Responsable"]["id"];
      } else {
        // crea responsable
        $this->Responsable->create();
        $this->Responsable->save($datos_guardar);
        $datos_guardar["Movimiento"]["responsable_id"] = $this->Responsable->getLastInsertID();
      }

      $ver_equipo = $this->Equipo->findBySerie($datos_guardar['Movimiento']['serie_equipo_id']);

      if ( !$ver_equipo ) {
        // crea equipo
        $datos_guardar['Equipo']['serie'] = $datos_guardar['Movimiento']["serie_equipo_id"];
        $this->Equipo->create();
        $this->Equipo->save($datos_guardar);
      }

      $datos_guardar["Movimiento"]["ingreso_fecha"] = date("Y-m-d H:i:s");
      unset($datos_guardar["Movimiento"]["id"]);
      unset($datos_guardar["Movimiento"]["modified"]);
      unset($datos_guardar["Movimiento"]["salida_fecha"]);
      $this->Movimiento->create();


      $this->Movimiento->save($datos_guardar);

      // borra los mensajes anteriores
      $this->Session->delete('Message.flash');

      $this->Session->setFlash('Ingreso guardado.', 'flash_verde');
      $this->redirect(array('action' => 'index'));

    }

  }

  function guardar_boton($id) {

    $this->Movimiento->id = $id;
    $this->Movimiento->set(array('salida_fecha' => date("Y-m-d H:i:s")));
    $this->Movimiento->save();

    $this->Session->setFlash('Salida guardada.', 'flash_verde');
    $this->redirect(array('action' => 'index'));
    exit;

  }


  function registro($condiciones = array()){

    $datos_all = $this->Movimiento->find('all', array(
      'conditions' => $condiciones
    ));

    // Load the class PHPExcel in app/Vendor/PHPExcel/PHPExcel.php
    App::import('Vendor', 'PHPExcel/PHPExcel');

    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Add some data
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Codigo/Serie')
    ->setCellValue('B1','Fecha Ingreso')
    ->setCellValue('C1','Fecha Salida')
    ->setCellValue('D1', 'identificacion')
    ->setCellValue('E1', 'Nombre Responsable')
    ->setCellValue('F1', 'Apellido')
    ->setCellValue('G1', 'Telefono')
    ->setCellValue('H1', 'Marca')
    ->setCellValue('I1', 'Modelo')
    ->setCellValue('J1', 'Observacion');
    $cont=2;
    foreach ($datos_all as $key => $value) {
      $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('A'.$cont,$value["Movimiento"]["serie_equipo_id"])
      ->setCellValue('B'.$cont,$value["Movimiento"]["ingreso_fecha"])
      ->setCellValue('C'.$cont,$value["Movimiento"]["salida_fecha"])
      ->setCellValue('D'.$cont,$value["Responsable"]["identificacion"])
      ->setCellValue('E'.$cont,$value["Responsable"]["nombre"])
      ->setCellValue('F'.$cont,$value["Responsable"]["apellido"])
      ->setCellValue('G'.$cont,$value["Responsable"]["telefono"])
      ->setCellValue('H'.$cont,$value["Equipo"]["marca"])
      ->setCellValue('I'.$cont,$value["Equipo"]["modelo"])
      ->setCellValue('J'.$cont,$value["Movimiento"]["observacion"]);
      $cont++;
    }
    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="reporte.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;

  }
  function consulta() {
    $this->set('title_for_layout', 'Consultas');

    $this->loadModel('Movimientos');
    $this->loadModel('Responsable');
    $this->loadModel('Equipo');

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

      if(!empty($this->request->data['Consulta']['serie_equipo_id'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('serie_equipo_id LIKE' => '%'.$this->request->data['Consulta']['serie_equipo_id'].'%')
          ),
        ));
      }
      if(!empty($this->request->data['Consulta']['identificacion'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('Responsable.identificacion LIKE' => '%'.$this->request->data['Consulta']['identificacion'].'%')
          ),
        ));
      }

      if(!empty($this->request->data['Consulta']['nombre'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array(
              'OR' => array(
                array('Responsable.nombre LIKE' => '%'.$this->request->data['Consulta']['nombre'].'%'),
                array('Responsable.apellido LIKE' => '%'.$this->request->data['Consulta']['nombre'].'%')
              )
            )
          ),
        ));

      }
      if(!empty($this->request->data['Consulta']['telefono'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('Responsable.telefono LIKE' => '%'.$this->request->data['Consulta']['telefono'].'%')
          ),
        ));
      }

      if(!empty($this->request->data['Consulta']['fecha_desde']) && !empty($this->request->data['Consulta']['fecha_hasta'])){
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array('Movimiento.ingreso_fecha BETWEEN "'.$this->request->data['Consulta']['fecha_desde'].'" AND "'.$this->request->data['Consulta']['fecha_hasta'].' 23:59:59 "')
          ),
        ));
      }


      if(!empty($this->request->data['Consulta']['marca'])){
        //aqui va la condicion or de marca y modelo
        $condiciones = array_merge_recursive($condiciones, array(
          'AND' => array(
            array(
              'OR' => array(
                array('Equipo.marca LIKE' => '%'.$this->request->data['Consulta']['marca'].'%'),
                array('Equipo.modelo LIKE' => '%'.$this->request->data['Consulta']['marca'].'%')
              )
            )
          ),
        ));
      }
      $this->Session->write('condiciones2', $condiciones);

    }

    $this->paginate = array(
      'conditions' => $condiciones,
      'limit' => 10,
      'order' => array('modified' => 'desc')
    );

    $todos = $this->paginate('Movimiento');
    $this->set('todos',$todos);

    $this->request->data = $this->Session->read('request_data');

    if(isset($this->request->data["reporte_filtrado"])){
      $this->registro($condiciones);
    }
  }
}
