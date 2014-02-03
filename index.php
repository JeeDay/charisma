<?php 
require_once 'config/include.php';
$article_db = new articlesModele();
$flashs = $article_db->getPublished('flash');
$devotionnels = $article_db->getPublished('devotionnel');
$presentation = $article_db->getPublished('presentation');
$render = new articlesRender();
$output = array();
if ($flashs) {
    foreach ($flashs as $flash) {
        $output['flash'] .= $render->getTeaser($flash, FLASH_NEWS);
    }
}
if ($devotionnels) {
    foreach ($devotionnels as $devotionnel) {
        $output['devotionnel'] .= $render->getTeaser($devotionnel, DEVOTIONNEL);
    }
}
$output['presentation'] = $render->getFullArticle(array_pop($presentation));

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Charisma</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/reset.css" media="all">
        <link rel="stylesheet" href="css/text.css" media="all">
        <link rel="stylesheet" href="css/styles.css" media="all">
        
        <script src="js/vendor/jquery-1.10.2.min.js"></script>
        <script src="js/vendor/jquery.slides.min.js"></script>
        <script>
        $(function(){
            $("#slides").slidesjs({
                width: 979,
                height: 348,
                navigation: false,
                play: {
                    active: true,
                    auto: true,
                    interval: 4000,
                    swap: true,
                    pauseOnHover: false,
                    restartDelay: 2500
                } 
            });
        });
        </script>
    </head>
    <body>
        <div class="container">
            <header>
                <div class="header-wrapper">
                    <div class="header">
                        <a href="<?php echo HOME; ?>"> <img src="img/base/header.jpg" alt="" style="width: 1195px;"/></a>
                    </div>
                </div>
            </header>
            <div class="content-wrapper">
                <div class="sidebar-first">
                    <div class="block-menu">
                        <div class="block-menu-title">
                            <h3>CHARISMA EGLISE CHRETIENNE</h3>
                        </div>
                        <div class="block-menu-content">
                            <ul>
                                <li>Au sujet de Charisma</li>
                                <li>La vision</li>
                                <li>Le fondateur</li>
                                <li>Mouvement Evangélique</li>
                                <li>Déclaration de Foi</li>
                                <li>Historique</li>
                            </ul>
                        </div>
                    </div><!-- .block-menu -->
                    <div class="block-menu">
                        <div class="block-menu-title">
                            <h3>ACTIVITES</h3>
                        </div>
                        <div class="block-menu-content">
                            <ul>
                                <li>Les cultes</li>
                                <li>Groupes Familiaux</li>
                                <li>Mouvement des disciples</li>
                                <li>Activités pour les jeunes</li>
                                <li>Eglises des enfants</li>
                                <li>Nos invités</li>
                            </ul>
                        </div>
                    </div><!-- .block-menu -->
                    <div class="block-menu">
                        <div class="block-menu-title">
                            <h3>SERVICES</h3>
                        </div>
                        <div class="block-menu-content">
                            <ul>
                                <li>Visites</li>
                                <li>Opération Bus</li>
                                <li>Conseil pastoral</li>
                            </ul>
                        </div>
                    </div><!-- .block-menu -->
                    <div class="block-menu">
                        <div class="block-menu-title">
                            <h3>MISSIONS</h3>
                        </div>
                        <div class="block-menu-content">
                            <ul>
                                <li>Présentation</li>
                                <li>Région Nord</li>
                                <li>Région Ouest</li>
                                <li>Région Centre</li>
                                <li>Région Est</li>
                                <li>Région Sud</li>
                            </ul>
                        </div>
                    </div><!-- .block-menu -->
                    <div class="block-menu">
                        <div class="block-menu-content">
                            <ul class="liste-email">
                                <li><a href="#" class="img-email"><span>email contact</span></a></li>
                                <li><a href="#" class="img-email"><span>email missions</span></a></li>
                                <li><a href="#" class="img-email"><span>email pasteur</span></a></li>
                                <li><a href="#" class="img-email"><span>email support web</span></a></li>
                            
                            </ul>
                        </div>
                    </div><!-- .block-menu -->
                </div>
                <div class="content">
                    <div class="rows flash-photos">
                        <div id="slides">
                            <img src="img/base/photos-default.jpg" alt=""/>
                            <img src="img/base/photos-default.jpg" alt=""/>
                            <img src="img/base/photos-default.jpg" alt=""/>
                            <img src="img/base/photos-default.jpg" alt=""/>
                            <a href="#" class="slidesjs-previous slidesjs-navigation"></a>
                            <a href="#" class="slidesjs-next slidesjs-navigation"></a>
                            
                        </div> 
                        <div class="slideshow-text">                                                      
                                    <h3><span class="text-gray">charisma </span><span class="text-blue">photos</span></h3>
                                    <p>Charisma église chrétienne, plus qu'un endroit, une expérience! &nbsp;&nbsp;<a href="#">Plus ></a></p>                                                           
                        </div>
                        <img class="ombre" src="img/base/ombre-flash-photos.png" alt=""/>     
                    </div>
                    <div class="rows">
                        <div class="column1">
                            <div class="presentation">
                                <?php echo $output['presentation']; ?>
                            </div>
                            <div class="evenement evenement1">
                                <div class="encart-wrapper"><div class="encart"><span >événements charisma</span></div></div>
                            </div>
                            <div class="evenement evenement2">
                                <div class="encart-wrapper"><div class="encart"><span>événements charisma</span></div></div>
                            </div>
                            <div>
                                <div class="prochainement block-square">
                                    <div class="articles"><div class="content-wrapper"></div></div>
                                    <div class="encart-wrapper">
                                        <div class="content-wrapper"></div>
                                        <div class="encart">
                                            <h3><span>prochainement</span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="devotionnel block-square">
                                        
                                    <div class="articles"><div class="content-wrapper"><?php if($output['devotionnel']) echo $output['devotionnel']; ?></div></div>
                                    <div class="encart-wrapper">
                                        <div class="encart">
                                            <h3><span>dévotionnel</span></h3>
                                        </div>
                                    </div>                                 
                                </div>
                                <div class="cl"></div>
                            </div>
                            <div>
                                <div class="flash block-square">
                                    <div class="articles"><div class="content-wrapper"><?php echo $output['flash']; ?></div></div>
                                    <div class="encart-wrapper">
                                        
                                        <div class="encart">
                                            <h3><span>flash news</span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="enaction block-square">
                                    <div class="articles"><div class="content-wrapper"></div></div>
                                    <div class="encart-wrapper">
                                        <div class="encart"><div class="content-wrapper"></div>
                                            <h3><span>en action</span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="cl"></div>
                            </div>
                            <div>
                                <div class="block-small"></div>
                                <div class="block-small"></div>
                                <div class="block-small"></div>
                            </div>
                        </div><!-- .column1 -->
                        <div class="column2">
                            <div class="cettesemaine block-right">
                                <div class="encart-bleu"><div class="encart-bleu-content"><span><span class="capitalize">cette </span><span class="uppercase">semaine</span></span></div></div>
                                <div class="ombre-block-right"></div>
                            </div>
                            <div class="lescultes block-right">
                                <div class="encart-bleu"><div class="encart-bleu-content"><span><span class="capitalize">les </span><span class="uppercase">cultes</span></span></div></div>
                                <div class="ombre-block-right"></div>
                            </div>
                            <div class="planacces block-right">
                                <div class="encart-bleu"><div class="encart-bleu-content"><span>Plan d'accès</span></div></div>
                                <div class="ombre-block-right"></div>
                            </div>
                            <div class="locaux block-right">
                                <div class="encart-bleu"><div class="encart-bleu-content"><span>Locaux</span></div></div>
                                <div class="ombre-block-right"></div>
                            </div>
                            <div class="caracteres block-right">
                                <div class="encart-bleu"><div class="encart-bleu-content"><span>Caractère</span></div></div>
                                <div class="ombre-block-right"></div>
                            </div>
                            <div class="reunion block-right">
                                <div class="encart-bleu"><div class="encart-bleu-content"><span>Réunions</span></div></div>
                                <div class="ombre-block-right"></div>
                            </div>
                            <div class="radio block-right">
                                <div class="encart-bleu"><div class="encart-bleu-content"><span>Radio MEDIA</span></div></div>
                                <div class="ombre-block-right"></div>
                            </div>
                            <div class="tv block-right">
                                <div class="encart-bleu"><div class="encart-bleu-content"><span>TV</span></div></div>
                                <div class="ombre-block-right"></div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="cl"></div>

            </div><!-- .content-wrapper -->
            <footer>
                <div class="footer">
                    <hr />
                    <h3>Accès direct</h3>
                    <div class="footer-block">
                        
                        <div class="footer-block-item"></div>
                        <div class="footer-block-item"></div>
                        <div class="footer-block-item"></div>
                        <div class="footer-block-item"></div>
                        <div class="footer-block-item"></div>
                        <div class="footer-block-item"></div>
                        <img src="img/base/puce-left.png" class="puce-left" alt="" >
                        <img src="img/base/puce-right.png" class="puce-right" alt="" >
                    </div>
                </div>
                <div class="copyright">
                    Copyright &copy; 2014 Charisma Eglise Chrétienne. Tous droits réservés.
                </div>
            </footer>

        </div><!-- .container -->
        

    </body>
</html>