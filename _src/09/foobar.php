<?php
/**
 * Foobar search plugin
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Foobar search plugin class
 */
class plgSearchFoobar extends JPlugin {

    /**
     * @return array An array of search areas
     */
    function &onSearchAreas()
    {
        static $areas = array(
            'content' => 'Articles',
            'foobar'  => 'Foobars'
        );
        return $areas;
    }

    /**
     * Foobar Search method. Gets an array of objects, each
     * of which contains the instance variables title, text,
     * href, section, created, and browsernav
     *
     * @param string $text Search string
     * @param string $phrase Matching option, exact|any|all
     * @param string $ordering what to order by, newest|oldest|popular|alpha|category
     * @param array $areas Areas in which to search, null if search all
     * @return array Objects representing foobars
     */
    function onSearch($text, $phrase="", $ordering="", $areas=null) {
        // check we can handle the requested search
        if (is_array($areas) && !in_array("foobar", $areas)) {
            // not one of our areas... leave it alone!
            return array();
        }

        // get the things we will need
        $db   =& JFactory::getDBO();

        // build SQL conditions WHERE clause
        $conditions = "";
        switch ($phrase) {
            case "exact":
                // build an exact match LIKE condition
                $text = $db->Quote("%".$db->getEscaped($text, true)."%", false);
                $conditions = $db->nameQuote("foobar")." LIKE ".$text;
                break;
            case "all":
            case "any":
            default:
                // prepare the words individually
                $wordsConditions = array();
                foreach (preg_split("~\s+~", $text) as $word) {
                    $word = $db->Quote( "%".$db->getEscaped( $word, true )."%", false );
                    $wordsConditions[] = $db->nameQuote("foobar")." LIKE ".$word;
                }
                // determine the glue and put it all together!
                $glue = ($phrase == "all") ? ") AND (" : ") OR (";
                $conditions = "(".implode($glue, $wordsConditions).")";
                break;
        }

        // determine ordering
        switch ($ordering) {
            case 'popular':
                $order = 'hits DESC';
                break;
            case 'alpha':
            case 'category':
                $order = 'foobar ASC';
                break;
            case 'oldest':
                $order = 'created ASC';
                break;
            case 'newest':
            default:
                $order = 'created DESC';
                break;
        }

        // complete the query
        $query = 'SELECT foobar AS title, foobar AS text, created,'
        . ' "Foobars" AS section, "2" AS browsernav, '
        . ' CONCAT("index.php?option=com_foobar&id=", id) AS href'
        . ' FROM ' . $db->nameQuote('#__foobar')
        . ' WHERE ( '.$conditions.' )'
        . ' ORDER BY '. $order;
        $db->setQuery($query);
        $rows = $db->loadObjectList();

        return $rows;
    }

}
