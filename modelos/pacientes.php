<?php
    class Pacientes{
        //Atributos

        //Constructor (1): Establece la conexión con la Base de datos
        public function __construct($conexion){
            $this->conexion = $conexion;
        }//Fin constructor (1)

        //-----------------------------------
        //métodos

        //Método (1): Consulta a los pacientes que contiene la tabla 'Pacientes'
        public function consulta(){
            $con='SELECT p.*, r.rol AS Rol FROM pacientes pac INNER JOIN rol r ON pac.rol=r.id_rol
             INNER JOIN personas p ON pac.id_paciente=p.id_persona';
            $res=mysqli_query($this->conexion,$con);
            $vec=[];

            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }//fin condicional (1)

            return $vec;
        }//Fin método (1)

        //Método (2): Elimina a los pacientes que contiene la table 'Pacientes'
        public function eliminar($id){
            $del='DELETE FROM pacientes WHERE id_paciente=$id';
            mysqli_query($this->conexion, $del);
            $vec=[];
            $vec=['resultado']='OK';
            $vec['mensaje']='Registro eliminado';
            return $vec;
        }//Fin método (2)

        //Método (3): Inserta nuevos pacientes a la tabla 'pacientes'
        public function insertar($params){
            $ins="INSERT INTO pacientes(persona, rol) VALUES ('$params->persona, $params->rol)')";
            mysqli_query($this->conexion, $ins);
            $vec=[];
            $vec['resultado']='OK';
            $vec['mensaje']='El registro ha sido agregado';
            return $vec;
        }//Fin método (3)

        //Método (4): Modifica a los pacientes de la tabla 'pacientes'
        public function editar($id,$params){
            $editar="UPDATE pacientes SET persona=$params->persona, rol=$params->rol 
             WHERE id_paciente=$id";
            mysqli_query($this->conexion, $editar);
            $vec=[];
            $vec['resultado']='Ok';
            return $vec;
        }//Fin método (4)

        //Método (5): Filtra por el id
        public function filtro($valor){
            $filtro="SELECT p.*, r.rol AS Rol FROM pacientes pac INNER JOIN rol r ON pac.rol=r.id_rol INNER JOIN personas p
             ON pac.id_paciente=p.id_persona WHERE pac.id_paciente LIKE '%$valor%' OR pac.rol LIKE '%$valor%'";
            $res=mysqli_query($this->conexion, $filtro);
            $vec=[];
            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }
            return $vec;
        }//Fin método (5)

    }//Fin clase
?>