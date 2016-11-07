<?php
class Mensagem extends MensagemModel {

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

    public function getAll($limit,$order,$id_usuario = null){
        return parent::getAll($limit,$order,$id_usuario);
    }

    public function getDestinatarios($limit,$order,$id_usuario = null){
        return parent::getDestinatarios($limit,$order,$id_usuario);
    }


    public function getDestinatariosMensagens($limit,$order,$id_destinatario,$id_usuario){
        return parent::getDestinatariosMensagens($limit,$order,$id_destinatario,$id_usuario);
    }


    public function lista(){
        return parent::lista();
    }

}
