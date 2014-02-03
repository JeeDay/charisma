<?php
require_once 'config/include.php';
$etiquette = filter_input(INPUT_GET, 'etiquette');
$config = configArticle($etiquette);

$article_db = new articlesModele();
$form = new articlesRender();

$id = filter_input(INPUT_GET, 'id');
if($id){$article = $article_db->find($id);}
else {
    $article = new articles();
    $article->setEtiquette($etiquette);
}

if ($_POST) {
     $retour = $form->getPost($_POST);
     if($retour['redirection']){
        header($retour['redirection']);
        exit();
     }    
}
$php_self = filter_input(INPUT_SERVER, 'REQUEST_URI');
$output['form'] .= $form->form($article);

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
                
                <div class="col-md-12">
                    <div class="alert alert-info"><?php echo $config['titre']; ?></div>
                    <ul class="nav nav-tabs">
                        <li ><a href="<?php echo "multipleform.php?etiquette=$etiquette"?>">Espace de travail</a></li>                  
                        <li><a href="<?php echo "tableau.php?etiquette=$etiquette"?>">Archives</a></li>
                        <li class="active"><a href="<?php echo "formulaire.php?etiquette=$etiquette"?>">Modification</a></li>
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
        <script type="text/javascript">
            tinymce.init({
                selector: ".tinymce",
                language : 'fr_FR'
            });
        </script>

    </body>
</html>
