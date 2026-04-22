# Docker PHP MySQL Project

##  About the Project
This is a simple web application built using PHP and MySQL.  
The project is containerized using Docker Compose to make it easy to run without installing PHP or MySQL manually on the computer.

It also includes phpMyAdmin to help manage the database easily from the browser.


## Project Components

This project contains 3 main services:

### 1. App (PHP + Apache)
- This is the web application (frontend + backend using PHP)
- It runs on Apache server inside a Docker container
- Accessible from:
  http://localhost:8080
- It connects to the database to handle user data


### 2. Database (MySQL)
- MySQL is used to store all application data
- Database name: student_db
- It runs in a separate container
- Data is saved permanently using Docker volume (so it is not lost when containers stop)


### 3. phpMyAdmin
- A web tool to manage the database visually
- Used to view, edit, and check tables easily
- Accessible from:
  http://localhost:8081


##  How the System Works
- The PHP application connects to MySQL using the service name: `db`
- Docker creates a private network between containers automatically
- This allows communication between PHP and MySQL without needing localhost


##  How to Run the Project

Make sure Docker Desktop is running, then open the terminal inside the project folder and run:

docker compose up --build


##  Access the Project

After running the command:

- Web Application → http://localhost:8080  
- phpMyAdmin → http://localhost:8081  


##  Notes
- The database is automatically created on first run
- All services run in isolated containers
- The project works the same on any computer as long as Docker is installed