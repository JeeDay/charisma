<?php
require_once 'config/include.php';
$limit = 30;

$etiquette = filter_input(INPUT_GET, 'etiquette');
$config = configArticle($etiquette);

$page = (filter_input(INPUT_GET, 'page'))? filter_input(INPUT_GET, 'page') * $limit : 0;
$output = array();
$db = new articlesModele();
$render = new articlesRender();
$articles = $db->findArchive($etiquette);

$number = floor(count($articles)/$limit);
if($articles){$output['list'] = $render->getList($articles);}
else {$output['list']="";}
if ($number) {
    $output['pagination'] = '<ul class="pagination" >';
    $url = filter_input(INPUT_SERVER, 'PHP_SELF');
    $url .= "?";
    $url .= ($etiquette) ? "etiquette=" . $etiquette : '';
    for ($i = 0; $i <= $number; $i++) {
        $page = ($i) ? "&page=" . $i : '';
        $output['pagination'] .= "<li><a href='$url$page'>" . ($i + 1) . '</a></li>';
    }
    $output['pagination'] .= '</ul>';
}
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
                        <li class="active"><a href="<?php echo "tableau.php?etiquette=$etiquette"?>">Archives</a></li>
                    </ul> 
                    <?php
                    if($output['list']){
                     echo $output['list']; 
                     echo $output['pagination'];
                    }else 
                    ?>
                    
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
