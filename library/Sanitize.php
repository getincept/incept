<?php

/*
 *2nd part ($keep till foreach) from http://forums.phpfreaks.com/topic/202173-remove-specific-tag-attributes-from-html/
 * author foxsoup
 *3rd part ($notallowed) from https://wordpress.org/support/topic/how-can-i-remove-html-attributes-in-php
 *author omgwtf
 */

class Sanitize
{

    public static function sanitizeInput($inputString)
    {

        $allowedTags = ALLOWED_HTML_TAGS;
        $keepHTMLAttr = explode(",",KEEP_HTML_ATTRIBUTES);
        $disabledHTMLAttrValues = explode(",",DISABLE_HTML_ATTR_VALUES);

        $data = strip_tags($inputString,$allowedTags);

        // Get an array of all the attributes and their values in the data string
        preg_match_all('/[a-z]+=".+"/iU', $data, $attributes);

        // Loop through the attribute pairs, match them against the keep array and remove
        // them from $data if they don't exist in the array
        foreach ($attributes[0] as $attribute) {
            $attributeName = stristr($attribute, '=', true);
            if (!in_array($attributeName, $keepHTMLAttr)) {
                $data = str_replace(' ' . $attribute, '', $data);
            }
        }
        $data = str_replace($disabledHTMLAttrValues, "", "$data");

        return $data;
    }

}


?>