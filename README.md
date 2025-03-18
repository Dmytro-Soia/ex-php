# Php trainings

> v0.1.42 <!-- x-release-please-version -->

## Prerequisites

1. A working installation of PHP on your system. You need PHP 8.2 minimum.
2. You need to install [composer](https://getcomposer.org/doc/00-intro.md)

> You can check working installation with `php -v` and `composer -v`.

## Get source and install dependencies

```shell
# Clone or download the repository
# move into project repository
cd ex-php
# Install dependencies
composer install
pnpm i # Npm has nothing to do with php, but we will need it to run tests
```

## Language syntax exercises

> To launch the tests, you can use `./vendor/bin/pest` command, or
> install [Pest plugin](https://pestphp.com/docs/editor-setup) on your IDE.

1. [Basics](src/Basics.php)
2. [Arrays and Loops](src/ArraysAndLoops.php)

## Generating and processing web pages

Php is well known for its ability to generate web pages.
The following exercises will help you to understand how to generate web pages with PHP.
To test your php web pages, you need to run the following command `php -S localhost:8000 -t public/`.
Once the server is running, you can open your browser and go to [localhost](http://localhost:8000).

> To test if your pages work, use playwright tests : **[You need to start playwright docker container first](#install-and-start-playwright)**.
> You can run them from the playwright ui (Playwright automatically start php dev server).

1. [Get current time](public/getCurrentTime.php)
2. [Query parameters](public/queryParameterDisplay.php)
3. [Forms](public/formManagement.php)
3. [Create todo's and write them to database](public/writeTodoToDatabase.php)
3. [Display a list of todo's from database](public/displayAllTodosFromDatabase.php)
3. [Delete à todo in database](public/deleteTodoFromDatabase.php)

## Install and start Playwright

You can easily **run the playwright server** on a docker container :
```shell
docker run --rm --network host --init -it mcr.microsoft.com/playwright:v1.51.0-noble /bin/sh -c "cd /home/pwuser && npx -y playwright@1.51.0 run-server --port 8080"
```
This will start a docker container with the playwright server and all the browsers binary and libraries.

Then, when **running your playwright tests**, just add an environment variable with the server location :
```shell
PW_TEST_CONNECT_WS_ENDPOINT=ws://localhost:8080/ npx playwright test
# Or with UI
PW_TEST_CONNECT_WS_ENDPOINT=ws://localhost:8080/ npx playwright test --ui-port=9090
```
With this setup, the test logic will run on the host, but the browsers will remain in the container.

> More information [here](https://discuss.layer5.io/t/how-to-setup-e2e-testing-environment-with-playwright-and-docker-for-meshery/5498).
