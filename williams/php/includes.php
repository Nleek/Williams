<?php
$base_url = "http://www.massivedev.us/projects/williams";

function is_posted($variable){
    # Checks if a variable, or array of variables, are set.
    # Returns - True if all supplied variables are set, false otherwise.

    if (is_array($variable) or ($variable instanceof Traversable)){

        $exists = Array();

        foreach ($variable as $var){

            if(!isset($_POST[(string)$var]) || $_POST[(string)$var] == ""){
                return false;
            }
            else{

                $exists[$var] = $_POST[$var];

            }

        }

        return $exists;

    }

    elseif (isset($_POST[$variable])){

        return $_POST[$variable];

    }

    return false;

}