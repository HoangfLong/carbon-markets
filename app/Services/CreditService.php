<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\Eloquent\CreditRepository;

class CreditService
{
    protected $creditRepository;

    public function __construct(CreditRepository $creditRepository)
    {
        $this->creditRepository = $creditRepository;
    }

    public function getAllCredits()
    {
        return $this->creditRepository->getAll();
    }

    public function getCreditById($id)
    {
        return $this->creditRepository->getById($id);
    }

    public function createCredit(array $data)
    {
        $credit = $this->creditRepository->create($data);

        if (isset($data['project_ID'])) {
            $project = Project::find($data['project_ID']);
            if ($project) {
                $project->carbon_credit_ID = $credit->id;
                $project->save();
            }
        }

        return $credit;
    }

    public function updateCredit($id, array $data)
    {
        return $this->creditRepository->update($id, $data);
    }

    public function deleteCredit($id)
    {
        return $this->creditRepository->delete($id);
    }
}
