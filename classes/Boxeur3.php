<?php

require_once('./classes/Ennemi.php');

class Boxeur3 extends Ennemi
{
    public function __construct()
    {
        $this->pol = 25;
        $this->name = "Francis Ngannou";
        $this->power = 5;
        $this->constitution = 6;
        $this->speed = 7;
        $this->xp = 20;
        $this->gold = 100;
        $this->picture = 'img/boxeur3.png'; 
    }

    public function fear()
    {
        $peur = random_int(1, 10);
       
    if ($peur <= 5) {
    echo "Vous vous tenez face au boxeur 2 avec une présence imposante, mais ce dernier ne montre aucune peur. Malgré vos intimidations, le boxeur 2 reste stoïque, prêt à relever le défi.";
    } else {
    echo "Votre aura de terreur en tant que boxeur de boxe thaïlandaise s'intensifie, envoyant des ondes de frayeur à travers le boxeur 2. Son corps tremble, ses jambes fléchissent et sa confiance s'évapore, ne pouvant rivaliser avec votre habileté et votre détermination implacable.";
   }

    }
}