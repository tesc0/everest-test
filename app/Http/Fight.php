<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Repository\RobotRepositoryInterface;

/**
 * Új harc
 * 
 * a nagyobb erejű robot győz, ha azonosak, akkor az újabb robot győz (aki később lett rögzítve)
 */

class Fight
{
    private $robot1;
    private $robot2;
    private $result;

    public function __construct($robot1, $robot2) {
        $this->robot1 = $robot1;
        $this->robot2 = $robot2;
    }

    public function fight() {

        if ($this->robot1['power'] > $this->robot2['power']) {
            $this->result['winner'] = $this->robot1;                
            $this->result['loser'] = $this->robot2;
        } else if ($this->robot1['power'] < $this->robot2['power']) {
            $this->result['winner'] = $this->robot2;
            $this->result['loser'] = $this->robot1;
        } else {
            if ($this->robot1['id'] > $this->robot2['id']) {
                $this->result['winner'] = $this->robot1;                    
                $this->result['loser'] = $this->robot2;
            } else {
                $this->result['winner'] = $this->robot2;
                $this->result['loser'] = $this->robot1;
            }
        }
    }

    public function getResults() {
        return $this->result;
    }
}