<?php
    @include 'constants.php';
    //profile_image

    function storeImageToMediaDir($image_file){
        $file_name = $image_file['name'];
        $file_tmp_name = $image_file['tmp_name'];
        $file_size_kb = $image_file['size'] / 1024 ;

        $file_name_exploded = explode('.', $file_name);
        $file_extension = end($file_name_exploded);

        do{
            $unique_number = time() . rand(1, 99999999);
            $file_new_name = md5($unique_number) . '.' . $file_extension;

            $file_store_path = MEDIA_STORAGE_DIR . '/' . $file_new_name;
        }while(file_exists($file_store_path));

        //create the media storage dir if it doesnt exist
        if(!file_exists(MEDIA_STORAGE_DIR) &&
            !is_dir(MEDIA_STORAGE_DIR)
        ){
            mkdir(MEDIA_STORAGE_DIR, 0777);
        }
        
        if(move_uploaded_file($file_tmp_name, $file_store_path)){
            return $file_store_path;
        }
        return ""; //return empty path if file was not uploaded
    }

    function isProfilePhotoWithinExpectedSize($image_file){
        $file_size_kb = $image_file['size'] / 1024 ;

        if($file_size_kb > PROFILE_IMAGE_ACCEPTED_SIZE_KB){
            return false;
        }
        return true;
    }

?>