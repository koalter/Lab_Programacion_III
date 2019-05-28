<?php
// Aca van las consultas a la base de datos
class Persona {

    public $id;
    public $nombre;
    public $edad;
    public $foto;
    // public $CreateDttm;

    public function GuardarPersona() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO persona(nombre, edad) VALUES(:nombre,:edad)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':edad', $this->edad, PDO::PARAM_INT);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function BorrarPersona() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
            DELETE FROM persona WHERE id=:id");	
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }

    public static function TraerTodasLasPersonas() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, nombre, edad FROM persona");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Persona");
    }

    public function ModificarCdParametros() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
            UPDATE persona 
            SET nombre = :nombre, edad = :edad 
            WHERE id = :id");
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
        $consulta->bindValue(':edad',$this->edad, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function TraerUnaPersona($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
            SELECT id, nombre, edad FROM persona 
            WHERE id = $id");
        $consulta->execute();
        $miPersona = $consulta->fetchObject('Persona');
        return $miPersona;
    }
}
?>