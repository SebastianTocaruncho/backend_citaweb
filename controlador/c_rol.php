<?php
    header('Access-Control-Allow-Origin:*');
    header("Access-Control-Allow-Header:Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/rol.php");

    $control=$_GET['$control'];

    $rol=new rol($conexion);

    switch ($control) {
        //------------------
        //Consulta
        case 'consulta':
            $vec=$rol->consulta();
        break;
        //------------------
        //Insertar
        case 'insertar':
            $json=file_get_contents('php://input');
            //$json='{"rol":"Paciente"}';
            $params=json_decode($json);
            $vec=$rol->insertar($params);
        break;
        //------------------
        //Eliminar
        case 'eliminar':
            $id=$_GET['$id'];
            $vec=$rol->eliminar($id);
        break;
        //-------------------
        //Actualizar
        case 'editar':
            $json=file_get_contents('php://input');
            $params=json_decode($json);
            $id=$_GET['id'];
            $vec=$rol->editar($id, $params);
        break;
        //-------------------
        //Filtro
        case 'filtro':
            $dato=$$_GET['dato'];
            $vec=$rol->filtro($dato);
    }

    $datosj=json_encode($vec);
    echo $datosj;

?>