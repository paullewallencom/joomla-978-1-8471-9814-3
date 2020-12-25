<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

/**
 * Decodes JSON-RPC POST request data
 *
 * @return mixed request object or false on fail
 */
function getJSON_RPC_Request() {
    // only deals with POST requests
    if (JRequest::getVar("REQUEST_METHOD", null, "SERVER") != "POST") {
        $document->setError(-32600, "Invalid Request.");
        return false;
    }
    
    // get raw POST data and decode
    $rawRequest = file_get_contents("php://input");
    $request    = json_decode($rawRequest);

    // check request was successfully decoded
    if ($request == null) {
        $document->setError(-32700, "Parse Error.");
        return false;
    }

    // check request is an object
    if (!is_object($request)) {
        $document->setError(-32600, "Invalid Request.");
        return false;
    }

    // check the request object is valid
    $vars = get_object_vars($request);
    if (!array_key_exists("method", $vars) ||
        !array_key_exists("jsonrpc", $vars)) {
        $document->setError(-32600, "Invalid Request.");
        return false;
    }

    // set the response ID if an ID was provided
    if (array_key_exists("id", $vars)) {
        $document->setId($request->id);
    }

    // all done!
    return $request;
}
?>