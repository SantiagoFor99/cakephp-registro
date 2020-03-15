<?php
class Movimiento extends Model {
  public $validate=array(
        'serie_equipo_id'=>array(
          'notBlank'=>array(
            'rule'=>'notBlank'
          )
        )
      );
  public $belongsTo = array(
    'Equipo' => array(
        'className' => 'Equipo',
        'foreignKey' => 'serie_equipo_id'
    ),
    'Responsable' => array(
        'className' => 'Responsable',
        'foreignKey' => 'responsable_id'
    )
  );
}

?>
