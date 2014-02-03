<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once 'config/include.php';
$etiquette = filter_input(INPUT_GET, 'etiquette');
$config = configArticle($etiquette);

$output = array();
$output['links'] ='';
$output['form'] ='';
$output['preview'] ='';
$article_db = new articlesModele();
$form = new articlesRender();

if ($_POST) {
    $post = $form->getPost($_POST);
    if(isset($post['redirection'])) { header( $post['redirection']);}
}
$articles = $article_db->findWorkInProgress($etiquette, $config['limit']);

$previews = $article_db->findPreview($etiquette);

$output['links'] .= '<ul class="list-group">';

for ($i = 0; $i < $config['limit']; $i++) {    
    $output['links'] .= '<a href="#' . ($i +1 ) . '"><li class="list-group-item">Article '.($i +1 ).'</li></a>';
    $output['form'] .= '<a name="' . ($i +1 ) . '"></a><a href="#top">Top</a><div class="panel panel-default"><div class="panel-body">';
    if (isset($articles[$i])){ $output['form'] .= $form->form($articles[$i]);}
    else {
        $newArticle = new articles();
        $newArticle->setEtiquette($etiquette);
        $output['form'] .= $form->form($newArticle);     
    }
    $output['form'] .= '</div></div>';
}
 
if (isset($previews)) {
    foreach ($previews as $preview) {
        $output['preview'] .= $form->getTeaser($preview , $config['link']);
    }
}
$output['links'] .= '</ul>';

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
                 <div class="alert alert-info"><?php echo $config['titre']; ?></div>
                <div id="sidebar" class="col-md-4" role="navigation">
                    
                    <?php if(isset($config['articles'])): ?>
                        <div class="panel panel-primary article-links">
                            <div class="panel-heading"><?php echo $config['titre']?></div>
                            <?php echo $output['links']; ?>                    
                        </div>
                    <?php endif; ?>
                     
                </div>
               
                <div class="col-md-8">                  
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="<?php echo "multipleform.php?etiquette=$etiquette"?>">Espace de travail</a></li>                                        
                        <li><a href="<?php echo "tableau.php?etiquette=$etiquette"?>">Archives</a></li>
                       
                    </ul>
                    <?php echo $output['form']; ?>                
                </div>
            </div> <!-- .flashnews -->
            
        </div> <!-- .container -->
        



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/tinymce/tinymce.min.js"></script>
        <script src="js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            
            tinymce.init({
                selector: ".tinymce",
                language : 'fr_FR'
            });
            //var editor = CKEDITOR.replace( '.tinymce' );
        </script>

    </body>
</html>
