<?php

class articlesModele {
    
    public function insert(articles $article) {
        $db = new db();
        $sql = "INSERT INTO articles (titre, resume, contenu, etiquette, publication, previsualisation, archive, creation ) VALUES (:titre, :resume, :contenu, :etiquette, :publication, :previsualisation, :archive, :creation)";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':titre', $article->getTitre());
        $query->bindParam(':resume', $article->getResume());
        $query->bindParam(':contenu', $article->getContenu());
        $query->bindParam(':etiquette', $article->getEtiquette());
        $query->bindParam(':publication', $article->getPublication());
        $query->bindParam(':previsualisation', $article->getPrevisualisation());
        $query->bindParam(':archive', $article->getArchive());
        $query->bindParam(':creation', $article->getCreation()->format('Y-m-d H:i:s'));
        $query->execute();
        return $db->getDb()->lastInsertId();
    }
    
    public function update(articles $article) {
        $db = new db();
        $sql = "UPDATE articles SET titre = :titre , resume = :resume, contenu = :contenu, etiquette = :etiquette, publication = :publication, previsualisation = :previsualisation, archive = :archive WHERE id = :id";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':titre', $article->getTitre());
        $query->bindParam(':resume', $article->getResume());
        $query->bindParam(':contenu', $article->getContenu());
        $query->bindParam(':etiquette', $article->getEtiquette());
        $query->bindParam(':publication', $article->getPublication());
        $query->bindParam(':previsualisation', $article->getPrevisualisation());
        $query->bindParam(':archive', $article->getArchive());
        $query->bindParam(':id', $article->getId());
        $query->execute();       
    }
    
    public function delete(articles $article) {
        $db = new db();
        $sql = "DELETE FROM articles WHERE id = :id";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':id', $article->getId());
        $query->execute();
    }
    
    public function find($id) {
        $db = new db();
        $sql = "SELECT * FROM articles WHERE id = :id";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchObject();        
        if ($result) {
            $article = new articles();
            $article->setId($result->id)
                    ->setTitre($result->titre)
                    ->setResume($result->resume)
                    ->setContenu($result->contenu)
                    ->setEtiquette($result->etiquette)
                    ->setPublication($result->publication)
                    ->setPrevisualisation($result->previsualisation)
                    ->setArchive($result->archive)
                    ->setCreation(new DateTime($result->creation));
            return $article;
        } else { return NULL;}
    }
    
    public function findAll($etiquette, $limit = 5, $offset = 0) {
        $db = new db();
        $sql = "SELECT * FROM articles WHERE etiquette = :etiquette ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':etiquette',$etiquette);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll();
        foreach ($results as $key => $row){ 
            $articles[$key] = new articles();
            $articles[$key]->setId($row['id'])         
                    ->setTitre($row['titre'])
                    ->setResume($row['resume'])
                    ->setContenu($row['contenu'])
                    ->setEtiquette($row['etiquette'])
                    ->setPublication($row['publication'])
                    ->setPrevisualisation($row['previsualisation'])
                    ->setArchive($row['archive'])
                    ->setCreation(new DateTime($row['creation']));
        }
        return $articles;           
    }
    public function findWorkInProgress($etiquette, $limit = 5) {
        $db = new db();
        $sql = "SELECT * FROM articles WHERE etiquette = :etiquette And archive = 0 ORDER BY id DESC LIMIT :limit";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':etiquette',$etiquette);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll();
        foreach ($results as $key => $row){ 
            $articles[$key] = new articles();
            $articles[$key]->setId($row['id'])         
                    ->setTitre($row['titre'])
                    ->setResume($row['resume'])
                    ->setContenu($row['contenu'])
                    ->setEtiquette($row['etiquette'])
                    ->setPublication($row['publication'])
                    ->setPrevisualisation($row['previsualisation'])
                    ->setArchive($row['archive'])
                    ->setCreation(new DateTime($row['creation']));
        }
        return $articles;           
    }
    
    public function findArchive($etiquette, $limit = 30) {
        $db = new db();
        $sql = "SELECT * FROM articles WHERE etiquette = :etiquette AND archive = 1 ORDER BY id DESC LIMIT :limit";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':etiquette',$etiquette);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll();
        foreach ($results as $key => $row){ 
            $articles[$key] = new articles();
            $articles[$key]->setId($row['id'])         
                    ->setTitre($row['titre'])
                    ->setResume($row['resume'])
                    ->setContenu($row['contenu'])
                    ->setEtiquette($row['etiquette'])
                    ->setPublication($row['publication'])
                    ->setPrevisualisation($row['previsualisation'])
                    ->setArchive($row['archive'])
                    ->setCreation(new DateTime($row['creation']));
        }
        return $articles;           
    }
    
    
        public function getPublished($etiquette) {
        $db = new db();
        $sql = "SELECT * FROM articles WHERE etiquette = :etiquette AND publication = 1";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':etiquette',$etiquette);
        $query->execute();
        $results = $query->fetchAll();
        foreach ($results as $key => $row){ 
            $articles[$key] = new articles();
            $articles[$key]->setId($row['id'])         
                    ->setTitre($row['titre'])
                    ->setResume($row['resume'])
                    ->setContenu($row['contenu'])
                    ->setEtiquette($row['etiquette'])
                    ->setPublication($row['publication'])
                    ->setPrevisualisation($row['previsualisation'])
                    ->setArchive($row['archive'])
                    ->setCreation(new DateTime($row['creation']));
        }
        return $articles;           
    }
    
    public function findPreview($etiquette) {
        $db = new db();
        $sql = "SELECT * FROM articles WHERE etiquette = :etiquette AND previsualisation = 1";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':etiquette',$etiquette);
        $query->execute();
        $results = $query->fetchAll();
        foreach ($results as $key => $row){ 
            $articles[$key] = new articles();
            $articles[$key]->setId($row['id'])         
                    ->setTitre($row['titre'])
                    ->setResume($row['resume'])
                    ->setContenu($row['contenu'])
                    ->setEtiquette($row['etiquette'])
                    ->setPublication($row['publication'])
                    ->setPrevisualisation($row['previsualisation'])
                    ->setArchive($row['archive'])
                    ->setCreation(new DateTime($row['creation']));
        }
       
        return isset($articles)? $articles: NULL;           
    } 
    
    public function countArticle($etiquette){
        $db = new db();
        $sql = "SELECT COUNT(*) FROM articles WHERE etiquette = :etiquette";
        $query = $db->getDb()->prepare($sql);
        $query->bindParam(':etiquette',$etiquette);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }    
}
