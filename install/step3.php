
<script src="<?php echo base_url();?>plantillas/js/jquery.min.js">
</script>
<script src="<?php echo base_url();?>plantillas/js/bootstrap.js">
</script>
<link href="<?php echo base_url();?>plantillas/icomoon/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>plantillas/css/main.css" rel="stylesheet">
<link href="<?php echo base_url();?>plantillas/css/bootstrap.css" rel="stylesheet">


<!DOCTYPE html>
<html>
<head>

</head>
<body>
<div class="container">
    <div class="row-fluid well" style="margin-top: 50px">
        <h4>Configuracion de parametros del sistema.</h4>

        <?php

        echo form_open('install/gconfig');

        $data = array(
            'name'        => 'razon_social',
            'id'          => 'razon_social',
            'value'       => '',
            'required'    => 'requered',
            'maxlength'   => '100',
            'size'        => '50',
            'style'       => 'width:50%',
        );

        echo "<label>Empresa:</label> ". form_input($data)."<br>";





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

        $data = array(
            'name'        => 'location_sugar',
            'id'          => 'location_sugar',
            'value'       => 'http://su-ip-o-domonio/crm/service/v4/rest.php',
            'maxlength'   => '100',
            'required'    => 'requered',
            'size'        => '50',
            'style'       => 'width:50%',
        );

        echo "<label>Url de sugarcrm: Ej: (http://su-ip-o-domonio/crm/service/v4/rest.php)</label> ". form_input($data).' '.$error."<br>";


        $data = array(
            'name'        => 'trm',
            'id'          => 'trm',
            'value'       => '',
            'required'    => 'requered',
            'maxlength'   => '100',
            'size'        => '50',
            'style'       => 'width:50%',
        );

        echo "<label>Tasa representativa del dolar actual: </label> ". form_input($data)."<br>";

        //echo form_submit('mysubmit', 'Finalizar!');
    echo '</div><input type="submit" value="Finalizar instalación" class="btn btn-info" name="mysubmit">';

        echo form_close();


        ?>



</body>
</html>