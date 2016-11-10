<?php
/**
 * Created by PhpStorm.
 * User: nicholai
 * Date: 11/9/16
 * Time: 4:51 PM
 */

try {

    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['file']['error']) ||
        is_array($_FILES['file']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['file']['error'] value.
    switch ($_FILES['file']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES['file']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['file']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
            $finfo->file($_FILES['file']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )
    ) {
        throw new RuntimeException('Invalid file format.');
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['file']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    $hashOfFile = sha1_file($_FILES['file']['tmp_name']);
    if (!move_uploaded_file(
        $_FILES['file']['tmp_name'],
        sprintf('/var/www/emotion/in/%s.%s',
            $hashOfFile,
            $ext
        )
    )
    ) {
        throw new RuntimeException('Failed to move uploaded file.');
    }
    $startTime = time(true);
    $fn = sprintf('/var/www/emotion/in/%s', $hashOfFile);
    echo '{';
    $filenum = 0;
    while (time(true) - $startTime < 5){
        $files = glob($fn . '*.out');
        foreach ($files as $val){
            if($filenum> 0) echo ',';
            echo '"' . $filenum . '":';
            echo file_get_contents($val);
            $filenum++;
        }
        if ($filenum > 0){
            echo '}';
            return;
        }
        usleep(10000);
    }
    echo '}';

} catch (RuntimeException $e) {

    echo $e->getMessage();

}
