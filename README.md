# Plane Booking Service

### Follow these steps to set up and run the Plane Booking Service application using Docker:

1. Clone the repository:
    ```bash
    git clone https://github.com/booeraque/plane-booking-service.git
    cd plane-booking-service
    ```

2. Build the Docker image:
    ```bash
    docker build -t plane-booking-service .
    ```

3. Run the Docker container:
    ```bash
    docker run -d -p 8000:8000 --name plane-booking-service-container plane-booking-service
    ```

4. Access the application:
    Open your browser and navigate to `http://localhost:8000`


## Usage

- Use the following command to clear the database and seed it with sample data:
    ```bash
    php artisan migrate:fresh --seed
    ```

## License

This project is licensed under the MIT License.
