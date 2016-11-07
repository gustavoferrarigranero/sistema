<?php
class Config {

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $database = 'sistema';
    private $link;
    private static $instance;

    public function __construct(){
        require_once "autoload.php";
        $this->connect();

        $configs = $this->query('SELECT * FROM conf');
        foreach($configs as $item){
            define(strtoupper($item['item']),$item['valor']);
        }
        self::$instance = $this;
    }

    private function connect(){
        $this->link = mysqli_connect($this->host,$this->user,$this->pass);
        mysqli_select_db($this->link,$this->database);
    }

    public function run($query){
        return mysqli_query($this->link,$query);
    }

    public function query($query){
        $result = mysqli_query($this->link,$query);
        if($result){
            $linhas = array();
            while($item = mysqli_fetch_assoc($result)){
                $linhas[] = $item;
            }
            return $linhas;
        }
        return false;
    }

    public static function get(){
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

} 