## Getting started

1. Download this repo to your local environment:

    ```
    git clone git@github.com:spleshka/drupal-reactjs-docker.git
    ```

2. Run bash script `./local-prepare.sh` in the git root to prepare all necessary dependencies & local environment.

3. Add the following lines to your hosts file:

    ```
    127.0.0.1 example.local
    127.0.0.1 api.example.local
    ```

## Making changes to Nodejs stack

If you want to make a change to `package.json` inside of any frontend application, then make this change as desired, then run:

```
# Rebuilding docker image with latest changes in package.json
docker-compose build

# Tell Docker to use recently updated image.
docker-compose up -d
```

## Shutting down the environments

To shut the environment run `docker-compose stop`. It's also possible to shut it using `docker-compose down`, but the latter option will drop mysql databases.

