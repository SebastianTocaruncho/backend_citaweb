<?php
    class Personas{
        //Atributos

        //Constructor (1): Establece la conexión con la Base de datos
        public function __construct($conexion){
            $this->conexion = $conexion;
        }//Fin constructor (1)

        //-----------------------------------
        //métodos

        //Método (1): Consulta a las personas que contiene la tabla 'Personas'
        public function consulta(){
            $con='SELECT * FROM personas';
            $res=mysqli_query($this->conexion,$con);
            $vec=[];

            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }//fin condicional (1)

            return $vec;
        }//Fin método (1)

        //Método (2): Elimina a las personas que contiene la table 'Personas'
        public function eliminar($id){
            $del='DELETE FROM personas WHERE id_persona=$id';
            mysqli_query($this->conexion, $del);
            $vec=[];
            $vec=['resultado']='OK';
            $vec['mensaje']='Registro eliminado';
            return $vec;
        }//Fin método (2)

        //Método (3): Inserta nuevas personas a la tabla 'personas'
        public function insertar($params){
            $ins="INSERT INTO personas(dni, tipo_de_identificacion,nombre, apellido) VALUES 
            ($params->dni, '$params->tipo_de_identificacion','$params->nombre', '$params->apellido')";
            mysqli_query($this->conexion, $ins);
            $vec=[];
            $vec['resultado']='OK';
            $vec['mensaje']='El registro ha sido agregado';
            return $vec;
        }//Fin método (3)

        //Método (4): Modifica a las personas de la taabla 'Personas'
        public function editar($dni,$params){
            $editar="UPDATE personas SET dni=$params->nombre, 
            tipo_de_identificacion='$params->tipo_de_identificacion',
            nombre='$params->nombre', apellido='$params->nombre' WHERE dni=$dni";
            mysqli_query($this->conexion, $editar);
            $vec=[];
            $vec['resultado']='Ok';
            return $vec;
        }//Fin método (4)

        //Método (5): Filtra por el dni
        public function filtro($dni){
            $filtro="SELECT * FROM personas WHERE dni=  '%$dni'";
            $res=mysqli_query($this->conexion, $filtro);
            $vec=[];
            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }
            return $vec;
        }//Fin método (5)

    }//Fin clase
?>