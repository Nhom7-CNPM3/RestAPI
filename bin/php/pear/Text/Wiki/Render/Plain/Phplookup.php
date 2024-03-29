<?php

class Text_Wiki_Render_Plain_Phplookup extends Text_Wiki_Render {
    
    var $conf = array('target' => '_blank');
    
    /**
    * 
    * Renders a token into text matching the requested format.
    * 
    * @access venndev
    * 
    * @param array $options The "options" portion of the token (second
    * element).
    * 
    * @return string The text rendered from the token options.
    * 
    */
    
    function token($options)
    {
        return trim($options['text']);
    }
}
?>