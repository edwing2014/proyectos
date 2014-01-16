<?php
$error = 0;

if (isset($_POST['btn-install'])) {

    // validation
    if ($_POST['inputDBhost'] == '' || $_POST['inputDBusername'] == '' ||
        $_POST['inputDBname'] == '' ||
        $_POST['inputSiteurl'] == '' || $_POST['inputAppfolder'] == '' ||
        $_POST['inputSystemfolder'] == '' ||
        ($_POST['inputAppfolder'] == $_POST['inputSystemfolder'])) {
        $error = 1;
    } else {

        @$con = mysql_connect($_POST['inputDBhost'], $_POST['inputDBusername'], $_POST['inputDBpassword']);
        @$db_selected = mysql_select_db($_POST['inputDBname'], $con);

        if (!$con) {
            $error = 1;
        } else if (!$db_selected) {
            $error = 1;
        } else {
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

            header('location:../');
        }
    }
}

?>