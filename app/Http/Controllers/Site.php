<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Repository\RobotRepositoryInterface;

use App\Http\Fight;

class Site extends Controller
{
    private $robotRepository;

    public function __construct(
        RobotRepositoryInterface $robotRepository
    ) 
    {
        $this->robotRepository = $robotRepository;
    }

    public function index()
    {
        return view('index');
    }

    /**
     * Robotok listázása
     */
    public function listRobots()
    {
        $data = [];
        $data['robots'] = $this->robotRepository->all();
        return view('robots', $data);
    }

    /**
     * Robot adatainak mentése
     * - ha szerkesztés, akkor a robot adatait frissíti
     */
    public function robotSave(Request $request)
    {
        $data = [];
        $errors = [];

        $data['success'] = 0;

        $validator = Validator::make($request->all(), [
            'robot[name]' => 'required',
            'robot[type]' => 'required',
            'robot[power]' => 'required'
        ]);

        if(!empty($validator->failed())) {

            $validatorErrors = $validator->errors();
            foreach ($validatorErrors->getMessages() as $error) {
                $errors[] = $error;
            }
            $data['message'] = 'Érvénytelen adatok kerültek megadásra';
        } else {

            try {
                $robotData = $request->get('robot');
                $robotId = $request->get('robotId');

                if (!empty($robotId)) {
                    $this->robotRepository->update(['id' => $robotId], $robotData);    
                } else {
                    $this->robotRepository->create($robotData);
                }
                
                $data['success'] = 1;

            } catch (\Exception $e) {

            }
        }

        $data['errors'] = $errors;
        return redirect('/robots');
    }

    /**
     * Egy robot adatainak betöltése
     */
    public function robot($id = null)
    {
        $data = [];
        if (!empty($id)) {
            $data['id'] = $id;
            $data['robot'] = $this->robotRepository->find($id);
        }
        return view('robot', $data);
    }

    /**
     * Robot törlése
     */
    public function robotDelete($id)
    {
        $this->robotRepository->delete($id);
        return redirect('/robots');
    }

    /**
     * Harc két robot között
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
