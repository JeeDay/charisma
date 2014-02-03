<?php
define ('HOME' , BASE_URL);

define('FLASH_NEWS', BASE_URL.'/flashnews.php?article=%d');
define('DEVOTIONNEL', BASE_URL.'/devotionnel.php?article=%d');
define('EN_ACTION', BASE_URL.'/en-action.php?article=%d');
define('PRESENTATION',BASE_URL.'/presentation.php?article=%d');

define ('ADMIN_HOME' , BASE_URL.'/gestion888');
define ('ADMIN_FLASH' , BASE_URL.'/gestion888/multipleform.php?etiquette=flash');
define('ADMIN_DEVOTIONNEL', BASE_URL.'/gestion888/multipleform.php?etiquette=devotionnel');
define('ADMIN_PRESENTATION', BASE_URL.'/gestion888/multipleform.php?etiquette=presentation');
define('ADMIN_ENACTION', BASE_URL.'/gestion888/multipleform.php?etiquette=enaction');

define('ARTICLE_PREVIEW', ADMIN_HOME.'/previsualisation.php?etiquette=%s&id=%d');