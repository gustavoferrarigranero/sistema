<?php
class Consulta extends ConsultaModel {

    public function insert(){
        return parent::insert();
    }

    public function update(){
        return parent::update();
    }

    public function delete(){
        return parent::delete();
    }

    public function get(){
        return parent::get();
    }

    public function getAll($limit,$order){
        return parent::getAll($limit,$order);
    }

    public function lista($id_usuario){
        return parent::lista($id_usuario);
    }
}
