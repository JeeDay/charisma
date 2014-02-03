<?php 
    
    require_once 'config/include.php';
    $id = filter_input(INPUT_GET, 'article');
    $article_db =  new articlesModele();
    $article = $article_db->find($id);
    $render =  new articlesRender();
    $output = array();
    $output['article'] .= $render->getFullArticle($article);
    
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
                        <a href="<?php echo HOME; ?>"><img src="img/base/header.jpg" alt=""/></a>
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
                    <?php echo $output['article']; ?>
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