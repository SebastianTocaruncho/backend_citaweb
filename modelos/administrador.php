<?php
    class Administrador{
        //Atributos

        //Constructor (1): Establece la conexión con la Base de datos
        public function __construct($conexion){
            $this->conexion = $conexion;
        }//Fin constructor (1)

        //-----------------------------------
        //métodos

        //Método (1): Consulta a los profesionales de la salud que contiene la tabla 'Profesional de la salud'
        public function consulta(){
            $con='SELECT p.*, r.rol AS Rol, c.nombre AS Centro FROM administrador_centro_de_salud admi 
            INNER JOIN rol r ON admi.rol=r.id_rol INNER JOIN personas p ON admi.id_admin=p.id_persona 
            INNER JOIN centro_de_salud c ON admi.centro_de_salud=c.id_centro';
            $res=mysqli_query($this->conexion,$con);
            $vec=[];

            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }//fin condicional (1)

            return $vec;
        }//Fin método (1)

        //Método (2): Elimina a las personas que contiene la table 'Profesional de la salud'
        public function eliminar($id){
            $del='DELETE FROM administrador_centro_de_salud WHERE id_admin=$id';
            mysqli_query($this->conexion, $del);
            $vec=[];
            $vec=['resultado']='OK';
            $vec['mensaje']='Registro eliminado';
            return $vec;
        }//Fin método (2)

        //Método (3): Inserta nuevos profesionales de la salud a la tabla 'profesionales de la salud'
        public function insertar($params){
            $ins="INSERT INTO administrador_centro_de_salud(persona, rol, centro_de_salud) 
            VALUES ($params->persona, $params->rol, $params->centro_de_salud)";
            mysqli_query($this->conexion, $ins);
            $vec=[];
            $vec['resultado']='OK';
            $vec['mensaje']='El registro ha sido agregado';
            return $vec;
        }//Fin método (3)

        //Método (4): Modifica a los profesionales de la taabla 'profesionales_de_la_salud'
        public function editar($id,$params){
            $editar="UPDATE administrador_centro_de_salud SET
             persona=$params->persona, rol=$params->rol,
            centro_de_salud=$params->centro WHERE id=$id";
            mysqli_query($this->conexion, $editar);
            $vec=[];
            $vec['resultado']='Ok';
            return $vec;
        }//Fin método (4)

        //Método (5): Filtra por el dni
        public function filtro($valor){
            $filtro="SELECT p.*, r.rol AS Rol, c.nombre AS Centro FROM administrador_centro_de_salud admi 
            INNER JOIN rol r ON admi.rol=r.id_rol INNER JOIN personas p ON admi.id_admin=p.id_persona INNER JOIN
             centro_de_salud c ON admi.centro_de_salud=c.id_centro WHERE admi.id_admin 
             LIKE '%$valor%' OR admi.rol LIKE '%$valor%' OR admi.centro_de_salud LIKE'%$valor%'";
            $res=mysqli_query($this->conexion, $filtro);
            $vec=[];
            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }
            return $vec;
        }//Fin método (5)

    }//Fin clase
?>