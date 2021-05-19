# NMI Quiz

## Installation
I have created a custom docker image to run the PHP scripts in this quiz.

- Install Docker Desktop on your system.
- Navigate to this directory on terminal
- Build the docker image with PHP 7.4
`docker build -t nmi_quiz .`
- For question 5, build the docker image with PHP 5.6. Navigate inside in the php-excel-reader-2.21 directory and
`docker build -t nmi_excel_quiz .`

## Creating, running and stopping the docker containers
- Creating and running the answers 1, 4, 6
`docker run --rm -it nmi_quiz`

- Creating and running the answers 5
`docker run --rm -it nmi_excel_quiz`

## Removing docker images
- Removing the PHP 7.4 image
`docker rmi nmi_quiz`

- Removing the PHP 5.6 image
`docker rmi nmi_excel_quiz`
