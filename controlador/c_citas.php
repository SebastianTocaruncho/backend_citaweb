<?php
    header('Access-Control-Allow-Origin:*');
    header("Access-Control-Allow-Header:Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/citas.php");

    $control=$_GET['$control'];

    $citas=new Citas($conexion);

    switch ($control) {
        //------------------
        //Consulta
        case 'consulta':
            $vec=$citas->consulta();
        break;
        //------------------
        //Insertar
        case 'insertar':
            $json=file_get_contents('php://input');
            //$json='{"rol":"Paciente"}';
            $params=json_decode($json);
            $vec=$citas->insertar($params);
        break;
        //------------------
        //Eliminar
        case 'eliminar':
            $id=$_GET['$id'];
            $vec=$citas->eliminar($id);
        break;
        //-------------------
        //Actualizar
        case 'editar':
            $json=file_get_contents('php://input');
            $params=json_decode($json);
            $id=$_GET['id'];
            $vec=$citas->editar($id, $params);
        break;
        //-------------------
        //Filtro
        case 'filtro':
            $dato=$$_GET['dato'];
            $vec=$citas->filtro($dato);
    }

    $datosj=json_encode($vec);
    echo $datosj;

?>