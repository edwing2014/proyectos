

<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row-fluid well" style="margin-top: 50px">
        <h4>Configuracion de parametros del sistema.</h4>

        <?php

        echo form_open('install/gconfig');

       echo "Datos del Servidor de correo:<br>";
        $data = array(
            'name'        => 'usuario_mail',
            'id'          => 'usuario_mail',
            'value'       => '',
            'maxlength'   => '100',
            'required'    => 'requered',
            'size'        => '50',
            'style'       => 'width:50%',
        );

        echo "<label>Usuario de correo:</label> ". form_input($data)."<br>";


        $data = array(
            'name'        => 'mail_server',
            'id'          => 'mail_server',
            'value'       => '',
            'maxlength'   => '100',
            'required'    => 'requered',
            'size'        => '50',
            'style'       => 'width:50%',
        );

        echo "<label>URL Servidor de correo:</label> ". form_input($data)."<br>";


        $data = array(
            'name'        => 'clave_mail',
            'id'          => 'clave_mail',
            'value'       => '',
            'maxlength'   => '100',
            'required'    => 'requered',
            'size'        => '50',
            'style'       => 'width:50%',
        );

        echo "<label>Clave Servidor de correo:</label> ". form_input($data)."<br>";


        $data = array(
            'name'        => 'mail_port',
            'id'          => 'mail_port',
            'value'       => '',
            'required'    => 'requered',
            'maxlength'   => '100',
            'size'        => '50',
            'style'       => 'width:50%',
        );

        echo "<label>Puerto Servidor de correo:</label> ". form_input($data)."<br>";


        //echo form_submit('mysubmit', 'Finalizar!');
    echo '</div><input type="submit" value="Finalizar instalación" class="btn btn-info" name="mysubmit">';

        echo form_close();


        ?>



</body>
</html>