<?php
class UserModel extends Model implements IModel
{
    private $id;
    private $nombres;
    private $apellidos;
    private $usuario;
    private $contraseña;
    private $email;
    private $genero;
    private $estado;
    private $fecha_de_creacion;
    private $fecha_ultimo_acceso;
    private $rol;
    private $ip_ultimo_acceso;
    private $imagen_perfil;



    function __construct()
    {
        parent::__construct();
        $this->nombres =  '';
        $this->apellidos = '';
        $this->usuario = '';
        $this->contraseña = '';
        $this->email = '';
        $this->genero = '';
        $this->estado = '';
        $this->fecha_de_creacion = '';
        $this->fecha_ultimo_acceso = '';
        $this->rol =  '';
        $this->ip_ultimo_acceso = '';
        $this->imagen_perfil = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }

    public function setContraseña($contraseña)
    {
        $this->contraseña = sha1($contraseña);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getFecha_de_creacion()
    {
        return $this->fecha_de_creacion;
    }

    public function setFecha_de_creacion($fecha_de_creacion)
    {
        $this->fecha_de_creacion = $fecha_de_creacion;
    }

    public function getFecha_ultimo_acceso()
    {
        return $this->fecha_ultimo_acceso;
    }

    public function setFecha_ultimo_acceso($fecha_ultimo_acceso)
    {
        $this->fecha_ultimo_acceso = $fecha_ultimo_acceso;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getIp_ultimo_acceso()
    {
        return $this->ip_ultimo_acceso;
    }

    public function setIp_ultimo_acceso($ip_ultimo_acceso)
    {
        $this->ip_ultimo_acceso = $ip_ultimo_acceso;
    }

    public function getImagen_perfil()
    {
        return $this->imagen_perfil;
    }

    public function setImagen_perfil($imagen_perfil)
    {
        $this->imagen_perfil = $imagen_perfil;
    }

    public function exists($usuario, $contraseña)
    {
        try {
            $query = $this->prepare('SELECT usuario, contraseña FROM usuarios WHERE usuario = :usuario');
            $query->bindValue('usuario', $usuario);
            $query->execute();
            if ($query->rowCount() > 0) {
                $resultado = $query->fetch();
                $contraseña_validar = $resultado['contraseña'];
                if (password_verify($contraseña, $contraseña_validar)) {
                    error_log("UserModel::exits -> existe usuarios");
                    return true;
                }
            } else {
                error_log("UserModel::Save -> No existe usuario");
                return false;
            }
        } catch (PDOException $e) {
            error_log("UserModel::exists -> PDOExepcion" . $e);
            return false;
        }
    }

    public function save()
    {
        $revisar = getimagesize([$this->imagen_perfil]["tmp_name"]);
        if ($revisar !== false) {
            $image = [$this->imagen_perfil]['tmp_name'];
            $this->setImagen_perfil(addslashes(file_get_contents($image)));
        } else {
            $this->setImagen_perfil(addslashes(file_get_contents("assets/img/users/user1.png")));
        }

        try {
            $query = $this->prepare('INSERT INTO usuarios(nombres,
            apellidos,
            usuario,
            contraseña,
            email,
            genero,
            estado,
            fecha_de_creacion,
            fecha_ultimo_acceso,
            rol,
            ip_ultimo_acceso,
            imagen_perfil) VALUES (null, :nombres, :apellidos,:contraseña, :usuario ,:email,:genero,:estado, now(), now(),:rol ,:ip_ultimo_acceso, :imagen_perfil)');
            $query->bindValue('nombres', $this->nombres);
            $query->bindValue('apellidos', $this->apellidos);
            $query->bindValue('usuario', $this->usuario);
            $query->bindValue('contraseña', $this->contraseña);
            $query->bindValue('email', $this->email);
            $query->bindValue('genero', $this->genero);
            $query->bindValue('estado', $this->estado);
            $query->bindValue('rol', $this->rol);
            $query->bindValue('ip_ultimo_acceso', $this->ip_ultimo_acceso);
            $query->bindValue('imagen_perfil', $this->imagen_perfil);

            if ($query->execute()) {
                error_log("UserModel::Save -> Datos ingresados con exito!");
                return true;
            } else {
                error_log("UserModel::Save -> No se ingresaron los datos!");
            }
        } catch (PDOException $e) {
            error_log("UserModel::Save -> PDOExepcion" . $e);
            return false;
        }
    }
    public function getAll()
    {
        $items = [];
        try {
            $query = $this->query('SELECT * FROM usuarios');
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new UserModel();
                $item->setId($p['id']);
                $item->setNombres($p['nombres']);
                $item->setApellidos($p['apellidos']);
                $item->setUsuario($p['usuario']);
                $item->setContraseña($p['contraseña']);
                $item->setEmail($p['email']);
                $item->setGenero($p['genero']);
                $item->setEstado($p['estado']);
                $item->setFecha_de_creacion($p['fecha_de_creacion']);
                $item->setIp_ultimo_acceso($p['fecha_ultimo_acceso']);
                $item->setRol($p['rol']);
                $item->setIp_ultimo_acceso($p['ip_ultimo_acceso']);
                $item->setImagen_perfil(base64_encode($p['imagen_perfil']));
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            error_log("UserModel::getAll -> PDOExepcion" . $e);
            return false;
        }
    }
    public function get($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM usuarios WHERE id = :id ');
            $query->bindValue('id', $id);
            $query->execute();
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($user['id']);
            $this->setNombres($user['nombres']);
            $this->setApellidos($user['apellidos']);
            $this->setUsuario($user['usuario']);
            $this->setContraseña($user['contraseña']);
            $this->setEmail($user['email']);
            $this->setGenero($user['genero']);
            $this->setEstado($user['estado']);
            $this->setFecha_de_creacion($user['fecha_de_creacion']);
            $this->setFecha_ultimo_acceso($user['fecha_ultimo_acceso']);
            $this->setRol($user['rol']);
            $this->setIp_ultimo_acceso($user['ip_ultimo_acceso']);
            $this->setImagen_perfil(base64_encode($user['imagen_perfil']));
            return $this;
        } catch (PDOException $e) {
            error_log("UserModel::get(id) -> PDOExepcion" . $e);
            return false;
        }
    }
    public function delete($id)
    {
        try {
            $query = $this->prepare('DELETE FROM usuarios WHERE id = :id ');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("UserModel::Delete -> Datos eliminados con exito!");
                return true;
            } else {
                error_log("UserModel::Delete -> No se eliminaron los datos!");
            }
        } catch (PDOException $e) {
            error_log("UserModel::delete(id) -> PDOExepcion" . $e);
            return false;
        }
    }
    public function update()
    {
        $revisar = getimagesize([$this->imagen_perfil]["tmp_name"]);
        if ($revisar !== false) {
            $image = [$this->imagen_perfil]['tmp_name'];
            $this->setImagen_perfil(addslashes(file_get_contents($image)));
        } else {
            $this->setImagen_perfil(addslashes(file_get_contents("assets/img/users/user1.png")));
        }

        try {
            $query = $this->prepare('UPDATE usuarios SET nombres = :nombres,
            apellidos = :apellidos,
            usuario = :usuario,
            contraseña = :contraseña,
            email = :email,
            genero = :genero,
            estado = :estado,
            fecha_ultimo_acceso = now(),
            rol = :rol,
            ip_ultimo_acceso = :ip_ultimo_acceso,
            imagen_perfil = :imagen_perfil WHERE id = :id ');
            $query->bindValue('id', $this->id);
            $query->bindValue('nombres', $this->nombres);
            $query->bindValue('apellidos', $this->apellidos);
            $query->bindValue('usuario', $this->usuario);
            $query->bindValue('contraseña', $this->contraseña);
            $query->bindValue('email', $this->email);
            $query->bindValue('genero', $this->genero);
            $query->bindValue('estado', $this->estado);
            $query->bindValue('rol', $this->rol);
            $query->bindValue('ip_ultimo_acceso', $this->ip_ultimo_acceso);
            $query->bindValue('imagen_perfil', $this->imagen_perfil);

            if ($query->execute()) {
                error_log("UserModel::Update -> Datos actualizados con exito!");
                return true;
            } else {
                error_log("UserModel::update -> No se actualizaron los datos!");
            }
        } catch (PDOException $e) {
            error_log("UserModel::Update -> PDOExepcion" . $e);
            return false;
        }
    }
    public function from($array)
    {
        $this->id = $array['id'];
        $this->nombres = $array['nombres'];
        $this->apellidos = $array['apellidos'];
        $this->usuario = $array['usuario'];
        $this->contraseña = $array['contraseña'];
        $this->email = $array['email'];
        $this->genero = $array['genero'];
        $this->estado = $array['estado'];
        $this->rol = $array['rol'];
        $this->ip_ultimo_acceso = $array['ip_ultimo_acceso'];
        $this->imagen_perfil = $array['imagen_perfil'];
    }
}
