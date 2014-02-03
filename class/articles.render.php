<?php

class articlesRender {

public function form(articles $article = NULL){
    if (is_null($article)) { $article = new articles();}
    $php_self = filter_input(INPUT_SERVER, 'REQUEST_URI');
    $date = new DateTime();
    $id = $article->getId();
    $titre = $article->getTitre();
    $resume = $article->getResume();
    $contenu = $article->getContenu();
    $etiquette = $article->getEtiquette();
    $archive = ($article->getArchive()) ? '&nbsp;&nbsp;<span class="label label-info">Archivé</span>' : NULL;
    $previsualisation = ($article->getPrevisualisation()) ? '&nbsp;&nbsp;<span class="label label-info">Prévisualisé</span>' : NULL;
    $publication = ($article->getPublication()) ? '&nbsp;&nbsp;<span class="label label-info">Publié</span>' : NULL;
    $btn_archivage = ($article->getArchive()) ?'<button type = "submit" class = "btn btn-warning" name="action" value="archiver" >Désarchiver</button>':'<button type = "submit" class = "btn btn-primary" name="action" value="archiver" >Archiver</button>';    
    $btn_publication = ($article->getPublication()) ?'<button type = "submit" class = "btn btn-warning" name="action" value="publier" >Dépublier</button>':'<button type = "submit" class = "btn btn-primary" name="action" value="publier" >Publier</button>';
    $btn_previsualisation = ($article->getPrevisualisation()) ?'<button type = "submit" class = "btn btn-warning" name="action" value="previsualiser" >Déprévisualiser</button>':'<button type = "submit" class = "btn btn-primary" name="action" value="previsualiser" >Prévisualiser</button>';    
    
    $creation = ($article->getCreation()) ? $article->getCreation()->format("Y-m-d H:i:s"): $date->format("Y-m-d H:i:s");
    $output = <<<EOF
               <form role = "form" action = "$php_self" method = "post" >
                <div class = "form-group">
                    <label for = "article_titre">Titre $publication $previsualisation $archive</label>
                    <input type = "text" class = "form-control" name = "article_titre" value="$titre">
                </div>
                <div class = "form-group">
                    <label for = "flash_resume">Résumé</label>
                    <textarea class = "form-control tinymce" rows = "3" name = 'article_resume' >$resume</textarea>
                </div>
                <div class = "form-group">
                    <label for = "flash_contenu">Contenu</label>
                    <textarea class = "form-control tinymce" rows = "5" name = 'article_contenu'>$contenu</textarea>
                </div>
                <input type = 'hidden' name = 'article_creation' value = '$creation' />
                <input type = 'hidden' name = 'article_etiquette' value = '$etiquette' />
                <input type = 'hidden' name = 'article_id' value = '$id' />
                <div class = "form-group">
                    <button type = "submit" class = "btn btn-primary" name="action" value="enregistrer" >Enregistrer</button>
                   $btn_archivage
                   $btn_publication
                   $btn_previsualisation
                </div>
            </form >
EOF;
                
        return $output;
    }
    
    public function getList(array $articles){
        
        if (is_null($articles)){return $output="";}
        $output = '<table class="table table-striped">';
        $output .= 
        '<thead><tr>
            <th>#</th>
            <th>Titre</th>
            <th>Résumé</th>
            <th>Contenu</th>
            <th>Publication</th>
            <th>Prévisualisation</th>
            <th>Action</th>
        </tr></thead><tbody>';
                
        if (is_array($articles)){
            foreach ($articles as $article){
                $publication = ($article->getPublication())? 'Publié' : '';
                $previsualisation = ($article->getPrevisualisation())? 'Prévisualisation' : '';
                $etiquette = $article->getEtiquette();
                $id = $article->getId();
                $output .= '<tr>';
                $output .= "<td>".$article->getId()."</td>";
                $output .= "<td>".$article->getTitre()."</td>";
                $output .= "<td>".$article->getResume()."</td>";
                $output .= "<td>".$article->getContenu()."</td>";
                $output .= "<td><span class='label label-primary'>$publication</span></td><td> <span class='label label-primary'>$previsualisation</span></td>";
                $output .= "<td><a href='previsualisation.php?etiquette=$etiquette&id=$id'><span class='glyphicon glyphicon-eye-open color-primary'></span></a>&nbsp;&nbsp;<a href='formulaire.php?etiquette=$etiquette&id=$id'><span class='glyphicon glyphicon-edit color-primary'></span></a> <a href='delete.php?etiquette=$etiquette&id=$id'  ><span class='glyphicon glyphicon-trash color-warning'></span></a></td>";
                $output .= '</tr>';
                
            }
        }
        else {
            throw new Exception('Un tableau doit être passé en paramètre');
        }
        $output .='</tbody></table>';
        return $output;
    }
    
    public function getTeaser(articles $article , $page){
        $id = $article->getId();
        $titre = $article->getTitre();
        $resume = $article->getResume();      
        $url = sprintf($page, $id);           
        $output = <<<EOF
                <div class="articles-item">
                    <h3><a href="$url">$titre</a></h3>
                    <div class="resume">$resume</div>
                    
                </div>
EOF;
        return $output;
    }
    public function getFullArticle(articles $article){
        $id = $article->getId();
        $titre = $article->getTitre();
        $content =$article->getContenu();
        $output = <<<EOF
                <div class="article-full">
                    <h3>$titre</h3>
                    <div class="contenu">$content</div>                  
                </div>
EOF;
        return $output;
    }
    public function getPost($_POST) {     
        $db = new articlesModele();
        $article = new articles();
        $article->setPrevisualisation()
                ->setPublication()
                ->setArchive();
        if(filter_input(INPUT_POST, 'article_id')){$article = $db->find(filter_input(INPUT_POST, 'article_id'));}       
        $article->setTitre(filter_input(INPUT_POST, 'article_titre'))
                ->setResume(filter_input(INPUT_POST, 'article_resume'))
                ->setContenu(filter_input(INPUT_POST, 'article_contenu'))
                ->setEtiquette(filter_input(INPUT_POST, 'article_etiquette'));       
        $action = filter_input(INPUT_POST, 'action');
        switch ($action){
            case 'enregistrer':
                if($article->getId())$db->update($article);
                else {
                    $article->setCreation(new DateTime());
                    $db->insert($article);
                }
                break;
            case 'archiver':
                if($article->getId()){
                    if($article->getArchive()) { $article->setArchive(FALSE);}
                    else {$article->setArchive(TRUE);}
                    $db->update($article);
                } 
                else {
                    $article->setArchive(TRUE);
                    $article->setCreation(new DateTime());
                    $db->insert($article);
                }            
                break;
            case 'publier' : 
                if($article->getId()){
                    if($article->getPublication()) { $article->setPublication(FALSE);}
                    else {$article->setPublication(TRUE);}
                    $db->update($article);
                } 
                else {
                    $article->setPublication(TRUE);
                    $article->setCreation(new DateTime());
                    $db->insert($article);
                }      
                break;
            case 'previsualiser' :
                if($article->getId()){
                    if($article->getPrevisualisation() == 1) { 
                        $article->setPrevisualisation(FALSE);
                    }
                    else {
                        $article->setPrevisualisation(TRUE);                      
                        $form['redirection'] = 'Location: '.sprintf(ARTICLE_PREVIEW , $article->getEtiquette(), $article->getId()); 
                    }
                    $db->update($article);
                } 
                else {
                    $article->setPrevisualisation(TRUE);
                    $article->setCreation(new DateTime());
                    $db->insert($article);
                }            
                break;
        } 
        $form['article'] = $article;
        return $form;
    }

}
