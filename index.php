<?php
    $targetDir = "uploads/";
    // Check if it is an array and if it has data
    if(is_array($_FILES) && !empty($_FILES["myfile"]["name"])) {
        // Get the file path 
        $path = $_FILES['myfile']['tmp_name'];
        // Get the file name
        $name = $_FILES['myfile']['name'];
        // Get the file type
        $type = pathinfo($path, PATHINFO_EXTENSION);
        // Get the image and convert into string, this string can be use in file_put_contents() like a parameter and works
        $imgData = file_get_contents($path);
        // Encode the image string data into base64
        $imgEncoded = base64_encode($imgData);
        // Display the output
        // echo $data;
        // Format the image SRC in base64:  data:{mime};base64,{data};
        $srcBase64 = 'data:image/' . $type . ';base64,' . $imgEncoded;
        // Validates that the uploaded file is not empty and is posted via the HTTP_POST method
        if(is_uploaded_file($path)) {
            // Decode the image string data in base64
            $decodedImage = base64_decode($imgEncoded);
            // Pass the parameters, the destination for moved file and the decoded file
            $return = file_put_contents($targetDir.$name, $decodedImage);
            if($return !== false){
                echo "File uploaded successfully!";
                // Show a sample image in base64
                echo '<img src="'.$srcBase64.'">';
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Please select a file to upload.";
    }
?>

<form action="" enctype="multipart/form-data" method="POST" name="frm_user_file">
    <input type="file" name="myfile" /> 
    <input type="submit" name="submit" value="Upload" />
</form>