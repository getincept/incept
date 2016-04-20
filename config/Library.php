<?php

//In this file we can set the
//constants for every library
//module

//SANATIZE
define("ALLOWED_HTML_TAGS", "<a><b><blackquote>
                            <code><del><dd><dt><em><h1><h2><h3>
                            <i><img><kbt><li><ol><p><pre><s><sup>
                            <sub><strong><strike><ul><br><hr>");
define("KEEP_HTML_ATTRIBUTES", 'href,target');
define("DISABLE_HTML_ATTR_VALUES", "javascript:,
                                    onclick,
                                    ondblclick,
                                    onmousedown,
                                    onmouseup,
                                    onmouseover,
                                    onmousemove,
                                    onmouseout,
                                    onkeypress,
                                    onkeydown,
                                    onkeyup,
                                    onMouseOver");

?>