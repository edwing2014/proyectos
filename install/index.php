<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">

    var flag = 0;

</script>

<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" />
</head>
<body>
<div class="container">
    <div class="row-fluid well" style="margin-top: 50px">
        <h4>Instalacion de sistema de proyectos.</h4>
       <h5> Verificando requsitos del servidor y carpeta.</h5>



        <b class="alert-warning">permisos archivo: </b>

<?php

        $permisos = fileperms('../pdf');

        if (($permisos & 0xC000) == 0xC000) {
            // Socket
            $info = 's';
        } elseif (($permisos & 0xA000) == 0xA000) {
            // Enlace Simbólico
            $info = 'l';
        } elseif (($permisos & 0x8000) == 0x8000) {
            // Regular
            $info = '-';
        } elseif (($permisos & 0x6000) == 0x6000) {
            // Especial Bloque
            $info = 'b';
        } elseif (($permisos & 0x4000) == 0x4000) {
            // Directorio
            $info = 'd';
        } elseif (($permisos & 0x2000) == 0x2000) {
            // Especial Carácter
            $info = 'c';
        } elseif (($permisos & 0x1000) == 0x1000) {
            // Tubería FIFO
            $info = 'p';
        } else {
            // Desconocido
            $info = 'u';
        }

        // Propietario
        $info .= (($permisos & 0x0100) ? 'r' : '-');
        $info .= (($permisos & 0x0080) ? 'w' : '-');
        $info .= (($permisos & 0x0040) ?
            (($permisos & 0x0800) ? 's' : 'x' ) :
            (($permisos & 0x0800) ? 'S' : '-'));

        // Grupo
        $info .= (($permisos & 0x0020) ? 'r' : '-');
        $info .= (($permisos & 0x0010) ? 'w' : '-');
        $info .= (($permisos & 0x0008) ?
            (($permisos & 0x0400) ? 's' : 'x' ) :
            (($permisos & 0x0400) ? 'S' : '-'));

        // Mundo
        $info .= (($permisos & 0x0004) ? 'r' : '-');
        $info .= (($permisos & 0x0002) ? 'w' : '-');
        $info .= (($permisos & 0x0001) ?
            (($permisos & 0x0200) ? 't' : 'x' ) :
            (($permisos & 0x0200) ? 'T' : '-'));

        // echo $info;
        if($info != 'drwxrwxrwx'){

            ?>

            <script>

                flag++;

            </script>

            <div class="label-warning">Poner permisos de escritura lectura y ejecucion (0777) para la carpeta pdf</div>
            <br>
        <?php
        }

    $permisos = fileperms('../uploads');

    if (($permisos & 0xC000) == 0xC000) {
        // Socket
        $info = 's';
    } elseif (($permisos & 0xA000) == 0xA000) {
        // Enlace Simbólico
        $info = 'l';
    } elseif (($permisos & 0x8000) == 0x8000) {
        // Regular
        $info = '-';
    } elseif (($permisos & 0x6000) == 0x6000) {
        // Especial Bloque
        $info = 'b';
    } elseif (($permisos & 0x4000) == 0x4000) {
        // Directorio
        $info = 'd';
    } elseif (($permisos & 0x2000) == 0x2000) {
        // Especial Carácter
        $info = 'c';
    } elseif (($permisos & 0x1000) == 0x1000) {
        // Tubería FIFO
        $info = 'p';
    } else {
        // Desconocido
        $info = 'u';
    }

    // Propietario
    $info .= (($permisos & 0x0100) ? 'r' : '-');
    $info .= (($permisos & 0x0080) ? 'w' : '-');
    $info .= (($permisos & 0x0040) ?
        (($permisos & 0x0800) ? 's' : 'x' ) :
        (($permisos & 0x0800) ? 'S' : '-'));

    // Grupo
    $info .= (($permisos & 0x0020) ? 'r' : '-');
    $info .= (($permisos & 0x0010) ? 'w' : '-');
    $info .= (($permisos & 0x0008) ?
        (($permisos & 0x0400) ? 's' : 'x' ) :
        (($permisos & 0x0400) ? 'S' : '-'));

    // Mundo
    $info .= (($permisos & 0x0004) ? 'r' : '-');
    $info .= (($permisos & 0x0002) ? 'w' : '-');
    $info .= (($permisos & 0x0001) ?
        (($permisos & 0x0200) ? 't' : 'x' ) :
        (($permisos & 0x0200) ? 'T' : '-'));

   // echo $info;
    if($info != 'drwxrwxrwx'){

        ?>

        <script>

           flag++;

        </script>

        <div class="label-warning">Poner permisos de escritura lectura y ejecucion (0777) para la carpeta uploads</div>
<br>
        <?php
    }


        $permisos = fileperms('../application/config');

        if (($permisos & 0xC000) == 0xC000) {
            // Socket
            $info = 's';
        } elseif (($permisos & 0xA000) == 0xA000) {
            // Enlace Simbólico
            $info = 'l';
        } elseif (($permisos & 0x8000) == 0x8000) {
            // Regular
            $info = '-';
        } elseif (($permisos & 0x6000) == 0x6000) {
            // Especial Bloque
            $info = 'b';
        } elseif (($permisos & 0x4000) == 0x4000) {
            // Directorio
            $info = 'd';
        } elseif (($permisos & 0x2000) == 0x2000) {
            // Especial Carácter
            $info = 'c';
        } elseif (($permisos & 0x1000) == 0x1000) {
            // Tubería FIFO
            $info = 'p';
        } else {
            // Desconocido
            $info = 'u';
        }

        // Propietario
        $info .= (($permisos & 0x0100) ? 'r' : '-');
        $info .= (($permisos & 0x0080) ? 'w' : '-');
        $info .= (($permisos & 0x0040) ?
            (($permisos & 0x0800) ? 's' : 'x' ) :
            (($permisos & 0x0800) ? 'S' : '-'));

        // Grupo
        $info .= (($permisos & 0x0020) ? 'r' : '-');
        $info .= (($permisos & 0x0010) ? 'w' : '-');
        $info .= (($permisos & 0x0008) ?
            (($permisos & 0x0400) ? 's' : 'x' ) :
            (($permisos & 0x0400) ? 'S' : '-'));

        // Mundo
        $info .= (($permisos & 0x0004) ? 'r' : '-');
        $info .= (($permisos & 0x0002) ? 'w' : '-');
        $info .= (($permisos & 0x0001) ?
            (($permisos & 0x0200) ? 't' : 'x' ) :
            (($permisos & 0x0200) ? 'T' : '-'));

        // echo $info;
        if($info != 'drwxrwxrwx'){

            ?>

            <script>

                flag++;

            </script>
            <div class="label-warning">Poner permisos de escritura lectura y ejecucion (0777) para la carpeta application/config</div>
            <br>
        <?php
        } ?>

        <b class="alert-warning">Tamaño de archivos a cargar: </b>
        <?php
        $maxUpload      = (int)(ini_get('upload_max_filesize'));
        $maxPost        = (int)(ini_get('post_max_size'));


        if($maxPost < 50){
         ?>

            <div class="label-warning">El tamaño de archivos enviados por POST es menor de 50mb, es de (<?php echo   $maxPost; ?> Mb) cambie esta directiva en el archivo php.ini (post_max_size)</div>
            <br>


           <?php
        }



        if($maxUpload < 50){
            ?>

            <div class="label-warning">El tamaño de archivos enviados a cargar es menor de 50mb, es de (<?php echo   $maxUpload; ?> Mb) cambie esta directiva en el archivo php.ini (upload_max_filesize)</div>
            <br>


        <?php
        }




        ?>

        Su archivo de configuración de php se encuentra en: <?php echo  php_ini_loaded_file(); ?>
    </div>
    <div class="row-fluid"> <button class="btn btn-info" onclick="validatebt()">Siguiente ></button></div>

</div>
</body>
</html>

<script>

    function validate(){

        if( flag == 0){

            location.href= 'step2.php';


    }
    }

    function validatebt(){

        if( flag == 0){

            location.href= 'step2.php';

        }else{
            location.href= 'index.php';

        }
    }


    validate();
</script>