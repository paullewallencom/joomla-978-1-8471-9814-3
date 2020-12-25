<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

/**
 * DocumentJSONRPC class, provides an easy interface to display a 
 * JSON RPC response.
 */
class JDocumentJSONRPC extends JDocument {
    
    var $_id = 0;
    
    var $_result = null;
    
    var $_error = null;
    
    /**
     * Class constructor
     *
     * @param array $options Associative array of options
     */
    function __construct($options = array()) {
        // let the parent class do its bit
        parent::__construct($options);
        
        // set the mime type
        $this->setMimeEncoding("application/json");
    }
    
    /**
     * Sets the repsonse ID. This value should always be equal to the incoming
     * request ID.
     *
     * @param  int    $id Response ID
     * @access public
     */
    function setId($id) {
        $this->_id = intval($id);
    }
    
    /**
     * Sets the result of the procedure call.
     *
     * @param  mixed  $result Procedure call result
     * @access public
     */
    function setResult($result) {
        // flush the error, we don't need it any more
        $this->_error  = null;
        
        // define the result
        $this->_result = $result;
    }
    
    /**
     * Sets the error
     *
     * @param  int    $code    Error code
     * @param  string $message Error message
     * @access public
     */
    function setError($code, $message) {
        // flush the result, we don't need it any more
        $this->_result = null;
        
        // define the error object
        $this->_error = new stdClass();
        $this->_error->code = intval($code);
        $this->_error->message = (string)$message;
    }

    function render($cache = false, $params = array()) {
        // create the response object
        $response          = new stdClass();
        $response->jsonrpc = "2.0";
        $response->id      = $this->_id;
        
        // set the error or result, these are 
        if (is_object($this->_error)) {
            $response->error = $this->_error;
        } else {
            $response->result = $this->_result;
        }
        
        // let the parent do it's stuff
        parent::render($cache, $params);
        
        // return the JSON-RPC response
        return json_encode($response);
    }
    
}

?>