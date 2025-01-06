Build the Docker image:  <pre>docker build -t plane-booking-service . </pre>
Run the Docker container:  <pre>docker run -d -p 8000:8000 --name plane-booking-service-container plane-booking-service </pre>
Access the application: Open your web browser and navigate to http://localhost:8000.  
Stop the Docker container:  <pre>docker stop plane-booking-service-container </pre>
Remove the Docker container:<pre>docker rm plane-booking-service-container </pre>
