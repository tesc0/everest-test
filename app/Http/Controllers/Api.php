<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Repository\RobotRepositoryInterface;

use App\Http\Fight;

class Api extends Controller
{
    private $robotRepository;

    public function __construct(
        RobotRepositoryInterface $robotRepository
    ) 
    {
        $this->robotRepository = $robotRepository;
    }

    /**
     * Robotok listája
     */
    public function robots() 
    {
        $data = [];
        $data['list'] = $this->robotRepository->all();
        return response()->json($data);
    }

    /**
     * Harc
     */
    public function fight(Request $request) 
    {
        $data = [];
        $errors = [];

        $robotsToFight = $request->get('robots');

        if (count($robotsToFight) !== 2) {
            $errors[] = 'Két robot harcolhat!';
        }

        if (empty($errors)) {

            foreach ($robotsToFight as $index => $robotId) {
                ${'robot' . $index} = $this->robotRepository->find($robotId);
            }

            $fight = new Fight($robot0, $robot1);
            $fight->fight();
            $data = $fight->getResults();
        }
        
        $data['errors'] = $errors;
        return response()->json($data);
    }
}