<?php
class MensagemModel{

    public $id;
    public $id_remetente;
    public $id_destinatario;
    public $mensagem;
    public $dataenvio;

    public function __construct(){

    }

    public function insert(){
        return Config::get()->run('INSERT INTO mensagens(id_remetente, id_destinatario, mensagem, dataenvio)
        VALUES("'.$this->id_remetente.'","'.$this->id_destinatario.'","'.$this->mensagem.'","'.$this->dataenvio.'")');
    }

    public function update(){
        return Config::get()->run('UPDATE mensagens SET id_remetente = "'.$this->id_remetente.'", id_destinatario = "'.$this->id_destinatario.'", mensagem = "'.$this->mensagem.'", dataenvio = "'.$this->dataenvio.'" WHERE id_mensagem = '.(int)$this->id);
    }

    public function delete(){
        return Config::get()->run('DELETE FROM mensagens WHERE id_mensagem = "'.$this->id.'"');
    }

    public function get(){
        $item = Config::get()->query('SELECT * FROM mensagens WHERE id_mensagem = "'.$this->id.'"');
        if($item && isset($item[0]) && $item[0]){
            return $item[0];
        }
        return false;
    }

    public function getAll($limit,$order,$id_usuario = null){
        $sql = 'SELECT * FROM mensagens ';

        if($id_usuario){
            $sql .= ' WHERE (id_remetente = '.(int)$id_usuario.' OR id_destinatario = '.(int)$id_usuario.')';
        }

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

    public function getDestinatarios($limit,$order,$id_usuario = null){
        $sql = 'SELECT DISTINCT id_remetente FROM mensagens m INNER JOIN usuario u ON u.id_usuario = m.id_destinatario';

        if($id_usuario){
            $sql .= ' WHERE id_destinatario = '.(int)$id_usuario;
        }

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

    public function getDestinatariosMensagens($limit,$order,$id_destinatario,$id_usuario){
        $sql = 'SELECT * FROM mensagens m INNER JOIN usuario u ON u.id_usuario = m.id_destinatario';

        $sql .= ' WHERE (id_remetente = '.(int)$id_usuario;
        $sql .= ' AND id_destinatario = '.(int)$id_destinatario;
        $sql .= ' ) OR (id_remetente = '.(int)$id_destinatario;
        $sql .= ' AND id_destinatario = '.(int)$id_usuario;
        $sql .= ' ) ORDER BY '.$order;
        $sql .= ' LIMIT '.$limit;


        $item = Config::get()->query($sql);
        if($item){
            return $item;
        }
        return false;
    }

    public function lista(){
        return Config::get()->query('SELECT m.*,u.nome as "de",u2.nome as "para" FROM mensagens m
        INNER JOIN usuario u ON u.id_usuario = m.id_remetente
        INNER JOIN usuario u2 ON u2.id_usuario = m.id_destinatario');
    }
}
?>