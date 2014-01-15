<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyect extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
        $this->load->library('session');



	}

	public function _example_output($output = null)
	{



		$this->load->view('example.php',$output);
	}



	public function index()
	{


//verificar si esta logueado
        if(!$this->esta_logueado()){

            redirect(site_url('proyect/login'));

        }else{





        try{

        //crear crud
            $crud = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('tareas');




            $crud->unset_operations();

            $crud->columns('nombre','proyecto','empleado','fecha_inicio','fecha_fin','prioridad','estado');

            $crud->set_subject('Mis tareas pendientes');


            $usuario = $this->session->userdata('logged_in');
             $crud->where('empleado',$usuario['id']);

            $crud->where('fecha_fin', date('Y/m/d') );
            $crud->where('estado != ', '2' );


            $crud->order_by('prioridad','desc');

            $crud->callback_after_insert(array($this, 'notificar1'));
            $crud->callback_after_update(array($this, 'notificar2'));

            $crud->set_relation('proyecto','proyectos','Nombre');
            $crud->set_relation('empleado','empleados','Nombres');

            $crud->field_type('estado','dropdown',
                array('1' => 'Activa', '2' => 'Terminanda','3' => 'retrasada'));

            $crud->field_type('prioridad','dropdown',
                array('1' => 'Vida o Muerte', '2' => 'Alto','3' => 'Medio' , '4' => 'Bajo'));


            //buscar tareas no terminadas el dia de ayer para auto agendarlas
            $fecha_actual = date('Y/m/d');
            $ayer = strtotime ( '-1 day' , strtotime ( $fecha_actual ) ) ;
            $ayer = date ( 'Y/m/d' , $ayer );

            $tareas_retrazadas = $this->db->query("select id from tareas where fecha_fin = '$ayer' and estado <> '2'")->result();

            $ids = array();
            //hay tareas retrazadas?
            if($tareas_retrazadas > 0){


                //actualizar fecha final y colocar estado en atrazada
                foreach($tareas_retrazadas as $tarea){

                    $id = $tarea->id;

                    $this->db->query("update tareas set estado = '3' and fecha_fin = '$fecha_actual' where (id = '$id')");


                }





            }



            $output = $crud->render();

            $this->load->view('dashboard.php',$output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }

    }

	}


    function proyectos(){
        if(!$this->esta_logueado()){

            redirect(site_url('proyect/login'));

        }
        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('proyectos');
            $crud->set_subject('Proyectos');
            $crud->required_fields('Nombre');
            $crud->columns('id','nombre','a_cargo','fecha_inicio','fecha_fin','tareas_pendientes');

            $crud->callback_column('tareas_pendientes',array($this,'tareas_pendientes1'));

            $crud->add_action('Ver tareas', '', '','ui-icon-image',array($this,'link_tareas'));

            $crud->set_relation('cliente','clientes','Nombres');
            $crud->set_relation('a_cargo','empleados','Nombres');

            $output = $crud->render();

            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    function link_tareas($primary_key , $row)
    {
        return site_url('proyect/tareas/'.$row->id);
    }

     function tareas_pendientes1($value, $row){


        $idp = $row->id;

        $result = $this->db->query("select count(id) as total from tareas where proyecto = '$idp'")->row();

         $pendientes = $this->db->query("select count(id) as total from tareas where proyecto = '$idp' and estado <> '2'")->row();


        return "<b style='color:red'>".$pendientes->total .'</b>/<b>'.$result->total."</b>";

    }

    function empleados(){

        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('empleados');
            $crud->set_subject('Empleados');
            $crud->required_fields('nombres','apellidos','identificacion','cargo','email','clave','usuario');
            $crud->columns('nombres','apellidos','cargo','identificacion','usuario');

            $crud->callback_before_insert(array($this,'encrypt_password_callback'));
            $crud->callback_before_update(array($this,'encrypt_password_callback'));
            $crud->callback_edit_field('clave',array($this,'decrypt_password_callback'));

            $crud->field_type('is_admin', 'true_false');

            $output = $crud->render();

            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    function clientes(){
        if(!$this->esta_logueado()){

            redirect(site_url('proyect/login'));

        }
        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('clientes');
            $crud->set_subject('Clientes');
            $crud->required_fields('nombres','apellidos','identificacion','email');
            $crud->columns('nombres','apellidos','identificacion','email');



            $output = $crud->render();

            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    function tareas($proyectof=null){

        if(!$this->esta_logueado()){

            redirect(site_url('proyect/login'));

        }


        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('tareas');


            $crud->required_fields('nombre','proyecto','empleado','fecha_inicio','fecha_fin','prioridad','estado');
            $crud->columns('nombre','proyecto','empleado','fecha_inicio','fecha_fin','prioridad','estado');



        if($proyectof != null){

          //  $crud->set_subject('Tareas del Proyecto: '.$proyectof);
         //   $crud->where('proyecto', $proyectof);

        }else{

            $crud->set_subject('Tareas');
        }


            $crud->callback_after_insert(array($this, 'notificar1'));
            $crud->callback_after_update(array($this, 'notificar2'));

             $crud->set_relation('proyecto','proyectos','Nombre');
             $crud->set_relation('empleado','empleados','Nombres');

            $crud->field_type('estado','dropdown',
                array('1' => 'Activa', '2' => 'Terminanda','3' => 'retrasada'));

            $crud->field_type('prioridad','dropdown',
                array('1' => 'Vida o Muerte', '2' => 'Alto','3' => 'Medio' , '4' => 'Bajo'));

            $usuario = $this->session->userdata('logged_in');
            $crud->where('empleado',$usuario['id']);

            if($usuario['is_admin'] != '1'){
                $crud->unset_edit();
                $crud->unset_add();
                $crud->unset_delete();
            }


            //terminar tareas boton
            $crud->add_action('Terminar Tarea', '', '','ui-icon-image',array($this,'set_terminada'));
            //marcar las terminadas

           // $crud->callback_column('tareas_pendientes',array($this,'tareas_pendientes1'));

            $output = $crud->render();

            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    //funcion para terminar la tarea
    function set_terminada($key,$row){

        return 'javascript:terminar_tarea(\''.$row->id.'\')';

    }


    function notificar1($post_array,$primary_key){
        $this->load->model(Config_model);
        $fila = $this->Config_model->get_config_data();



        $empleado = $this->db->query("select * from empleados where id = '".$post_array['empleado']."'");


        $config['smtp_host'] = $fila['mail_server'];
        $config['smtp_user'] = $fila['usuario_mail'];
        $config['smtp_pass'] = $fila['clave_mail'];
        $config['smtp_port'] = $fila['mail_port'];
        $config['protocol'] = 'smtp';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE;

        $this->load->library('email',$config);

        $this->email->from($config->usuario_mail);
        $this->email->to($empleado['email']);

        $this->email->subject('Se le ha asignado una nueva tarea en el sistema de proyectos');
        $this->email->message('Se le ha asignado una nueva tarea en el sistema de proyectos, nombre de la tarea :\n '.$post_array['nombre']);

        $this->email->send();


}

    function notificar2($post_array,$primary_key){
        $this->load->model(Config_model);
        $fila = $this->Config_model->get_config_data();

        $empleado = $this->db->query("select * from empleados where id = '".$post_array['empleado']."'");


        $config['smtp_host'] = $fila['mail_server'];
        $config['smtp_user'] = $fila['usuario_mail'];
        $config['smtp_pass'] = $fila['clave_mail'];
        $config['smtp_port'] = $fila['mail_port'];
        $config['protocol'] = 'smtp';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE;

        $this->load->library('email',$config);

        $this->email->from($config->usuario_mail);
        $this->email->to($empleado['email']);

        $this->email->subject('Se le ha actualizado una nueva tarea en el sistema de proyectos');
        $this->email->message('Se le ha actualizado una nueva tarea en el sistema de proyectos, nombre de la tarea :\n '.$post_array['nombre']);

        $this->email->send();


    }

    function encrypt_password_callback($post_array, $primary_key = null)
    {
        $this->load->library('encrypt');

        $key = 'SMkey%20i3';
        $post_array['clave'] = $this->rc4($key,$post_array['clave']);
        return $post_array;
    }

    function decrypt_password_callback($value)
    {
        $this->load->library('encrypt');

        $key = 'SMkey%20i3';
        $decrypted_password =  $this->rc4_decrypt($key,$value);
        return "<input type='password' name='clave' value='*****' />";
    }

    function login(){

        $this->load->helper(array('form'));
echo '<meta charset="UTF-8"> <link type="text/css" rel="stylesheet" href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" />';

        echo '<div class="container" align="center" style="margin-top:15%">';
        echo "<h1>Gestión de proyectos:</h><br>";

        echo "<h3>Acceso al sistema:</h3><br>";
        echo validation_errors()."<br>";

        echo form_open('proyect/login_validate');


        $data = array(
            'name'        => 'usuario',
            'id'          => 'usuario',
            'value'       => '',
            'maxlength'   => '100',
            'size'        => '50',
            'type'         => 'text',
            'style'       => 'width:20%',
            'required'     => 'required'
        );

        echo '<label>Usuario: <label>'.form_input($data)."<br>";

        $data = array(
            'name'        => 'clave',
            'id'          => 'clave',
            'value'       => '',
            'type'         => 'password',
            'maxlength'   => '100',
            'size'        => '50',
            'style'       => 'width:20%',
            'required'     => 'required'
        );

        echo '<label>Clave:  <label>'.form_input($data)."<br>";

        echo '<button type="submit" class="btn btn-success">Ingresar</button>';


        echo form_close();

        echo "</div>";

    }

    function login_validate(){


        $this->load->library('encrypt');

        $key = 'SMkey%20i3';
        $this->load->helper(array('form'));

        $encrypted_password = $this->rc4($key, $this->input->post('clave'));




        $this -> db -> select('id, usuario, clave,nombres,apellidos,is_admin');
            $this -> db -> from('empleados');
            $this -> db -> where('usuario', $this->input->post('usuario'));
            $this -> db -> where('clave', $encrypted_password);


            $query = $this -> db -> get();
        $rowq = $query->row();

       // print_r($rowq);

            if($query -> num_rows() == 1)
            {

                $sess_array = array('id' => $rowq->id,'nombres' => $rowq->nombres ,'appellidos' => $rowq->apellidos,'is_admin' => $rowq->is_admin);



                $this->session->set_userdata('logged_in', $sess_array);

               // return $query->result();

                redirect(site_url('proyect'));

            }
            else
            {
                redirect(site_url('proyect/login'));
            }
        }


        function esta_logueado(){

            if($this->session->userdata('logged_in')){

                return true;

            }else{
                return false;
            }


        }


    /**
     * Crypt/decrypt strings with RC4 stream cypher algorithm.
     *
     * @param string $key Key
     * @param string $data Encripted/pure data
     * @see   http://pt.wikipedia.org/wiki/RC4
     * @return string
     */
    function rc4($key, $data)
    {
       // $key = "this is a secret key";
        $input = $data;

        $encrypted_data = mcrypt_ecb (MCRYPT_3DES, $key, $input, MCRYPT_ENCRYPT);

        return $encrypted_data;
    }

    function rc4_decrypt($key,$data){

        $temp = mcrypt_ecb(MCRYPT_3DES, $key, $data, MCRYPT_DECRYPT);
        return rtrim($temp, "\0");

    }


    function logout(){

      $this->session->unset_userdata('logged_in');
        redirect('proyect/login');

    }

    function terminar_tarea($id = false){

    if($id){
        $this->db->query("update tareas set estado = '2' where id = '$id'");
        echo "success";

    }else{

        echo "failure";
    }


    }
}