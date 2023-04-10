<?php
class logbook{
    public $host;
    public $user;
    public $pass;
    public $dbms;
    public $query;
    public $statement;
    public $home;
    public $conn;


    public function __construct(){
        $this->host = "localhost";
        $this->user = "dwightxawft";
        $this->pass = "timilehin1.";
        $this->dbms = "mylogbook";
        $this->home = "localhost:80/mylogbook/";
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbms);
        if(!$this->conn){
            mysqli_connect_error($this->conn);
        }
    }
    public function execute_query(){
       if($this->conn){
        $this->statement = mysqli_query($this->conn, $this->query);
        return $this->statement;
       }
    }
    public function fetch_array(){
        $this->execute_query();
        return mysqli_fetch_array($this->statement, MYSQLI_ASSOC);
    }
    public function fetch_assoc(){
        $this->execute_query();
        return mysqli_fetch_assoc($this->statement);
    }
    public function fetch_all(){
        $this->execute_query();
        return mysqli_fetch_all($this->statement, MYSQLI_ASSOC);
    }
    public function total_rows(){
        $this->execute_query();
        return mysqli_num_rows($this->statement);
    }
    public function redirect($url){
        return "<script>window.location.href = '".$url."'</script>";
    }
    public function user_session(){
        if(!isset($_SESSION["student_id"])){
            $link = "login.php";
            echo $this->redirect($link);
        }
    }






    public function logout(){
        mysqli_close();
        session_destroy();
        echo $this->redirect("index.php");
    }

}


?>