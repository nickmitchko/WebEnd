<?php
/**
 * Created by PhpStorm.
 * User: nicholai
 * Date: 11/11/16
 * Time: 5:07 PM
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

    if (!isset($_POST['emotion']) ||
        is_array($_POST['emotion'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    $emotion = substr($_POST['emotion'], 0 , 10);

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
        sprintf('/mnt/411B93F1016452A9/Training/%s.%s',
            $hashOfFile,
            $emotion
        )
    )
    ) {
        throw new RuntimeException('Failed to move uploaded file.');
    }
    echo $_POST['emotion'];
} catch (RuntimeException $e) {

    echo $e->getMessage();

}