<?php
    
    //Upload Config Settings
    $allowed_types = Array("text/plain");
    $upload_url = "../uploads";
    $max_size = 100; // kb. 0 = unlimited size.
    
    if( $_FILES["file"] ){ //If a file was sent..

        //Get the uploaded file information
        $file = $_FILES['file'];
        $name_of_file = basename($file['name']);
        $size_of_file = $file["size"] / 1024; //size in KBs
        $type_of_file = $file['type'];
        $file_extension = substr($name_of_file, strrpos($name_of_file, '.') + 1);
        $name = str_replace($file_extension,"",str_replace(".","",$name_of_file));

        //Security Check

        $error = "Error Uploading File: ";

        if( in_array( $type_of_file, $allowed_types ) ){

            if( $size_of_file < $max_size || $max_size == 0 ){

                $save_url = $upload_url."/".$name.time().".".$file_extension;

                if( !file_exists( $save_url ) ){

                    //Save the file to the server
                    if(move_uploaded_file( $file["tmp_name"], $save_url )){

                        echo str_replace("../","",$save_url);
                        return false; // False = success

                    }
                    else{
                        $error .= "Unable to save file.";
                    }

                }
                else{
                    $error .= "File already exists.";
                }

            }
            else{
                $error .= "File is too large.";
            }

        }
        else{
            $error .= "File type not supported.";
        }

    }
    else{
        $error .= "No File Submitted";
    }
    
    echo $error;