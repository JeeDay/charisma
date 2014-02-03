<?php
require_once 'config/include.php';

$output = array();
$article_db = new articlesModele();
$form = new articlesRender();
if ($_POST) {
    $article = $form->getPost($_POST);
}
$articles = $article_db->findAll('devotionnel', 4);
$previews = $article_db->findPreview('devotionnel');

$output['links'] .= '<ul class="list-group">';
if ($articles) {
    foreach ($articles as $article) {
        $output['links'] .= '<a href="#' . $article->getId() . '"><li class="list-group-item">' . $article->getTitre() . '</li></a>';
        $output['form'] .= '<a name="' . $article->getId() . '"></a><a href="#top">Top</a><div class="panel panel-default"><div class="panel-body">';
        $output['form'] .= $form->form($article);
        $output['form'] .= '</div></div>';
    }
}

if ($previews) {
    foreach ($previews as $preview) {
        $output['devotionnel'] .= $form->getTeaser($preview, DEVOTIONNEL);
    }
}
$output['links'] .= '</ul>';
$output['form'] .= '<div class="panel panel-default"><div class="panel-body">';
$article = new articles();
$article->setEtiquette('devotionnel');
$output['form'] .=$form->form($article);
$output['form'] .= '</div></div>';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Charisma Administration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <a name="top"></a>
        <?php include_once 'block/navbar.php';?>   
        
        <div class="container">
            <div class="flashnews">
                <div id="sidebar" class="col-md-4" role="navigation">
                    <div class="panel panel-primary">
                    
                        <div class="panel-heading">Prévisualisation</div>
                        <div class="panel-body">
                        <div class="flash block-square">
                            <div class="articles"><?php echo $output['devotionnel']; ?></div>
                            <div class="encart-wrapper">
                                <div class="encart">
                                    <h3><span class="text-gray">dévotionnel </span><span class="text-blue">spirituel</span></h3>
                                    <p>Soyez inspiré et cultivez votre relation avec Dieu<a href="#">&nbsp;&nbsp;Plus ></a></p>
                                </div>
                            </div>
                        </div></div>
                    </div>
                    <div class="panel panel-primary article-links">
                        <div class="panel-heading">Dévotionnel</div>
                            <?php echo $output['links']; ?>                    
                    </div>
                     
                </div>
               
                <div class="col-md-8">
                    <?php echo $output['form']; ?>                
                </div>
            </div> <!-- .flashnews -->
            
        </div> <!-- .container -->
        



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: ".tinymce",
                language : 'fr_FR'
            });
        </script>

    </body>
</html>
