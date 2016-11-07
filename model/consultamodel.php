<?php
class ConsultaModel{

    public $id;
    public $id_doutor;
    public $id_paciente;
    public $data;
    public $sintomas;

    public function __construct(){

    }

    public function insert(){
        return Config::get()->run('INSERT INTO consultas(id_doutor, id_paciente, `data`, sintomas)
        VALUES("'.$this->id_doutor.'","'.$this->id_paciente.'","'.$this->data.'","'.$this->sintomas.'")');
    }

    public function update(){
        return Config::get()->run('UPDATE consultas SET id_doutor = "'.$this->id_doutor.'",id_paciente = "'.$this->id_paciente.'", `data` = "'.$this->data.'", sintomas = "'.$this->sintomas.'" WHERE id_consulta = '.(int)$this->id);
    }

    public function delete(){
        return Config::get()->run('DELETE FROM consultas WHERE id_consulta = "'.$this->id.'"');
    }

    public function get(){
        $item = Config::get()->query('SELECT * FROM consultas WHERE id_consulta = "'.$this->id.'"');
        if($item && isset($item[0]) && $item[0]){
            return $item[0];
        }
        return false;
    }

    public function getAll($limit,$order){
        $sql = 'SELECT * FROM consultas ';

        if($order){
            $sql .= ' ORDER BY '.$order;
        }

        if($limit){
            $sql .= ' LIMIT '.$limit;
        }

        $item = Config::get()->query($sql);
        if($item){
            return $item;
        }
        return false;
    }

    public function lista($id_usuario){
        $sql = 'SELECT * FROM consultas WHERE id_paciente = '.$id_usuario.' OR id_doutor = '.$id_usuario;

        $item = Config::get()->query($sql);
        if($item){
            return $item;
        }
        return false;
    }
}
?>