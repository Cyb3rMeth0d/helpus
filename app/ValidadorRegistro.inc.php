<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorRegistro {

    private $aviso_inicio;
    private $aviso_cierre;
    private $connection;
    
    
    private $first_name;
    private $last_name;
    private $email;
    private $password;
     private $cpassword;
    private $activo;
    
    public $error_fn;
    public $error_ln;
    public $error_email;
    public $error_password;
    public $error_cpassword;
     public $error_data;

    public function __construct($first_name, $last_name, $email, $password, $cpassword ,$connection) {

        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";

        $this->first_name = "";
        $this->last_name = "";
        $this->email = "";
        $this -> password = "";
    
    

        $this->error_fn = $this->validate_firstname($first_name);
        $this->error_ln = $this->validate_lastname($last_name);
        $this->error_email = $this->validate_email($connection, $email);

        $this->error_password = $this->validate_password($password);
        $this->error_cpassword = $this->validate_cpassword($password, $cpassword);
        
        if($this -> error_password === "" && $this -> error_cpassword === ""){
            $this -> password = $password;
        }
    }

    private function variable_iniciada($variable) {

        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validate_firstname($first_name) {
        if (!$this->variable_iniciada($first_name)) {
            return "Ingresa un nombre y apellido";
        } else {
            $this->first_name = $first_name;
        }
        if (strlen($first_name) < 2) {
            return "Tu nombre no puede contener sólo 1 carácter";
        }
        if (strlen($first_name) > 24) {
            return "Tu nombre no puede contener más de 24 caracteres";
        }
        return "";
    }

    private function validate_lastname($last_name) {
        if (!$this->variable_iniciada($last_name)) {
            return "Ingresa un apellido";
        } else {

            $this->last_name = $last_name;
        }

        if (strlen($last_name) < 3) {
            return "Ingresa un apellido válido por favor";
        }if (strlen($last_name) > 24) {
            return "Tu apellido no puede contener más de 24 caracteres";
        }

        return "";
    }

    private function validate_email($connection, $email) {
        if (!$this->variable_iniciada($email)) {
            return "Proporciona un email por favor";
        } else {
            $this->email = $email;
        }
        
        if (RepositorioUsuario :: email_existe($connection,$email)){
            return "Este email ya está en uso. Por favor, pruebe otro email o <a href='#'>intente recuperar su contraseña</a>.";
        }
        return "";
    }

    private function validate_password($password) {
        if (!$this->variable_iniciada($password)) {
            return "Escribe una contraseña";
        }

        return "";
    }

    private function validate_cpassword($password, $cpassword) {

        if (!$this->variable_iniciada($password)) {
            return "Pon una contraseña";
        }

        if (!$this->variable_iniciada($cpassword)) {
            return "Repite tu contraseña";
        }

        if ($password !== $cpassword) {
            return "Las contraseñas deben coincidir";
        }
        return "";
    }




    /* getters */

    public function get_firstname() {
        return $this->first_name;
    }

    public function get_lastname() {
        return $this->last_name;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_password() {
        return $this->password;
    }
    public function get_cpassword(){
    return $this->cpassword;
}


 

    /* getters fin */

    public function mostrar_firstname() {
        if ($this->first_name !== "") {
            echo 'value="' . $this->first_name . '"';
        }
    }

    public function mostrar_error_firstname() {
        if ($this->error_fn !== "") {
            echo $this->aviso_inicio . $this->error_fn . $this->aviso_cierre;
        }
    }

    public function mostrar_lastname() {
        if ($this->last_name !== "") {
            echo 'value="' . $this->last_name . '"';
        }
    }

    public function mostrar_error_lastname() {
        if ($this->error_ln !== "") {
            echo $this->aviso_inicio . $this->error_ln . $this->aviso_cierre;
        }
    }

    public function mostrar_email() {
        if ($this->email !== "") {
            echo 'value="' . $this->email . '"';
        }
    }

    public function mostrar_error_email() {
        if ($this->error_email !== "") {
            echo $this->aviso_inicio . $this->error_email . $this->aviso_cierre;
        }
    }

    public function mostrar_error_password() {
        if ($this->error_password !== "") {
            echo $this->aviso_inicio . $this->error_password . $this->aviso_cierre;
        }
    }

    public function mostrar_error_cpassword() {
        if ($this->error_cpassword !== "") {
            echo $this->aviso_inicio . $this->error_cpassword . $this->aviso_cierre;
        }
    }

    public function registro_valido() {
        if ($this->error_fn === "" &&
                $this->error_ln === "" &&
                $this->error_email === "" &&
                $this->error_password === "" &&
                $this->error_cpassword === "") {
            return true;
        } else {
            return false;
        }
    }

}

