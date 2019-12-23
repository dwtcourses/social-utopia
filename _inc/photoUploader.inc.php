<?php
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
echo 'upload started | ';
$postImagePath = 'uploads/'; // upload directory

if( isset($_POST['imgData']) ) {
    $imgData = $_POST['imgData'];
    $randomNumber = rand();
    $output_file = $postImagePath . $randomNumber . '.png';
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $imgData );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp ); 
    
    $_SESSION['imgTempUrl'] = APP_URL . $output_file;
    $_SESSION['imgTempName'] = $output_file;
    $_SESSION['imgTempLocalUrl'] = $_SERVER['DOCUMENT_ROOT'] . $output_file;
    //echo $output_file;
    echo 'Upload successfull at ' . $_SESSION['imgTempUrl'];
}