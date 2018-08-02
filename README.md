# Newer version is available!

There's a newer version of a boilerplate avaialble at https://github.com/systemseed/drupal_reactjs_boilerplate. It has many more features & server side rendering support.

# What is this project for?

It's a really quick start for **LOCAL** development of ReactJS + Drupal 8 applications.

As the result of configuration, you'll get:
- Working and ready for development ReactJS application
- Working and ready for development Drupal 8 application
- UI to access Drupal database
- UI to access all emails rerouted from php (apart from emails sent through SMTP)

# Advantages of this project

- You don't need to have `composer` on `npm` installed locally. Everything is being done though Docker containers.
- You don't depend on versions of `composer` or `npm` installed at dev environments of your team members.
- Docker configuration for Drupal is based on [docker4drupal](http://docker4drupal.org) containers. It provides very good flexibility for Docker-based local development. If you need more containers (i.e. for `memcached`, `redis`, `solr`, etc) - just check out what they offer.
- Drupal configuration is based on [drupal-composer/drupal-project](https://github.com/drupal-composer/drupal-project) project which provides best dev experience in working with Drupal through `composer`.
- ReactJS application bootstrapped with [Create React App](https://github.com/facebookincubator/create-react-app) - minimal & clean start for ReactJS development.
- Human readable local host names. No more ugly `localhost:PORT` stuff.

# Dependencies

All you need to have is [Docker](https://docs.docker.com/engine/installation/) and [Docker Compose](https://docs.docker.com/compose/install/) installed. That's it.

# Hosts

At the end of configuration journey you'll get the following hosts available:

| URL                                          | Name                |
| -------------------------------------------- | ------------------- |
| http://app.docker.localhost:8000/            | ReactJS application |
| http://drupal.docker.localhost:8000/         | Drupal 8            |
| http://pma.drupal.docker.localhost:8000/     | PhpMyAdmin          |
| http://mailhog.drupal.docker.localhost:8000/ | Mailhog             |

If you want, you can go further and configure `traefik` in `docker-compose.yml` file to get rid of `8000` port.
As well as that, you can add custom hosts to your `/etc/hosts` file (for example, `127.0.0. 1 app.local`), reconfigure `traefik` to use these hosts in `docker-compose.yml` and eventually get beautiful URLs.

# Getting started

1. Download this repo to your local machine:

    ```
    git clone git@github.com:spleshka/drupal-reactjs-docker.git
    ```

2. Bootstrap Docker containers listed in `docker-compose.yml` file:

    ```
    docker-compose up -d
    ```

    During the process all necessary containers will be downloaded.
    As well as that, `npm install` will be invoked to build ReactJS dependencies inside of Docker container.
    This process may take 1-2 minutes.
    It means that `http://app.docker.localhost:8000/` will not be reachable until that (you'll see nginx error).

    You DON'T need to have `npm` installed locally.

3. At this point `./drupal` folder is still empty. Let's get it fixed:

    ```
    sudo rm drupal/.gitkeep
    docker-compose run backend_php composer create-project drupal-composer/drupal-project:8.x-dev . --stability dev --no-interaction -vvv
    ```

    All we do here is downloading Drupal with its dependencies using `backend_php` container.
    The installation might take around 5 minutes. No worries, it's expected.
    Check out [Drupal Project](https://github.com/drupal-composer/drupal-project) for development guideline.

    You DON'T need to have `composer` installed locally.

4. It's all done now! You may try accessing any host listed in the `Hosts` section of this manual. 

5. As the final step you'd probably want to commit everything to your own repository.
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

Alternatively, you might use the following command to run `drush` or `drupal` CLI outside of Docker container:
 
```
docker-compose run backend_php drush --root="./web/" <COMMAND>
```

If this command seems to be too long to type every time, consider adding it to the list of your bash aliases:
 
```
alias dockerdrush=docker-compose run backend_php drush --root="./web/"
```

Then you'll be able to do something like this:

```
dockerdrush cr
```
