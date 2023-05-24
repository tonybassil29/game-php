<?php

class Room {
    private string $name;
    private string $description;
    private string $type;
    private int $donjon_id;
    private int $or;
    private int $equipement;
    private string $picture;
    
    
    public function __construct($room)
    {
        $this->name = $room['name'];
        $this->description = $room['description'];
        $this->type = $room['type'];
        $this->donjon_id = $room['donjon_id'];
        $this->picture = $room['picture'] ? $room['picture'] : "";
        $this->equipement = 1;

    }
    public function setEquipement(int $equipement) {
        $this->equipement = $equipement;
    }

    public function getEquipement() {
        return $this->equipement;
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
                
             
                $html .= "<p class='mt-4'><a href='donjons_recuperer.php?id=". $this->donjon_id ."' class='btn btn-game'>Récuperer votre équipement</a></p>";
                $html .= "<p class='mt-4'><a href='donjons_equipement.php?id=". $this->donjon_id ."' class='btn btn-game'>Voir ou Acheter des équipements</a></p>";
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
        
        $firstLoop = true;

        if (!isset($_SESSION['equipement_counter']) || !isset($_SESSION['user']['id'])) {
            $_SESSION['equipement_counter'] = 1;
        }
    
        switch ($this->type) {
            case 'vide':
                break;
    
            case 'treasur':
                
  

    
    $bdd = connect();
    $sql = "SELECT id_equipement FROM persos WHERE id = :id AND user_id = :user_id;";
    $sth = $bdd->prepare($sql);
    $sth->execute([
        'id' => $_SESSION['perso']['id'],
        'user_id' => $_SESSION['user']['id']
    ]);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if ($result['id_equipement'] != 0) {
        echo '<div style="text-align: center; margin-top: 0; font-weight: bold; font-size: 20px; background-color: rgba(255, 255, 255, 0.1) ; padding: 20px;">';
        echo "Vous avez déjà récupéré un équipement ! Aucun autre équipement ne vous sera attribué.";
        echo '</div>';
    
    } else {
        $this->equipement = rand(1, 6);
        $_SESSION['perso']['id_equipement'] = $this->equipement;

       
        $sql = "UPDATE persos SET `id_equipement` = :id_equipement WHERE id = :id AND user_id = :user_id;";
        $sth = $bdd->prepare($sql);

        $sth->execute([
            'id_equipement' => $_SESSION['perso']['id_equipement'],
            'id' => $_SESSION['perso']['id'],
            'user_id' => $_SESSION['user']['id']
        ]);

        $firstLoop = true;
        $html = '';
        if ($firstLoop) {
            $html .= "<p class='html-class' style='font-weight: bold;text-align: center; font-size: 18px; background-color: rgba(255, 255, 255, 0.1); padding: 10px;'>Vous avez gagné l'équipement " . $this->equipement . ".</p>";
            $firstLoop = false;
        }
        

        echo $html;
    }
                break;
            case 'combat':
                break;
            
            default:
                break;
        }
    }

}