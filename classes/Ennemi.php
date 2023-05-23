<?php

class Ennemi
{
    // Définition des attributs
    public int $pol;
    public string $name;
    public int $power;
    public int $constitution;
    public int $speed;
    public int $xp;
    public int $gold;
    public string $image;

    // Fonction qui gère l'attaque.
    public function atk()
    {
        
        $forceattaque = random_int(1, 10);
        echo "Le " . $this->name . " attaque avec une force de " . $forceattaque . " points.";
        $facteurdommages = $forceattaque * ($this->speed / 10) * ($this->gold / 100);
    
        if ($facteurdommages >= 8) {
            echo " L'adversaire porte un coup puissant !";
    
    
            $degats = $facteurdommages * $this->power; 
            $personnage->subirdegats($degats); 
           
            $this->actionspeciale(); 
        } elseif ($facteurdommages >= 5) {
            echo " L'adversaire inflige des dégâts modérés.";
    
           
            $degats = $facteurdommages * ($this->power / 2); 
            $personnage->subircegats($degats); 
        } else {
            echo " L'adversaire ne parvient pas à causer de grands dégâts.";
    
         
            $degats = $facteurdommages * ($this->power / 4); 
            $personnage->subirdegats($degats); 
        }
    }
    
}
