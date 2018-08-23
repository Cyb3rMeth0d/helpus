<?php

class Usuario {
    
    private $id_user;
    private $name;
    private $lastname;
    private $email;
    private $password;
    private $data;
    private $fecha_registro;
     private $poblacion;
    private $activo;
    
        public function __construct($id_user, $name,$lastname, $email, $password,$data, $fecha_registro, $poblacion,$activo) {
        $this -> id_user = $id_user;
        $this -> name = $name;
        $this -> lastname = $lastname;
        $this -> email = $email;
        $this -> password = $password;
        $this -> data = $data;
        $this -> fecha_registro = $fecha_registro;
         $this -> poblacion = $poblacion;
        $this -> activo = $activo;
    }
    
    public function obtener_id() {
        return $this -> id_user;
    }
    
    public function obtener_nombre() {
        return $this -> name;
    }

public function obtener_apellido() {
        return $this -> lastname;
    }
    
    public function obtener_email() {
        return $this -> email;
    }
    public function obtener_password() {
        return $this -> password;
    }
    
    public function obtener_fecha_registro() {
        return $this -> fecha_registro;
    }

     public function obtener_data() {
        return $this -> data;
    }
    

     public function obtener_poblacion() {
        return $this -> poblacion;
    }
    public function esta_activo() {
        return $this -> activo;
    }
    
    public function cambiar_nombre($name) {
        $this -> name = $name;
    }

  public function cambiar_apellido($lastname) {
        $this -> lastname = $lastname;
    }
    
    
    public function cambiar_email($email) {
        $this -> email = $email;
    }
    
    public function cambiar_password($password) {
        $this -> password = $password;
    }

      public function cambiar_poblacion($poblacion) {
        $this -> activo = $poblacion;
    }
    
    public function cambiar_activo($activo) {
        $this -> activo = $activo;
    }
}
