<?php
    class Centros{
        //Atributos

        //Constructor (1): Establece la conexión con la Base de datos
        public function __construct($conexion){
            $this->conexion = $conexion;
        }//Fin constructor (1)

        //-----------------------------------
        //métodos

        //Método (1): Consulta los roles que contiene la tabla 'Rolo'
        public function consulta(){
            $con='SELECT ctro.nombre AS Nombre_del_centro, ctro.direccion 
            AS Direccion_del_centro, c.ciudad AS ciudad FROM centro_de_salud ctro
            INNER JOIN ciudad c ON ctro.ciudad=c.id_ciudad';
            $res=mysqli_query($this->conexion,$con);
            $vec=[];

            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }//fin condicional (1)

            return $vec;
        }//Fin método (1)

        //Método (2): Elimina los roles que contiene la table 'Rol'
        public function eliminar($id){
            $del='DELETE FROM centro_de_salud WHERE id_centro=$id';
            mysqli_query($this->conexion, $del);
            $vec=[];
            $vec=['resultado']='OK';
            $vec['mensaje']='Registro eliminado';
            return $vec;
        }//Fin método (2)

        //Método (3): Inserta nuevos roles a la tabla 'Rol'
        public function insertar($params){
            $ins="INSERT INTO centro_de_salud(nombre, direccion, ciudad) 
            VALUES ('$params->nombre, $params->direccion, $params->ciudad')";
            mysqli_query($this->conexion, $ins);
            $vec=[];
            $vec['resultado']='OK';
            $vec['mensaje']='El registro ha sido agregado';
            return $vec;
        }//Fin método (3)

        //Método (4): Modifica los roles de la taabla 'Rol'
        public function editar($id,$params){
            $editar="UPDATE centro_de_salud SET nombre='$params->direccion',
            direccion='$params->direccion', ciudad=$params->ciudad WHERE id_centro=$id";
            mysqli_query($this->conexion, $editar);
            $vec=[];
            $vec['resultado']='Ok';
            return $vec;
        }//Fin método (4)

        //Método (5): Filtra por el rol
        public function filtro($valor){
            $filtro="SELECT ctro.nombre AS Nombre_del_centro, ctro.direccion AS Direccion_del_centro, c.ciudad AS ciudad 
            FROM centro_de_salud ctro INNER JOIN ciudad c ON ctro.nombre=c.id_ciudad WHERE ctro.nombre LIKE '%$valor%'
             OR ctro.nombre LIKE '%$valor%' OR ctro.ciudad LIKE '%$valor%'";
            $res=mysqli_query($this->conexion, $filtro);
            $vec=[];
            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }
            return $vec;
        }//Fin método (5)

    }//Fin clase
?>