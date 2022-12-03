<?php

require('../../conexion.php');
$conexionBD = Conectar();

if (isset($_GET["categoria"])) {
    $data = json_decode(file_get_contents("php://input"));
    $consulta = $_GET["categoria"];
    $sqlodak = mysqli_query($conexionBD, "SELECT * FROM categoria WHERE descripcion LIKE '%$consulta%'");
    if (mysqli_num_rows($sqlodak) > 0) {
        $categoria = mysqli_fetch_all($sqlodak, MYSQLI_ASSOC);
        echo json_encode($categoria);
        exit();
    } else {
        exit();
    }
    exit();
}

if (isset($_GET["registrarEmpresa"])) {
    $data = json_decode(file_get_contents("php://input"));
    $rut = $data->rut;
    $nombre_fantasia = $data->nombre_fantasia;
    $categoria = $data->categoria;
    $comuna = $data->comuna;
    $direccion = $data->direccion;
    $telefono = $data->telefono;
    $correo = $data->correo;
    $titulo_descripcion = $data->titulo_descripcion;
    $descripcion = $data->descripcion;
    $imagen_logo = $data->imagen_logo;
    $imagen_fondo = $data->imagen_fondo;
    $twitter = $data->twitter;
    $facebook = $data->facebook;
    $whatsapp = $data->whatsapp;
    $instagram = $data->instagram;
    $linkedin = $data->linkedin;
    $sql = "INSERT INTO `empresa`( `rut`, `nombre_fantasia`, `categoria`, `comuna`, `direccion`, `telefono`, `correo`,`titulo_descripcion`, `descripcion`, `imagen_logo`, `imagen_fondo`, `twitter`, `facebook`, `whatsapp`, `instagram`, `linkedin`)
     VALUES ('$rut','$nombre_fantasia',$categoria,$comuna,'$direccion','$telefono','$correo','$titulo_descripcion','$descripcion','$imagen_logo','$imagen_fondo','$twitter','$facebook','$whatsapp','$instagram','$linkedin')";

    if ($rut === '') {
        echo json_encode(["mensaje" => 'Falta el rut']);
        exit();
    }

    if ($categoria === '') {
        echo json_encode(["mensaje" => 'Falta la categoria']);
        exit();
    }
    $sqlodak = mysqli_query($conexionBD, $sql);
    if ($sqlodak) {
        echo json_encode(["mensaje" => 'Empresa registrada']);
    } else {
        echo json_encode(["mensaje" => 'Error en la sintaxis']);
    }

    exit();
}

if (isset($_GET["consultarEmpresa"])) {
    $consulta = "SELECT e.id,e.rut,e.nombre_fantasia,c.descripcion as 'categoria',co.descripcion as 'comuna' ,e.direccion,e.telefono,e.correo,e.titulo_descripcion,e.descripcion,e.imagen_logo,e.imagen_fondo,e.twitter,e.facebook,e.whatsapp,e.instagram,e.linkedin
    FROM empresa e, categoria c, comuna co
    WHERE (e.categoria=c.id) AND (e.comuna=co.id) AND e.id=" . $_GET["consultarEmpresa"];
    $sqlodak = mysqli_query($conexionBD, $consulta);
    if (mysqli_num_rows($sqlodak) > 0) {
        $empresa = mysqli_fetch_all($sqlodak, MYSQLI_ASSOC);
        echo json_encode($empresa);
        exit();
    } else {
        echo json_encode(["mensaje" => 'no se encontró la empresa']);
    }
}

if (isset($_GET["consultarParaEditar"])) {
    $consulta = "SELECT * FROM empresa WHERE id=" . $_GET["consultarParaEditar"];
    $sqlodak = mysqli_query($conexionBD, $consulta);
    if (mysqli_num_rows($sqlodak) > 0) {
        $empresa = mysqli_fetch_all($sqlodak, MYSQLI_ASSOC);
        echo json_encode($empresa);
        exit();
    } else {
        echo json_encode(["mensaje" => 'no se encontró la empresa']);
    }
}

if (isset($_GET["actualizarEmpresa"])) {
    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;
    $rut = $data->rut;
    $nombre_fantasia = $data->nombre_fantasia;
    $categoria = $data->categoria;
    $comuna = $data->comuna;
    $direccion = $data->direccion;
    $telefono = $data->telefono;
    $correo = $data->correo;
    $titulo_descripcion = $data->titulo_descripcion;
    $descripcion = $data->descripcion;
    $imagen_logo = $data->imagen_logo;
    $imagen_fondo = $data->imagen_fondo;
    $twitter = $data->twitter;
    $facebook = $data->facebook;
    $whatsapp = $data->whatsapp;
    $instagram = $data->instagram;
    $linkedin = $data->linkedin;
    $sql = "UPDATE empresa SET rut='$rut', nombre_fantasia='$nombre_fantasia', categoria=$categoria, comuna=$comuna, direccion='$direccion', telefono='$telefono',
            correo='$correo', titulo_descripcion='$titulo_descripcion', descripcion='$descripcion', imagen_logo='$imagen_logo', imagen_fondo='$imagen_fondo',
            twitter='$twitter', facebook='$facebook', whatsapp='$whatsapp', instagram='$instagram', linkedin='$linkedin'
            WHERE id=$id";
    $sqlodak = mysqli_query($conexionBD, $sql);
    if ($sqlodak) {
        echo json_encode(["mensaje" => 'Cambios realizados']);
    } else {
        echo json_encode(["mensaje" => 'Error en la sintaxis']);
    }

    exit();
}

if (isset($_GET["cotizarEmpresa"])) {
    $data = json_decode(file_get_contents("php://input"));
    $empresa = $data->empresa;
    $cliente = $data->cliente;
    $correo_cliente = $data->correo_cliente;
    $telefono_cliente = $data->telefono_cliente;
    $solicitud_cliente = $data->solicitud_cliente;

    $sql = "INSERT INTO cotizacion (empresa,cliente,correo_cliente,telefono_cliente,solicitud_cliente)
            VALUES ($empresa,'$cliente','$correo_cliente','$telefono_cliente','$solicitud_cliente')";
    $sqlodak = mysqli_query($conexionBD, $sql);
    if ($sqlodak) {
        echo json_encode(["mensaje" => 'Cotización Enviada']);
    } else {
        echo json_encode(["mensaje" => 'Error en la sintaxis']);
    }
}

if (isset($_GET["landingEmpresa"])) {
    $consulta = "SELECT id, imagen_logo, nombre_fantasia FROM empresa ORDER BY id DESC LIMIT 4;";
    $sqlodak = mysqli_query($conexionBD, $consulta);
    if (mysqli_num_rows($sqlodak) > 0) {
        $empresa = mysqli_fetch_all($sqlodak, MYSQLI_ASSOC);
        echo json_encode($empresa);
        exit();
    } else {
        echo json_encode(["mensaje" => 'no se encontró la empresa']);
    }
}

if (isset($_GET["contarCotizacion"])) {
    $consulta = "SELECT empresa, COUNT(ID) AS 'cantidad' FROM cotizacion WHERE empresa=".$_GET["contarCotizacion"].";";
    $sqlodak = mysqli_query($conexionBD, $consulta);
    if (mysqli_num_rows($sqlodak) > 0) {
        $empresa = mysqli_fetch_all($sqlodak, MYSQLI_ASSOC);
        echo json_encode($empresa);
        exit();
    } else {
        echo json_encode(["mensaje" => 'no se encontró la empresa']);
    }
}

if (isset($_GET["grillaEmpresa"])) {
    $consulta = "SELECT e.id as 'id', e.rut as 'rut', e.nombre_fantasia as 'nombre_fantasia', e.categoria as 'categoria', e.comuna as 'comuna', e.direccion as 'direccion',
                 e.telefono as 'telefono', e.correo as 'correo', e.titulo_descripcion as 'titulo_descripcion', e.descripcion as 'descripcion', e.twitter as 'twitter',
                 e.facebook as 'facebook', e.whatsapp as 'whatsapp', e.instagram as 'instagram', e.linkedin as 'linkedin', e.imagen_logo as 'imagen_logo', e.imagen_fondo as 'imagen_fondo'
                 FROM referencias r,empresa e
                 WHERE (r.empresa=e.id) AND ((r.descripcion like '%". $_GET["grillaEmpresa"] ."%') OR (e.descripcion like '%". $_GET["grillaEmpresa"] ."%'))
                 GROUP BY e.id;";
    $sqlodak = mysqli_query($conexionBD, $consulta);
    if (mysqli_num_rows($sqlodak) > 0) {
        $empresa = mysqli_fetch_all($sqlodak, MYSQLI_ASSOC);
        echo json_encode($empresa);
        exit();
    } else {
        echo json_encode(["mensaje" => 'referencias no encontradas']);
    }
}

if (isset($_GET["agregarReferencia"])) {
    $data = json_decode(file_get_contents("php://input"));
    $empresa = $data->empresa;
    $descripcion = $data->descripcion;

    $sql = "INSERT INTO referencias (empresa,descripcion) VALUES ($empresa,'$descripcion')";
    $sqlodak = mysqli_query($conexionBD, $sql);
    if ($sqlodak) {
        echo json_encode(["mensaje" => 'Referencia Agregada']);
    } else {
        echo json_encode(["mensaje" => 'Error en la sintaxis']);
    }
}

if (isset($_GET["buscarReferencia"])) {
    $consulta = "SELECT * FROM referencias WHERE empresa=" . $_GET["buscarReferencia"];
    $sqlodak = mysqli_query($conexionBD, $consulta);
    if (mysqli_num_rows($sqlodak) > 0) {
        $empresa = mysqli_fetch_all($sqlodak, MYSQLI_ASSOC);
        echo json_encode($empresa);
        exit();
    } else {
        echo json_encode(["mensaje" => 'referencias no encontradas']);
    }
}

if (isset($_GET["borrarReferencia"])) {
    $sqlodak = mysqli_query($conexionBD, "DELETE FROM referencias WHERE id=" . $_GET["borrarReferencia"]);
    if ($sqlodak) {
        echo json_encode(["success" => 1]);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}
