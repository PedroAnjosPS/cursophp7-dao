<?php
    spl_autoload_register(function($nomeClasse){
        $fileName = "class" . DIRECTORY_SEPARATOR . $nomeClasse . ".php";
        
        if(file_exists($fileName)){
            require_once($fileName);
        }
    });
?>