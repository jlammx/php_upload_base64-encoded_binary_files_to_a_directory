# PHP | Upload Base64-encoded binary files to a directory

This repository is an example of upload Base64-encoded binary files to a directory.  

The encoding is designed to make binary data survive transport through transport layers when the channel does not allow binary data  or that are not 8-bit clean, such as mail bodies or NNTP.

- [file_get_contents()](https://www.php.net/manual/en/function.file-get-contents.php) - Reads entire file into a string  
The function uses memory mapping techniques which are supported by the server and thus enhances the performances making it a preferred way of reading contents of a file.
- [base64_encode()](https://www.php.net/manual/en/function.base64-encode.php) - Encodes data with MIME base64  
MIME (Multipurpose Internet Mail Extensions) base64 is used to encode the string in base64.  
The base64_encoded data takes 33% more space then original data.  
This encoding is designed to make binary data survive transport through transport layers that are not 8-bit clean, such as mail bodies.
- [base64_decode()](https://www.php.net/manual/en/function.base64-decode.php) - Decodes data encoded with MIME base64  
Decodes a base64 encoded string. 
- [file_put_contents()](https://www.php.net/manual/en/function.file-put-contents.php) - Write data to a file  
This function is identical to calling fopen(), fwrite() and fclose() successively to write data to a file.  
If filename does not exist, the file is created. Otherwise, the existing file is overwritten, unless the FILE_APPEND flag is set. 


### What is encoding and decoding in a computer?
**Encoding** is the process of putting a sequence of characters (letters, numbers, punctuation, and certain symbols) into a specialized format for efficient transmission or storage.  
**Decoding** is the opposite process -- the conversion of an encoded format back into the original sequence of characters.


### Summary
A encoded file is a file that has been transformed into a different format from the original to facilitate transfer and storage. Some examples of file encoding include Base64, UTF-8, and ASCII. File encoding can make the file easier to handle for users, as encoded files may be easier to read and download in some web browsers. However, file encoding can also increase file size and decrease data transfer efficiency.

Overall, the best way to send a file over the web will depend on the file type, the purpose of the transfer, and user preferences. If data transfer efficiency is a priority, you may want to send a [binary file](https://github.com/jlammx/php_upload_binary_files_to_a_directory). If readability and ease of use are more important, you may want to send an [encoded file](https://github.com/jlammx/php_upload_base64-encoded_binary_files_to_a_directory). In any case, it is important to ensure file transfer is secure and complies with applicable privacy and security policies and requirements. - Chat GPT


### Create HTML form

The form should contain the attributes as **method=’post’** and **enctype=’multipart/form-data’** to support file upload. It helps to bundle the form data and the binary data to post it to the **server-side** PHP file.

```html
<form action="" enctype="multipart/form-data" method="POST" name="frm">
    <input type="file" name="myfile" /> 
    <input type="submit" name="submit" value="Upload"/>
</form>
```


### PHP file upload code
- The **file_get_contents()** function get the image and convert into string.
- The **base64_encode()** function encode the image string data into base64.
- The **base64_decode()** function decode the image string data in base64.
- The **file_put_contents** function moves the file to the directory as an image.
```php
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
```


### Screenshots

> 🔴 Live 
<p align="left">
	<a href=https://youtu.be/b_zf26dJdWQ target="_blank"><img src="https://markdown-videos.deta.dev/youtube/b_zf26dJdWQ" height="250"></a></img>
</p>


### Skills
<p align="left">
	<a href="https://dart.dev" target="_blank">
		<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="PHP" width="40" height="40"/>
	</a> 
</p>

<br/>

<p align="center">
	<div align="center" inline>
		<span> <a href="https://www.linkedin.com/in/jlammx/" target="_blank">
			<img src="https://content.linkedin.com/content/dam/me/business/en-us/amp/brand-site/v2/bg/LI-Logo.svg.original.svg" alt="Jorge Aguirre" height="25"/></a>
		</span>
		&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
</p>

<p align="center"> Last updated at 20 Mar 2023</p>
