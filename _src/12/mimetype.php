<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Gets the MIME type of a file. If specifying an uploaded
 * file the path will be $uploadFile['tmp_name'] and the 
 * default MIME type will be $uploadFile['type'] or similar.
 *
 * @paramm string $pathToFile Full path to file of which to determine MIME type
 * @param string $default Default MIME type
 * @return int
 */
function getFileMIME_Type($pathToFile, $default) {
    if (function_exists('finfo_file')) {
        // use PECL Fileinfo
        $finfo    = finfo_open(FILEINFO_MIME);
        $mimeType = finfo_file($finfo, $pathToFile);
        finfo_close($finfo);
    } elseif (function_exists('mime_content_type')) {
        // use PHP mime_content_type() function
        $mimeType = mime_content_type($pathToFile);
    } else {
        // use the default value
        $mimeType = $default;
    }
    
    return $mimeType;
}
