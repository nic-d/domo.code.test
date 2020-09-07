# DOMO Chat App

### Initial Setup
1. Install [docker on mac](https://hub.docker.com/?overlay=onboarding).

2. Run
    ```bash
    ./bin/setup
    ``` 
    this will set up a hosts entry in `/etc/hosts` with the following records:
    - api.domo_project.local: the api.
    - domo_project.local: the chat app.
    
3. Install API dependencies by running:
   ```bash
   cd api && composer install
   ```
   
4. Install CLIENT dependencies by running:
   ```bash
   cd ../client && yarn
   ```
    
5. Copy the `.env.example` to `.env` in the `api` directory and fill out the 
   details. And do the same for `client` directory.
   
6. Now you just need to run
    ```bash
    ./bin/up
    ```
    This will bring up all our containers to run the app.
   
7. Run the API migrations:
   `./bin/artisan migrate`
   
8. Install Laravel Passport:
   `./bin/artisan passport:install` and then copy the secret for ID 2, and paste
   this into the .env for `api`.
   
9. You should be good to go!

### Helper Commands

I've built a few short commands to make working with our containers easier. docker-compose has
several long-winded commands, so this just makes life that little bit easier :).

| Command                             | Description                                                |
|-------------------------------------|------------------------------------------------------------|
| `./bin/restart`                     | Runs `down` and then `up` to restart containers.           |
| `./bin/up`                          | Starts the containers                                      |
| `./bin/down`                        | Stops the containers                                       |
| `./bin/rebuild`                     | Rebuilds the containers and starts the server              |
| `./bin/shell <container>`           | Run bash in a running container                            |
| `./bin/exec <container> <command>`  | Execute a command within a container                       |
| `./bin/run <command>`               | Run any `docker-compose <command>` within the container    |
| `./bin/artisan <command>`           | Run `artisan <command>` within the api container           |
| `./bin/composer`                    | Runs the `composer` command in the api container           |
| `./bin/test`                        | Runs the `artisan test` command in the api container       |
