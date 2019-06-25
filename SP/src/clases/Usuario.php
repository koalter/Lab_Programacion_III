<?php 
class Usuario {

	public $nombre;
	public $clave;
	public $tipo;
	public $legajo;
	public $email;
	public $foto;

	public static function new_Usuario($request, $response, $args) {
		$usuario = new Usuario();
    	$usuario->nombre = $request->getParsedBody()['nombre'];
    	$usuario->clave = $request->getParsedBody()['clave'];
    	if (!is_null($request->getParsedBody()['tipo']))
    		$usuario->tipo = $request->getParsedBody()['tipo'];
    	else
    		$usuario->tipo = 'usuario';

    	return $usuario;
	}

	public static function TraerUnUsuarioIdNombre($legajo, $nombre) {
		$dao = AccesoDatos::dameUnObjetoAcceso();
		$query = $dao->RetornarConsulta("SELECT nombre, clave, tipo, legajo FROM usuarios 
			WHERE legajo = $legajo AND nombre = '$nombre'");
		$query->execute();
		return $query->fetchObject('Usuario');
	}

	public static function TraerUnUsuarioPorLegajo($legajo) {
		$dao = AccesoDatos::dameUnObjetoAcceso();
		$query = $dao->RetornarConsulta("SELECT nombre, clave, tipo, legajo FROM usuarios 
			WHERE legajo = $legajo");
		$query->execute();
		return $query->fetchObject('Usuario');
	}

	public function AgregarEmail($request, $response, $args) {
		$this->email = $request->getParsedBody()['email'];

		$dao = AccesoDatos::dameUnObjetoAcceso();
		$query = $dao->RetornarConsulta("UPDATE usuarios SET email = '$this->email'
			WHERE legajo = $this->legajo");
		$query->execute();
	}

	public function AgregarFoto($request, $response, $args) {
		$archivos = $request->getUploadedFiles();
		$destino="../src/Fotos/";
		//var_dump($archivos);
		//var_dump($archivos['foto']);
		if(isset($archivos['foto']))
		{
			$nombreAnterior=$archivos['foto']->getClientFilename();
			$extension= explode(".", $nombreAnterior);
			//var_dump($nombreAnterior);
			$extension=array_reverse($extension);
			if (!file_exists($destino))
				mkdir($destino);
			$nuevoNombre = $this->legajo."_".$this->nombre.".".$extension[0];
			$archivos['foto']->moveTo($destino.$nuevoNombre);

			$this->foto = $nuevoNombre;
			$dao = AccesoDatos::dameUnObjetoAcceso();
			$query = $dao->RetornarConsulta("UPDATE usuarios SET foto = '$this->foto'
				WHERE legajo = $this->legajo");
			$query->execute();
		}
	}

	public function AgregarMaterias($request, $response, $args) {
		$this->materias = $request->getParsedBody()['materias'];

		$dao = AccesoDatos::dameUnObjetoAcceso();
		$query = $dao->RetornarConsulta("UPDATE usuarios SET materias = '$this->materias'
			WHERE legajo = $this->legajo");
		$query->execute();
	}
}

?>