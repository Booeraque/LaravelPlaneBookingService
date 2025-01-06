1. Build the Docker image:  <pre>docker build -t plane-booking-service . </pre>
2. Run the Docker container:  <pre>docker run -d -p 8000:8000 --name plane-booking-service-container plane-booking-service </pre>
3. Access the application: Open your web browser and navigate to http://localhost:8000.  
4. Stop the Docker container:  <pre>docker stop plane-booking-service-container </pre>
5. Remove the Docker container:<pre>docker rm plane-booking-service-container </pre>
