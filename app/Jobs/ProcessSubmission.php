<?php
namespace App\Jobs;

use App\Models\Submission;
use App\Services\SubmissionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(SubmissionService $submissionService): void
    {
        $submission = $submissionService->storeSubmission($this->data);

        event(new \App\Events\SubmissionSaved($submission));
    }
}
