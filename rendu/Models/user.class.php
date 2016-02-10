<?php

Class User
{
    private $iduser;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;

    
    public static function encoder($mdp)
    {
        return hash('sha512',$mdp);
    }

    public function verifier_mdp($login,$mdp)
    {
        global $cnx;
        $req='SELECT id_user,nom,prenom,/*photo,*/mdp, FROM User WHERE e_mail='.'"'.$login.'"';
        $resultat=$cnx->query($req);

        $resultat->setFetchMode(PDO::FETCH_OBJ);
        //fetch de line = false si pas de mdp donc user n'existe pas
        $line=$resultat->fetch();

        if($line==false)
        {
            return 'no_user';
        }

        else
        {
            $mdp_bd=$line->mdp;

            $mdp_crypt=hash('sha512',$mdp);

            if($mdp_bd==$mdp_crypt)
            {
                //je donne des valeur a mes variable privée declarées plus haut
                $this->iduser=$line->id_user;
                $this->nom=$line->nom;
                $this->prenom=$line->prenom;
                $this->photo=$line->photo;
                $this->mdp=$line->mdp;

                //chaine de caractere == true lors d'une comparaison
                //on retourne plutot une chaine de caractère
                return 'reussite';
            }        

            else
            {
                return 'wrong_pass';
            }
        }    
    }

    public function get_iduser()
    {
        return $this->iduser;
    }

    public function get_nom()
    {
        return $this->nom;
    }

    public function get_prenom()
    {
        return $this->prenom;
    }

    public function get_photo()
    {
        return $this->photo;
    }

    public function get_mdp()
    {
        return $this->mdp;
    }

    //definirtion des valeur private
    public function set_All($nom,$prenom,$mail,$mdp)
    {
        //variable private = variable reçu
        $this->nom=$nom;
        $this->prenom=$prenom;
        /*$this->photo=$photo;*/
        $this->email=$mail;
        $this->mdp=self::encoder($mdp);
    }

    //enregistrement des données utilisateur
    public function enregistrer()
    {
        global $cnx;
        
        $req='INSERT INTO User ( nom, prenom, e_mail, mdp) VALUES ("'.$this->nom.'","'.$this->prenom.'","'.$this->email.'","'.$this->mdp.'")';
        $cnx->exec($req);    
        $this->iduser=$cnx->lastInsertId();
    }

    public function emailAlreadyUsed($email)
    {
        global $cnx;
        $req='SELECT id_user FROM User WHERE e_mail="'.$email.'"';
        $resultat=$cnx->query($req);

        $resultat->setFetchMode(PDO::FETCH_OBJ);
        //fetch de line = false si pas de mdp donc user n'existe pas
        $line=$resultat->fetch();

        return ($line!=false);
    }
}
?>