<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


    <link type="text/css" rel="stylesheet" href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" />


<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}

.menu{

    width: 360px;
    height: 25px;
    margin-left: 34%;
    margin-top: 25px;
    border: 1px solid #CCC;
    padding: 5px;
}
</style>
</head>
<body>

<div class="menu">
    <a href='<?php echo site_url()?>'>Inicio</a> |

    <a href='<?php echo site_url('proyect/tareas')?>'>Tareas</a> |
    <?php  $usuario = $this->session->userdata('logged_in');


    if($usuario['is_admin'] == '1'){ ?>


        <a href='<?php echo site_url('proyect/proyectos')?>'>Proyectos</a> |

        <a href='<?php echo site_url('proyect/clientes')?>'>Clientes</a> |
        <a href='<?php echo site_url('proyect/empleados')?>'>Empleados</a>|

    <?php } ?>

    <a href='<?php echo site_url('proyect/logout')?>'>Salir</a>|

</div>
	<div style='height:20px;'></div>  
    <div>

        <div class="row-fluid"><div id="dash"></div></div>

        <div class="container">
        <h3>Mis tareas pendientes</h3>
		<?php echo $output; ?>

    </div>

</body>
</html>
