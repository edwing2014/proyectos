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

    <div class="container">
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
<script type="text/javascript">

    function terminar_tarea(id){

        $.ajax({
            type: "post",
            url: '<?php echo site_url()?>/proyect/terminar_tarea/'+id,
            success: function(datos){
               // $('#nroItems').html('('+datos+')');

                alert("Tarea Terminada.")

                location.reload();

            }});


    }





</script>