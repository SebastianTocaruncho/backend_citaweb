<?php
    header('Access-Control-Allow-Origin:*');
    header("Access-Control-Allow-Header:Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/pacientes.php");

    $control=$_GET['$control'];

    $pacientes=new Pacientes($conexion);

    switch ($control) {
        //------------------
        //Consulta
        case 'consulta':
            $vec=$pacientes->consulta();
        break;
        //------------------
        //Insertar
        case 'insertar':
            $json=file_get_contents('php://input');
            //$json='{"rol":"Paciente"}';
            $params=json_decode($json);
            $vec=$pacientes->insertar($params);
        break;
        //------------------
        //Eliminar
        case 'eliminar':
            $id=$_GET['$id'];
            $vec=$pacientes->eliminar($id);
        break;
        //-------------------
        //Actualizar
        case 'editar':
            $json=file_get_contents('php://input');
            $params=json_decode($json);
            $id=$_GET['id'];
            $vec=$pacientes->editar($id, $params);
        break;
        //-------------------
        //Filtro
        case 'filtro':
            $dato=$$_GET['dato'];
            $vec=$pacientes->filtro($dato);
    }

    $datosj=json_encode($vec);
    echo $datosj;

?>