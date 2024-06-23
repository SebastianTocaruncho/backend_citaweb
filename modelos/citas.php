<?php
    class Citas{
        //Atributos

        //Constructor (1): Establece la conexión con la Base de datos
        public function __construct($conexion){
            $this->conexion = $conexion;
        }//Fin constructor (1)
        //-----------------------------------
        //métodos

        //Método (1): Consulta los roles que contiene la tabla 'Rolo'
        public function consulta(){
            $con='SELECT p.persona AS Persona, prof.persona AS Profesional_de_la_salud, m.motivo AS Motivo_de_consulta 
            FROM citas c INNER JOIN pacientes p ON c.paciente=p.id_paciente INNER JOIN profesional_de_la_salud prof 
            ON c.profesional=prof.id_profesional INNER JOIN motivos_de_consulta m ON c.motivo_de_consulta=m.id_motivo';
            $res=mysqli_query($this->conexion,$con);
            $vec=[];

            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }//fin condicional (1)

            return $vec;
        }//Fin método (1)

        //Método (2): Elimina los roles que contiene la table 'Rol'
        public function eliminar($id){
            $del='DELETE FROM citas WHERE id_cita=$id';
            mysqli_query($this->conexion, $del);
            $vec=[];
            $vec=['resultado']='OK';
            $vec['mensaje']='Registro eliminado';
            return $vec;
        }//Fin método (2)

        //Método (3): Inserta nuevos roles a la tabla 'Rol'
        public function insertar($params){
            $ins="INSERT INTO citas(paciente, profesional, motivo_de_consulta) VALUES 
            ('$params->paciente, $params->pacienteprofesional, $params->pacientemotivo_de_consulta)')";
            mysqli_query($this->conexion, $ins);
            $vec=[];
            $vec['resultado']='OK';
            $vec['mensaje']='El registro ha sido agregado';
            return $vec;
        }//Fin método (3)

        //Método (4): Modifica los roles de la taabla 'Rol'
        public function editar($id,$params){
            $editar="UPDATE citas SET paciente=$params->paciente,
            profesional=$params->profesional, motivo_de_consulta=$params->motivo WHERE id_cita=$id";
            mysqli_query($this->conexion, $editar);
            $vec=[];
            $vec['resultado']='Ok';
            return $vec;
        }//Fin método (4)

        //Método (5): Filtra por el rol
        public function filtro($valor){
            $filtro="SELECT p.persona AS Persona, prof.persona AS Profesional_de_la_salud, m.motivo AS Motivo_de_consulta 
            FROM citas c INNER JOIN pacientes p ON c.paciente=p.id_paciente INNER JOIN profesional_de_la_salud prof 
            ON c.profesional=prof.id_profesional INNER JOIN motivos_de_consulta m ON c.motivo_de_consulta=m.id_motivo 
            WHERE c.paciente LIKE '%$valor%' OR c.profesional LIKE '%$valor%'OR c.motivo_de_consulta LIKE'%$valor%'";
            $res=mysqli_query($this->conexion, $filtro);
            $vec=[];
            while($row=mysqli_fetch_array($res)){
                $vec[]=$row;
            }
            return $vec;
        }//Fin método (5)

    }//Fin clase
?>