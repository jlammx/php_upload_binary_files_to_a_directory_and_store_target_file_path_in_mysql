<?php
    // Include the database configuration file
    include 'include/db_connection.php';
    $statusMsg = '';

    // Show the $_FILES Array
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    // Get file count in table
    $select = $db->query("SELECT COUNT(*) FROM tbl_image");
    $row = $select->fetch_assoc();
    $countFiles = $row["COUNT(*)"];
    echo 'Total of registers: '. $countFiles . '<br><br>';

    // Validate the limit of files allowed in the database
    if($countFiles < 15){
        if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){

            // File upload path
            $targetDir = "uploads/";
            // Get file info 
            // basename — Returns trailing name component of path
            $fileName = basename($_FILES["file"]["name"]);
            $fileSize = basename($_FILES["file"]["size"]);
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileError = basename($_FILES["file"]["error"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            if(in_array(strtolower($fileType), $allowTypes)){
                // Upload image to server using move_uploaded_file() function in PHP
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    // Insert image file data into database and save the target file path
                    $insert = $db->query("INSERT into tbl_image (imageName, imageType, imageSize, imageTmpName, imageError, imageURL, upload_on) VALUES('".$fileName."', '".$fileType."', '".$fileSize."', '".$fileTmpName."', '".$fileError."', '".$targetFilePath."', NOW())");
                    // Validates that the data was inserted correctly
                    if($insert){
                        echo '<img src="'.$targetFilePath.'">';
                        $statusMsg = "The file ".$fileName. " has been uploaded and store successfully.";
                    } else {
                        $statusMsg = "File path store failed, please try again.";
                    } 
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload. Data type used: >>>  " .strtoupper($fileType). ".";
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }
    } else {
        $statusMsg = "<div style='text-align: center; padding: 30px 0 10px 0; font-size: 20px; color: #c0392b'>
        The allowed file limit has been reached <br/> Upload operation is restricted for this demo! <br/> Thanks for coming!</div>";
    }

    // Display status message
    echo $statusMsg;

    // Show a link to view the uploaded images
    echo '<br><br><a href="./index.php" title="Return to main page">Return to main page and view the images</a>';
?>