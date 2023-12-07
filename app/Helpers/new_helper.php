<?php

function encode_img_base64($img_path = false, $img_type = 'png') {
    if ($img_path) {
        // Convert image into Binary data
        $img_data = fopen($img_path, 'rb');
        $img_size = filesize($img_path);
        $binary_image = fread($img_data, $img_size);
        fclose($img_data);

        // Build the src string to place inside your img tag
        $img_src = "data:image/" . $img_type . ";base64," . str_replace("\n", "", base64_encode($binary_image));

        return $img_src;
    }

    return false;
}
?>