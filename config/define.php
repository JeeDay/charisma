<?php

define ( 'WEBROOT', dirname(dirname ( __FILE__ )) );
define ( 'CSS', WEBROOT.'/css' );
define ( 'CONFIG', WEBROOT.'/config' );
define ( 'DS', DIRECTORY_SEPARATOR );
define ( 'PREFIXE', 'charisma2' );
if (PREFIXE) { define ( 'BASE_URL', "http://" . filter_input(INPUT_SERVER, 'HTTP_HOST'). DS . PREFIXE ); }
else { define ( 'BASE_URL', "http://" . filter_input(INPUT_SERVER, 'HTTP_HOST') ); }



