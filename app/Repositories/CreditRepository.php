<?php

namespace App\Repositories;

use App\Interfaces\ICreditRepository;
use App\Models\Credit;
use App\Models\Project;
use App\Services\SerialNumberGenerator;
//use Your Model

/**
 * Class CreditRepository.
 */
class CreditRepository implements ICreditRepository
{
    protected $credit;

    public function __construct(Credit $credit)
    {
        $this->credit = $credit;
    }

    public function getAll()
    {
        return Credit::all();
    }

    public function getById($id)
    {
        return Credit::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['serial_number'] = $data['serial_number'] ?? SerialNumberGenerator::generate();

        $credit = Credit::create($data);

        if(isset($data['project_ID'])) {
            $project = Project::find($data['project_ID']);
            if($project) {
                $project->carbon_credit_ID = $credit->id;
                $project->save();
            }
        }
        return $credit;
    }

    public function update($id, array $data) {
        $credit = $this->credit->findOrFail($id);
        $credit->update($data);
            return $credit;
    }

    public function delete($id)
    {
        $credit = $this->credit->findOrFail($id);
            return $credit->delete();
    }
}
