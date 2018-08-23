<?php

class RepositorioUsuario {
 
    public static function obtener_todos($conexion) {
        
        $users = array();
        
        if (isset($conexion)) {
            
            try {
                
                include_once 'Usuario.inc.php';
                
                $sql = "SELECT * FROM users";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $users[] = new Usuario(
                                $fila['id_user'], $fila['name'],$fila['lastname'], $fila['email'], $fila['password'], $fila['data'],$fila['fecha_registro'], $fila['poblacion'], $fila['activo']
                        );
                    }
                } else {
                    print 'No hay users';
                }
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            } 
        }
        
        return $users;      
    }
    
    public static function obtener_numero_users($conexion) {
        $total_users = null;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM users";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $total_users = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $total_users;
    }


    public static function obtener_poblaciones($conexion) {
        $poblacion = null;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT poblacion as Poblaciones FROM poblacion";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                
                $poblacion = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $poblacion;
    }
    
    
    public static function insertar_usuario($conexion, $usuario) {
        $usuario_insertado = false;
        
        if (isset($conexion)) {
            try {
                $sql = 'INSERT INTO users(name,lastname,email, password,data, fecha_registro, poblacion, activo) VALUES(:name,:lastname,:email,:password,:data, NOW(), 0,0)';
                
                $sentencia = $conexion -> prepare($sql);

                $obtener_nombre = $usuario->obtener_nombre();
                $obtener_apellido=$usuario->obtener_apellido();
                $obtener_email=$usuario->obtener_email();
                $obtener_password=$usuario->obtener_password();
                $obtener_data=$usuario->obtener_data();

                $sentencia -> bindParam(':name', $obtener_nombre, PDO::PARAM_STR);
                $sentencia -> bindParam(':lastname', $obtener_apellido, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $obtener_email, PDO::PARAM_STR);
                $sentencia -> bindParam(':password', $obtener_password, PDO::PARAM_STR);
                $sentencia -> bindParam(':data', $obtener_data, PDO::PARAM_STR);
                
            
              
                $usuario_insertado = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $usuario_insertado;
    }
    
    public static function name_existe($conexion, $name) {
        $name_existe = true;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM users WHERE name = :name";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':name', $name, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    $name_existe = true;
                } else {
                    $name_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $name_existe;
    }
    
    public static function email_existe($conexion, $email) {
        $email_existe = true;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM users WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    $email_existe = true;
                } else {
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $email_existe;
    }
    
    public static function obtener_usuario_por_email($conexion, $email) {
        $usuario = null;
        
        if (isset($conexion)) {
            try {
                include_once 'Usuario.inc.php';
                
                $sql = "SELECT * FROM users WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id_user'],
                            $resultado['name'],
                            $resultado['lastname'],
                            $resultado['email'],
                            $resultado['password'],
                            $resultado['data'],
                            $resultado['fecha_registro'],
                            $resultado['poblacion'],
                            $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $usuario;
    }
    
    public static function obtener_usuario_por_id_user($conexion, $id_user) {
        $usuario = null;
        
        if (isset($conexion)) {
            try {
                include_once 'Usuario.inc.php';
                
                $sql = "SELECT * FROM users WHERE id_user = :id_user";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':id_user', $id_user, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id_user'],
                            $resultado['name'],
                            $resultado['lastname'],
                            $resultado['email'],
                            $resultado['password'],
                            $resultado['data'],
                            $resultado['fecha_registro'],
                            $resultado['poblacion'],
                            $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $usuario;
    }

    public static function actualizar_password($conexion, $id_user_usuario, $nueva_clave) {
        $actualizacion_correcta = false;

        if (isset($conexion)) {
            try  {
                $sql = "UPDATE users SET password = :password WHERE id_user = :id_user";

                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':password', $nueva_clave, PDO::PARAM_STR);
                $sentencia -> bindParam(':id_user', $id_user_usuario, PDO::PARAM_STR);

                $sentencia -> execute();

                $resultado = $sentencia -> rowCount();

                if (count($resultado)) {
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }
            } catch(PDOException $ex) {
                print 'ERROR'.$ex -> getMessage();
            }
        }

        return $actualizacion_correcta;
    }
}