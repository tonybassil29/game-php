<?php

class Room {
    private string $name;
    private string $description;
    private string $type;
    private int $donjon_id;

    public function __construct($room)
    {
        $this->name = $room['name'];
        $this->description = $room['description'];
        $this->type = $room['type'];
        $this->donjon_id = $room['donjon_id'];
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

    public function getAction(): string
    {
        $html = "";

        switch ($this->type) {
            case 'vide':
               
                $html .= "<a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-green'>Continuer l'exploration</a>";
                break;

            case 'treasur':
                $or = rand(0, 20);
                $_SESSION['perso']['gold'] += $or;

                $html .= "<p>Vous avez gagné " . $or . " pièce d'or</p>"; 
                $html .= "<a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-green'>Continuer l'exploration</a>";
                break;

            case 'combat';
                $html .= "<a href='donjons_fight.php?id=". $this->donjon_id ."' class='btn btn-green'>Combattre</a>";
                $html .= "<a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-green'>Fuire et continuer l'exploration</a>";
                break;
            
            default:
                $html .= "Aucune action possible !";
                break;
        }

        return $html;
    }

}