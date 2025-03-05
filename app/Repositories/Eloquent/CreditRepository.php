<?php

namespace App\Repositories\Eloquent;

use App\Models\Credit;
use App\Models\Project;
use App\Repositories\Contracts\IBaseRepository;

//use Your Model

/**
 * Class CreditRepository.
 */
class CreditRepository implements IBaseRepository
{
    protected $credit;

    public function __construct(Credit $credit)
    {
        $this->credit = $credit;
    }

    public function getAll()
    {
        return $this->credit->all();
    }

    public function getById($id)
    {
        return $this->credit->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->credit->create($data);
    }

    public function update($id, array $data)
    {
        $credit = $this->getById($id);
        $credit->update($data);
        return $credit;
    }

    public function delete($id)
    {
        $credit = $this->getById($id);
        return $credit->delete();
    }
}
