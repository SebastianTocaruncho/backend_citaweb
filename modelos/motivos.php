<?php
    class Motivos{
        //Atributos

        //Constructor (1): Establece la conexión con la Base de datos
        public function __construct($conexion){
            $this->conexion = $conexion;
        }//Fin constructor (1)

        //-----------------------------------
        //métodos

        //Método (1): Consulta los roles que contiene la tabla 'Rolo'
        public function consulta(){
            $con='SELECT * FROM motivos_de_consulta';
            $res=mysqli_query($this->conexion,$con);
            $vec=[];

            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }//fin condicional (1)

            return $vec;
        }//Fin método (1)

        //Método (2): Elimina los roles que contiene la table 'Rol'
        public function eliminar($id){
            $del='DELETE FROM motivos_de_consulta WHERE id_motivo=$id';
            mysqli_query($this->conexion, $del);
            $vec=[];
            $vec=['resultado']='OK';
            $vec['mensaje']='Registro eliminado';
            return $vec;
        }//Fin método (2)

        //Método (3): Inserta nuevos roles a la tabla 'Rol'
        public function insertar($params){
            $ins="INSERT INTO motivos_de_consulta(motivo) VALUES ('params->motivo')";
            mysqli_query($this->conexion, $ins);
            $vec=[];
            $vec['resultado']='OK';
            $vec['mensaje']='El registro ha sido agregado';
            return $vec;
        }//Fin método (3)

        //Método (4): Modifica los roles de la taabla 'Rol'
        public function editar($id,$params){
            $editar="UPDATE motivos_de_consulta SET motivo='$params->motivo' WHERE id_motivo=$id";
            mysqli_query($this->conexion, $editar);
            $vec=[];
            $vec['resultado']='Ok';
            return $vec;
        }//Fin método (4)

        //Método (5): Filtra por el rol
        public function filtro($valor){
            $filtro="SELECT * FROM motivos_de_consulta WHERE id_motivo='%$valor'";
            $res=mysqli_query($this->conexion, $filtro);
            $vec=[];
            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }
            return $vec;
        }//Fin método (5)

    }//Fin clase
?>