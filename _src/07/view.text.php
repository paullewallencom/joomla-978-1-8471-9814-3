<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

/**
 * Text view class
 */
class MycomponentViewMyview extends JView {

    /**
     * Display the view
     * 
     * @param string $tpl template file (not used)
     */
    function display($tpl = null) {
        // get the document
        $document =& JFactory::getDocument();

        // set the MIME type
        $document->setMimeEncoding("text/plain");
        
        // get the item we want to display
        $item =& $this->get("Data");
        
        // force the client to download the response
        JResponse::setHeader("Content-Disposition", "attachment");

        // output the text file
        echo $item->title . "\n\n" . $item->text;
    }
}

?>