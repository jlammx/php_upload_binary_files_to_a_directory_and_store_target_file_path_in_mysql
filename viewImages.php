<?php
    // Include the database configuration file
    include 'include/db_connection.php';
    $flag = false;

    // Get images from the database
    $query = $db->query("SELECT imageName, imageURL FROM tbl_image ORDER BY imageId DESC");

    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            $imageURL = $row["imageURL"];
            // Show only images that contain URLs in the database 
            if($imageURL){
                $flag = true;
                echo '<img src="'.$imageURL.'" alt="'.$row["imageName"].'">';
            }
        }
    } else {
        echo '<p>No image(s) found...</p>';
    } 

    // Show message if there are no images in the database with the correct format
    if(!$flag){
        echo '<p>No image(s) found with URLs...</p>';
    }
?>