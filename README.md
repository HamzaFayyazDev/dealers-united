# Laravel Application with Laravel Sail

## Introduction

This repository contains a Laravel application that has been developed using Laravel Sail for local development. Laravel Sail provides a lightweight Docker development environment for Laravel applications.

## Prerequisites

Before you start, ensure you have the following installed on your system:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

1. **Clone the repository:**

    ```bash
    git clone https://github.com/yourusername/your-repository.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd your-repository
    ```

3. **Copy the example environment file:**

    ```bash
    cp .env.example .env
    ```

4. **Install dependencies using Composer:**

    ```bash
    docker run --rm -v $(pwd):/opt -w /opt laravelsail/php82-composer:latest composer install
    ```

5. **Start the Docker containers using Sail:**

    ```bash
    ./vendor/bin/sail up -d
    ```

6. **Generate an application key:**

    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

7. **Migrate the database:**

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

## Running the Application

Once the Docker containers are running, you can access the application in your web browser:

- **Application:** [http://localhost](http://localhost)

## Stopping the Application

To stop the Docker containers, run:

```bash
./vendor/bin/sail down
