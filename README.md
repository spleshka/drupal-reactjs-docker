# What is this project for?

It's a really quick start for **LOCAL** development of ReactJS + Drupal 8 applications.

As the result of configuration, you'll get:
- Working and ready for development ReactJS application running at `http://example.local`
- Working and ready for development Drupal 8 application running at `http://api.example.local`
- UI to access Drupal database running at `http://pma.example.local`
- Access to all emails rerouted from php (apart from emails sent through SMTP) running at `http://emails.example.local:8002`

# Advantages of this project

- You don't need to have `composer` on `npm` installed locally. Everything is being done though Docker containers.
- You don't depend on versions of `composer` or `npm` installed at dev environments of your team members.
- Docker configuration for Drupal is based on [docker4drupal](http://docker4drupal.org) containers. It provides very good flexibility for Docker-based local development. If you need more containers (i.e. for `memcached`, `redis`, `solr`, etc) - just check out what they offer.
- Drupal configuration is based on [drupal-composer/drupal-project](https://github.com/drupal-composer/drupal-project) project which provides best dev experience in working with Drupal through `composer`.
- ReactJS application bootstrapped with [Create React App](https://github.com/facebookincubator/create-react-app) - minimal & clean start for ReactJS development.
- Human readable local host names. No more ugly `localhost:PORT` stuff. Thanks to [Nginx Proxy](https://github.com/jwilder/nginx-proxy) project.

# Dependencies

All you need to have is [Docker](https://docs.docker.com/engine/installation/) and [Docker Compose](https://docs.docker.com/compose/install/) installed. That's it.

# Getting started

1. Download this repo to your local machine:

    ```
    git clone git@github.com:spleshka/drupal-reactjs-docker.git
    ```

2. Add the following lines to `/etc/hosts` file (or configure it on local DNS server, whatever works better for you):

    ```
    # Main reactjs app.
    127.0.0.1 example.local

    # Drupal backend.
    127.0.0.1 api.example.local

    # PhpMyAdmin for UI access to Drupal database.
    127.0.0.1 pma.example.local

    # Access all rerouted emails.
    # DOES NOT CAPTURE EMAILS SENT THROUGH SMTP.
    127.0.0.1 emails.example.local
    ```

3. Bootstrap Docker containers listed in `docker-compose.yml` file:

    ```
    docker-compose up -d
    ```

    During the process all necessary containers will be downloaded.
    As well as that, `npm install` will be invoked to build ReactJS dependencies inside of Docker image.
    This process may take several minutes.

    You DON'T need to have `npm` installed locally.

4. At this point `./drupal` folder is still empty. Let's get it fixed:

    ```
    rm drupal/.gitkeep
    docker-compose run backend_php composer create-project drupal-composer/drupal-project:8.x-dev . --stability dev --no-interaction -vvv
    ```

    All we do here is downloading Drupal with its dependencies using `backend_php` container.
    The installation might take around 5 minutes. No worries, it's expected.
    Please refer to `https://github.com/drupal-composer/drupal-project` for additional info.

    You DON'T need to have `composer` installed locally.

5. You will want to get all the dependencies for React.js as well:

    ```
    docker-compose run frontend npm install
    ```

6. Go ahead and open any host listed in step #2. You're ready to go!

7. As the final step you'd probably want to commit everything to your own repository.
    Feel free to drop `.git` folder in the project root and initialize it with your git settings. 

    As soon as this is done it's safe to run `git add -A` and commit everything what's been added.
    All files which should be ignored by git already specified in proper `.gitignore` files.

## Shutting down the environments

It's **IMPORTANT** to stop Docker containers using `docker-compose stop`.

Of course there's a possibility to shut the Docker containers down using `docker-compose down`, but it will drop Drupal database.
You can read a little bit more about it [here](https://github.com/wodby/docker4drupal/blob/master/CHANGELOG.md#action-required-before-upgrading).

## CLI to work with ReactJS application

To access all `npm` commands you can simply run shell inside of `frontend` Docker container:

```
docker-compose run frontend sh
```

Then use `npm` CLI as usual. For example, add a new package:

```
npm install lodash --save
```

All you'll need to commit is the change to `package.json` file.

## CLI to work with Drupal application

To access all available CLI to manage Drupal, run shell inside of `backend_php` Docker container:

```
docker-compose run backend_php sh
```

Then run any command you need. It's possible to use `composer`, `drush`, `drupal`.

If you want to run a single command inside of the container then you don't have to run shell first. Just do it this way:

```
docker-compose run backend_php composer require drupal/devel:~1.0
```

After that commit resulting `composer.json` and `composer.lock` files.

Note that Drush and Drupal Console have to be invoked inside of `web` folder, so you'll have to `cd web` first.
