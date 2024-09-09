<?php

namespace App\Repositories;

use App\Models\Submission;

class SubmissionRepository
{
    protected $model;

    public function __construct(Submission $submission)
    {
        $this->model = $submission;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
