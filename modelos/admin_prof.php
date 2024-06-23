<?php
    class admin_prof{
        //Atributos

        //Constructor (1): Establece la conexión con la Base de datos
        public function __construct($conexion){
            $this->conexion = $conexion;
        }//Fin constructor (1)

        //-----------------------------------
        //métodos

        //Método (1): Consulta a los profesionales de la salud que contiene la tabla 'Profesional de la salud'
        public function consulta(){
            $con='SELECT admi.persona AS Administrador_profesional, prof.persona AS Profesional_de_la_salud FROM admin_prof adpr 
            INNER JOIN profesional_de_la_salud prof ON adpr.profesional_de_la_salud=prof.id_profesional 
            INNER JOIN administrador_centro_de_salud admi ON adpr.administrador=admi.id_admin';
            $res=mysqli_query($this->conexion,$con);
            $vec=[];

            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }//fin condicional (1)

            return $vec;
        }//Fin método (1)

        //Método (2): Elimina a las personas que contiene la table 'Profesional de la salud'
        public function eliminar($id){
            $del='DELETE FROM admin_prof WHERE administrador=$id';
            mysqli_query($this->conexion, $del);
            $vec=[];
            $vec=['resultado']='OK';
            $vec['mensaje']='Registro eliminado';
            return $vec;
        }//Fin método (2)

        //Método (3): Inserta nuevos profesionales de la salud a la tabla 'profesionales de la salud'
        public function insertar($params){
            $ins="INSERT INTO admin_prof(administrador, profesional_de_la_salud) VALUES
             ($params->administrador, $params->profesional_de_la_salud)";
            mysqli_query($this->conexion, $ins);
            $vec=[];
            $vec['resultado']='OK';
            $vec['mensaje']='El registro ha sido agregado';
            return $vec;
        }//Fin método (3)

        //Método (4): Modifica a los profesionales de la taabla 'profesionales_de_la_salud'
        public function editar($id,$params){
            $editar="UPDATE admin_prof SET administrador=$params->administrador,
            profesional_de_la_salud=$params->profesional_de_la_salud WHERE administrador=$id";
            mysqli_query($this->conexion, $editar);
            $vec=[];
            $vec['resultado']='Ok';
            return $vec;
        }//Fin método (4)

        //Método (5): Filtra por el dni
        public function filtro($valor){
            $filtro="SELECT admi.persona AS Administrador_profesional, prof.persona AS Profesional_de_la_salud FROM
             admin_prof adpr INNER JOIN profesional_de_la_salud prof ON adpr.profesional_de_la_salud=prof.id_profesional
              INNER JOIN administrador_centro_de_salud admi ON adpr.administrador=admi.id_admin WHERE adpr.administrador LIKE
               '%$valor%' OR adpr.profesional_de_la_salud LIKE '%$valor%'";
            $res=mysqli_query($this->conexion, $filtro);
            $vec=[];
            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }
            return $vec;
        }//Fin método (5)

    }//Fin clase
?>