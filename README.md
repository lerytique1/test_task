# Test Task Yii2 by Rytikoff

This is a Yii2 project configured to run with Docker Compose. It includes services for PHP, PostgreSQL, and Nginx.

## Prerequisites

Make sure you have the following installed on your system:

- Docker
- Docker Compose

## Setup

1. Clone the repository:

    ```sh
    git clone <repository_url>
    cd <repository_directory>
    ```

2. Copy the example environment file and edit the database credentials:

    ```sh
    cp .env-example .env
    ```

   Update the `.env` file with your database credentials:

    ```env
    POSTGRES_USER=your_postgres_user
    POSTGRES_PASSWORD=your_postgres_password
    POSTGRES_DB=your_postgres_db
    ```

3. Run the deploy script to start the services and set up the project:

    ```sh
    ./deploy.sh
    ```

4. Access the site:

- Main page: [http://localhost:8080](http://localhost:8080)
- Admin page: [http://localhost:8080/admin?token=xyz123](http://localhost:8080/admin?token=xyz123)

## Project Structure

- `Dockerfile`: Defines the PHP container with all necessary dependencies.
- `docker-compose.yml`: Defines the services (PHP, PostgreSQL, Nginx) and their configurations.
- `default.conf`: Nginx configuration file.
- `deploy.sh`: Script to deploy the application.
- `migrations/`: Directory containing database migrations.
- `models/`: Directory containing the Yii2 models.
- `repositories/`: Directory containing repository classes for database interaction.
- `services/`: Directory containing service classes.
- `requests/`: Directory containing request validation classes.
- `controllers/`: Directory containing the application controllers.
- `views/`: Directory containing the application views.
- `.env-example`: Example environment file.

## Database Migrations

If you need to manually run migrations, use the following command inside the PHP container:

```sh
php yii migrate --interactive=0
