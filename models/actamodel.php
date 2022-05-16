<?php
class ActaModel extends Model implements IModel
{
    private $id;
    private $area;
    private $sede;
    private $municipio;
    private $departamento;
    private $asunto;
    private $fecha;
    private $horaInicio;
    private $horaFinal;
    private $tema;

    function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }

    public function getSede()
    {
        return $this->sede;
    }

    public function setSede($sede)
    {
        $this->sede = $sede;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }


    public function getAsunto()
    {
        return $this->asunto;
    }

    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getHoraIncio()
    {
        return $this->horaInicio;
    }

    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;
    }

    public function getHoraFinal()
    {
        return $this->horaFinal;
    }

    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;
    }

    public function getTema()
    {
        return $this->tema;
    }

    public function setTema($tema)
    {
        $this->tema = $tema;
    }

    public function save()
    {
        try {
            $query = $this->prepare('INSERT INTO actas(id,
            area,
            sede,
            municipio,
            departamento,
            asunto,
            fecha,
            horaInicio,
            horaFinal,
            tema) VALUES (null, :area, :sede ,:municipio,:departamento, :asunto ,:fecha,:horaInicio,:horaFinal, :tema)');
            $query->bindValue('area', $this->area);
            $query->bindValue('sede', $this->sede);
            $query->bindValue('municipio', $this->municipio);
            $query->bindValue('departamento', $this->departamento);
            $query->bindValue('asunto', $this->asunto);
            $query->bindValue('fecha', $this->fecha);
            $query->bindValue('horaInicio', $this->horaInicio);
            $query->bindValue('horaFinal', $this->horaFinal);
            $query->bindValue('tema', $this->tema);
            if ($query->execute()) {
                error_log("ActaModel::Save -> Datos ingresados con exito!");
                return true;
            } else {
                error_log("ActaModel::Save -> No se ingresaron los datos!");
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
            $query = $this->query('SELECT * FROM actas');
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new ActaModel();
                $item->setId($p['id']);
                $item->setArea($p['area']);
                $item->setSede($p['sede']);
                $item->setMunicipio($p['municipio']);
                $item->setDepartamento($p['departamento']);
                $item->setAsunto($p['asunto']);
                $item->setFecha($p['fecha']);
                $item->setHoraFinal($p['horaFinal']);
                $item->setHoraInicio($p['horaInicio']);
                $item->setTema($p['tema']);
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            error_log("ActaModel::getAll -> PDOExepcion" . $e);
            return false;
        }
    }
    public function get($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM actas WHERE id = :id ');
            $query->bindValue('id', $id);
            $query->execute();
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($user['id']);
            $this->setArea($user['area']);
            $this->setSede($user['sede']);
            $this->setMunicipio($user['municipio']);
            $this->setDepartamento($user['departamento']);
            $this->setAsunto($user['asunto']);
            $this->setFecha($user['fecha']);
            $this->setHoraFinal($user['horaFinal']);
            $this->setHoraInicio($user['horaInicio']);
            $this->setTema($user['tema']);
            return $this;
        } catch (PDOException $e) {
            error_log("ActaModel::get(id) -> PDOExepcion" . $e);
            return false;
        }
    }
    public function delete($id)
    {
        try {
            $query = $this->prepare('DELETE FROM actas WHERE id = :id ');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("ActaModel::Delete -> Datos eliminados con exito!");
                return true;
            } else {
                error_log("ActaModel::Delete -> No se eliminaron los datos!");
            }
        } catch (PDOException $e) {
            error_log("ActaModel::delete(id) -> PDOExepcion" . $e);
            return false;
        }
    }
    public function update()
    {
        try {
            $query = $this->prepare('UPDATE actas SET area = :area,
            sede = :sede,
            municipio = :municipio,
            departamento = :departamento,
            asunto = :asunto,
            fecha = :fecha,
            horaInicio = :horaInicio,
            horaFinal = :horaFinal,
            tema = :tema WHERE id = :id ');
            $query->bindValue('area', $this->area);
            $query->bindValue('sede', $this->sede);
            $query->bindValue('municipio', $this->municipio);
            $query->bindValue('departamento', $this->departamento);
            $query->bindValue('asunto', $this->asunto);
            $query->bindValue('fecha', $this->fecha);
            $query->bindValue('horaInicio', $this->horaInicio);
            $query->bindValue('horaFinal', $this->horaFinal);
            $query->bindValue('tema', $this->tema);

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
        $this->area = $array['area'];
        $this->sede = $array['sede'];
        $this->municipio = $array['municipio'];
        $this->departamento = $array['departamento'];
        $this->asunto = $array['asunto'];
        $this->fecha = $array['fecha'];
        $this->horaInicio = $array['horaInicio'];
        $this->horaFinal = $array['horaFinal'];
        $this->tema = $array['tema'];
    }
}
