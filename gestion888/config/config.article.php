<?php


function configArticle($etiquette){
    $config = array();
    switch ($etiquette){
    case 'flash':
        $config['titre'] = "<h3 class='admin-titre' >Flash News</h3>";
        $config['link'] = FLASH_NEWS;
        $config['limit'] = 5;
        $config['articles'] = TRUE;
        $config['block_preview'] = '';
        break;
    case 'devotionnel':
        $config['titre'] = "<h3 class='admin-titre' >Dévotionnel</h3>";
        $config['link'] = DEVOTIONNEL;
        $config['limit'] = 1;
        $config['block_preview'] = '';
        break;
    
    case 'presentation':
        $config['titre'] = "<h3 class='admin-titre' >Présentation</h3>";
        $config['link'] = PRESENTATION;
        $config['limit'] = 1;
        break;
    
    case 'enaction':
        $config['titre'] = "<h3 class='admin-titre' >En Action</h3>";
        $config['link'] = EN_ACTION;
        $config['limit'] = 5;
        $config['articles'] = TRUE;
        $config['block_preview'] = '';
        break;
    }
    
    return $config;
}

