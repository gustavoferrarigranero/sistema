<?php
class UsuarioModel{

    public $id;
    public $nome;
    public $email;
    public $usuario;
    public $senha;
    public $datanascimento;
    public $cpf;
    public $rg;
    public $problemasaude;
    public $datacadastro;
    public $tipo;
    public $status;

    public function __construct(){

    }

    public function insert(){
        return Config::get()->run('INSERT INTO usuario(nome, email, usuario, senha, datanascimento, cpf, rg, problemasaude, datacadastro, tipo, status)
        VALUES("'.$this->nome.'","'.$this->email.'","'.$this->usuario.'","'.$this->senha.'","'.$this->datanascimento.'","'.$this->cpf.'","'.$this->rg.'","'.$this->problemasaude.'","'.$this->datacadastro.'","'.$this->tipo.'","'.$this->status.'")');
    }

    public function update(){
        $return = Config::get()->run('UPDATE usuario SET nome = "'.$this->nome.'", email = "'.$this->email.'", usuario = "'.$this->usuario.'", datanascimento = "'.$this->datanascimento.'", cpf = "'.$this->cpf.'", rg = "'.$this->rg.'", problemasaude = "'.$this->problemasaude.'", datacadastro = "'.$this->datacadastro.'", tipo = "'.$this->tipo.'", status = "'.$this->status.'" WHERE id_usuario = '.(int)$this->id);
        if($this->senha){
            Config::get()->run('UPDATE usuario SET senha = "'.$this->senha.'" WHERE id_usuario = '.(int)$this->id);
        }
        return $return;
    }

    public function delete(){
        return Config::get()->run('DELETE FROM usuario WHERE id_usuario = "'.$this->id.'"');
    }

    public function get(){
        $item = Config::get()->query('SELECT * FROM usuario WHERE id_usuario = "'.$this->id.'"');
        if($item && isset($item[0]) && $item[0]){
            return $item[0];
        }
        return false;
    }

    public function login(){
        $item = Config::get()->query('SELECT * FROM usuario WHERE status = 1 AND usuario = "'.$this->usuario.'" AND senha = "'.$this->senha.'"');
        if($item && isset($item[0]) && $item[0]){
            return $item[0];
        }
        return false;
    }

    public function listaTipo($tipo){
        return Config::get()->query('SELECT * FROM usuario WHERE status = 1 AND tipo = "'.$tipo.'"');
    }

    public function lista(){
        return Config::get()->query('SELECT * FROM usuario');
    }
}
?>