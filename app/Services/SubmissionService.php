<?php

namespace App\Services;

use App\Repositories\SubmissionRepository;
use Illuminate\Support\Facades\Log;

class SubmissionService
{
    protected $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function storeSubmission(array $data)
    {
        try {
            $submission = $this->submissionRepository->create($data);

            Log::info('Submission saved', ['name' => $submission->name, 'email' => $submission->email]);

            return $submission;
        } catch (\Exception $e) {
            Log::error('Failed to save submission', ['error' => $e->getMessage()]);

            throw $e;
        }
    }
}
