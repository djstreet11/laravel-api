<?php

namespace Tests\Unit;

use App\Jobs\ProcessSubmission;
use App\Models\Submission;
use App\Services\SubmissionService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_process_submission_job_saves_to_database()
    {
        Event::fake();

        Queue::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        ProcessSubmission::dispatch($data);

        Queue::assertPushed(ProcessSubmission::class);

        $job = new ProcessSubmission($data);
        $submissionService = app(SubmissionService::class);
        $job->handle($submissionService);

        $this->assertDatabaseHas('submissions', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ]);

        Event::assertDispatched('App\Events\SubmissionSaved', function ($event) use ($data) {
            return $event->submission->name === $data['name'] &&
                $event->submission->email === $data['email'];
        });
    }
}
