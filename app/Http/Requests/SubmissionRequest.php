<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class SubmissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function failed(\Exception $exception): void
    {
        Log::error('Submission job failed', ['error' => $exception->getMessage()]);
    }

}
