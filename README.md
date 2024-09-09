# Laravel API with Job Queue, Database and Event Handling

### Setup

1. Clone the repository.
2. Install dependencies: `composer install`.
3. Setup your `.env` file for database connection.
4. Run the migrations: `php artisan migrate`.
5. Start the queue worker: `php artisan queue:work`.

### API Endpoint

- POST `/api/submit`
    - Payload:
      ```json
      {
        "name": "John Doe",
        "email": "john.doe@example.com",
        "message": "This is a test message."
      }
      ```

### Testing

- Run tests: `php artisan test`.
