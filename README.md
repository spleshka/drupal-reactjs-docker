# Concern Worldwide v2 (Falcon)

This is the main repository for Concern Worldwide v2. You should start your journey by cloning this repo and following the instructions in this file.

## Understanding the project's structure

This repo contains Platform.sh multi-app project.
You'll find more info about it at their [documentation](https://docs.platform.sh/configuration/app/multi-app.html).


## Getting started

1. Download this repo to your local environment:

    ```
    git clone git@github.com:systemseed/cw2.git
    ```

2. Run bash script `./local-prepare.sh` in the git root to prepare all necessary dependencies & local environment.

3. Install [Platform.sh CLI](https://github.com/platformsh/platformsh-cli):

    ```
    curl -sS https://platform.sh/cli/installer | php
    ```

    Don't forget to authenticate after the installation. CLI docs to the rescue.

4. Add the following lines to your hosts file:

    ```
    127.0.0.1 gifts.cw2.local
    127.0.0.1 gifts.api.cw2.local
    127.0.0.1 donations.api.cw2.local
    ```

## Accessing web sites locally

### Gifts Frontend

[http://gifts.cw2.local](http://gifts.cw2.local)

### Gifts Backend

[http://gifts.api.cw2.local](http://gifts.api.cw2.local)

### Donations Backend

[http://donations.api.cw2.local](http://donations.api.cw2.local)


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

