<?php 

require_once('./Classes/Ennemi.php');

class Boxeur4 extends Ennemi
{
    public function __construct()
    {
           $this->pol = 25 ;
           $this->name= 'Mike Tyson' ;
           $this->power = 5 ;
           $this->constitution = 6 ;
           $this->speed = 7 ;
           $this->xp = 20;
           $this->gold = 100 ;
           $this->picture = 'img/boxeur4.png'; 
    
    }


    public function run_away(){

        $run = random_int(1, 10);

        if ($run <= 5) {
            echo "Le Boxeur 4 réussit à s'enfuir du combat !";
            unset($_SESSION['fight']['ennemi']);
        } else {
            echo "Le Boxeur 4 échoue à s'échapper et reste dans le combat !";
        }
        
    }
}