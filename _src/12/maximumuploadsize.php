<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Gets the maximum size of file uploads 
 * expressed in bytes
 *
 * @return int
 */
function getMaximumUploadSizeInBytes() {
    $uploadSize = trim(ini_get('upload_max_filesize'));
    $last = strtolower($uploadSize[strlen($uploadSize)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $uploadSize *= 1024;
        case 'm':
            $uploadSize *= 1024;
        case 'k':
            $uploadSize *= 1024;
    }

    return $uploadSize;
}

/**
 * Gets the maximum size of file uploads
 * expressed in megabytes
 *
 * @return int
 */
function getMaximumUploadSizeInMegaBytes() {
    $bytes = $this->getMaximumUploadSizeInBytes();
    return $bytes / 1048576;
}
