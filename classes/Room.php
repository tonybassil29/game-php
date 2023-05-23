<?php

class Room {
    private string $name;
    private string $description;
    private string $type;
    private int $donjon_id;
    private int $or;
    private int $equipement;
    public string $picture;

    public function __construct($room)
    {
        $this->name = $room['name'];
        $this->description = $room['description'];
        $this->type = $room['type'];
        $this->donjon_id = $room['donjon_id'];
        $this->picture = $room['picture'] ? $room['picture'] : "";

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getHTML(): string
    {
        $html = "";
       
        switch ($this->type) {
            case 'vide':
                
                $html .= "<p class='mt-4'><a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-game'>Continuer l'exploration</a></p>";
                break;

            case 'treasur':
                
                $html .= "<p class='html-class'>Vous avez gagné l'équipement " . $this->equipement . ".</p>";
                $html .= "<p class='mt-4'><a href='donjons_recuperer.php?id=". $this->donjon_id ."' class='btn btn-game'>Récuperer votre équipement</a></p>";
                $html .= "<p class='mt-4'><a href='donjons_equipement.php?id=". $this->donjon_id ."' class='btn btn-game'>Voir tous les équipements</a></p>";
                $html .= "<p class='mt-4'><a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-game'>Continuer l'exploration</a></p>";
                break;

            case 'combat':
               
                $html .= "<p class='mt-4'><a href='donjons_fight.php?id=". $this->donjon_id ."' class='btn btn-game'>Combattre</a></p>";
                $html .= "<p class='mt-4'><a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-game'>Fuir et continuer l'exploration</a></p>";
                break;
            
            case 'salle_vie':
                $html .= "<p class='mt-4'><a href='donjons_reanimer.php?id=". $this->donjon_id ."' class='btn btn-game'>Réanimer</a>";
                $html .= "<p class='mt-4'><a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-game'>Continuer l'exploration</a></p>";
                break;
            
            default:
                $html .= "<p>Aucune action possible !</p>";
                break;
        }

        return $html;
    }

    public function makeAction(): void
    {
        switch ($this->type) {
            case 'vide':
                break;

            case 'treasur':
             

                
                if (!isset($_SESSION['equipement_counter'])) {
                    $_SESSION['equipement_counter'] = 0;
                }
            
                
                if ($_SESSION['equipement_counter'] < 1) {

                    $this->equipement = rand(1, 6);
                    $_SESSION['perso']['id_equipement'] += $this->equipement;
            
                 
                    $_SESSION['equipement_counter']++;
            
                    
            
                    $bdd = connect();
                    $sql = "UPDATE persos SET `id_equipement` = :id_equipement WHERE id = :id AND user_id = :user_id;";    
                    $sth = $bdd->prepare($sql);

                  $sth->execute([
                    'id_equipement'   => $_SESSION['perso']['id_equipement'],
                    'id'        => $_SESSION['perso']['id'],
                     'user_id'   => $_SESSION['user']['id']
                 ]);
               }
               else {
                echo "Vous avez déja récuperer un équipement ! Aucun autre équipement vous sera attribuez";
               }
                break;

            case 'combat':
                break;
            
            default:
                break;
        }
    }

}