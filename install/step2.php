<?php session_start(); ?>

<script src="../plantillas/js/jquery.min.js">
</script>
<script src="../plantillas/js/bootstrap.js">
</script>
<link href="../plantillas/icomoon/style.css" rel="stylesheet">
<link href="../plantillas/css/main.css" rel="stylesheet">
<link href="../plantillas/css/bootstrap.css" rel="stylesheet">


<?php
$error = 0;



if (isset($_POST['btn-install'])) {

    if($_FILES['file']['name'] != ''){


        $uploadfile = '../uploads/sql/'.basename($_FILES['file']['name']);


    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

      //  echo "El archivo es válido y fue cargado exitosamente.\n";

    $_SESSION['upload'] = basename($_FILES['file']['name']);

    } else {
      //  echo "¡Posible ataque de carga de archivos!\n";
    }
    }

    // validation
    if ($_POST['inputDBhost'] == '' || $_POST['inputDBusername'] == '' ||
        $_POST['inputDBname'] == '' ||
        $_POST['inputSiteurl'] == '' || $_POST['inputAppfolder'] == '' ||
        $_POST['inputSystemfolder'] == '' ||
        ($_POST['inputAppfolder'] == $_POST['inputSystemfolder'])) {
        $error = 1;
    } else {
//echo "conectando";
        @$con = mysql_connect($_POST['inputDBhost'], $_POST['inputDBusername'], $_POST['inputDBpassword']);
        @$db_selected = mysql_select_db($_POST['inputDBname'], $con);

        if (!$con) {
            $error = 1;
        } else if (!$db_selected) {
            $error = 1;
        } else {

           // echo "Guargando configuracion...<br>";

          //  echo "Asignando permisos de escritura<br>";
            chmod("../appication/config/config.php", 0777);
            chmod("../appication/config/database.php", 0777);

           // echo "Permisos database: ". substr(sprintf('%o', fileperms('../appication/config/database.php')), -4);


            // setting site url
            $file_config = "../application/config/config.php";
            $content_config = file_get_contents($file_config);
            $content_config .= "\n\$config['base_url'] = '".$_POST['inputSiteurl']."';";
            file_put_contents($file_config, $content_config);

            // setting database
            $file_db = "../application/config/database.php";
            $content_db = file_get_contents($file_db);
            $content_db .= "\n\$db['default']['hostname'] = '".$_POST['inputDBhost']."';";
            $content_db .= "\n\$db['default']['username'] = '".$_POST['inputDBusername']."';";
            $content_db .= "\n\$db['default']['password'] = '".$_POST['inputDBpassword']."';";
            $content_db .= "\n\$db['default']['database'] = '".$_POST['inputDBname']."';";
            file_put_contents($file_db, $content_db);

            // setting folder name
            $file_index = "../index.php";
            $content_index = str_replace("\$system_path = 'system';", "\$system_path = '".$_POST['inputSystemfolder']."';", file_get_contents($file_index));
            file_put_contents($file_index, $content_index);
            $content_index = str_replace("\$application_folder = 'application';", "\$application_folder = '".$_POST['inputAppfolder']."';", file_get_contents($file_index));
            file_put_contents($file_index, $content_index);

            // rename app folder
            $index = str_replace('install', '', dirname(__FILE__));
            rename($index.'application', $index.$_POST['inputAppfolder']);
            rename($index.'system',      $index.$_POST['inputSystemfolder']);

//echo "archivos de configuracion guardados<br>";

            echo "<script>location.href = '$_POST[inputSiteurl]index.php/install/';</script>";


        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="bootstrap.css"/>
</head>
<body>
<div class="container">
    <div class="row-fluid well" style="margin-top: 50px">
        <h4>Instalacion de sistema de pedidos.</h4>
        <form class="form-horizontal" action="" method="post" style="margin-top:30px;" enctype="multipart/form-data">

            <?php if ($error == 1): ?>
                <div class="alert alert-error" style="font-size:11px;">
                    <b>Opps error ... </b> revisar:
                    <br/> - <i>Los campos no deben estar en blanco</i>

                    <br/> - <i>Debe tener creada su la base de datos</i>
                </div>
            <?php endif; ?>
            <legend>Configuracion de la base de datos</legend>
            <div class="control-group">
                <label class="control-label">DB Host</label>
                <div class="controls">
                    <input type="text" name="inputDBhost" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">DB Nombre (debe estar previamente creada)</label>
                <div class="controls">
                    <input type="text" name="inputDBname" required="required">
                </div>
            </div>
           <!-- <div class="control-group">
                <label class="control-label">Importar datos</label>
                <div class="controls">
                    <input type="checkbox" required="required" onclick="$('#filef').show()">
                </div>
            </div>
            <div class="control-group" id="filef" style="display: none">
                <label class="control-label">Seleccionar archivo SQL</label>
                <div class="controls">
                    <input type="file" name="file">
                </div>
                <div class="alert-info span6">Recuerde cargar las imagenes ubicadas en /uploads de la version anterior al importar datos existentes.</div>


            </div>
-->
            <div class="control-group">
                <label class="control-label">DB Usuario</label>
                <div class="controls">
                    <input type="text" name="inputDBusername" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">DB Password</label>
                <div class="controls">
                    <input type="password" name="inputDBpassword" value="" >
                </div>
            </div>

            <legend><b>1. Configuracion inicial<b></legend>
            <div class="control-group">
                <label class="control-label">URL Aplicacion</label>
                <div class="controls">
                    <input required="required" type="text" name="inputSiteurl" value="<?php echo "http://".$_SERVER['HTTP_HOST'].str_replace('install/step2.php','',$_SERVER['REQUEST_URI']);?>">
                </div>
            </div>

                    <input type="hidden" name="inputAppfolder" value="application">

                    <input type="hidden" name="inputSystemfolder" value="system">



    </div>
    <input type="submit" class="btn btn-info" name="btn-install" value="Siguiente >"/></form>
</div>
</body>
</html>