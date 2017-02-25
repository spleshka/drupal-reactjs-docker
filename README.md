# What is this project for?

It's a really fast & great start for local development of reactjs + Drupal 8 applications.
As the result of configuration, you will have:
- Working and ready for development ReactJS application running at `http://example.local`
- Working and ready for development Drupal 8 application running at `http://api.example.local`
- UI to access Drupal database running at `http://pma.example.local`
- Access to all emails rerouted from php (apart from emails sent through SMTP) running at `http://emails.example.local`

# Advantages of this project

- You don't need to have `composer` on `npm` installed locally. Everything is being done though Docker containers.
- You don't depend on versions of `composer` or `npm` installed inside of dev environments of your team members.
- The configuration is mainly based on `docker4drupal.org` Docker containers with really flexible configuration.
- Drupal configuration is based on `https://github.com/drupal-composer/drupal-project` project which provides best dev experience in working with Drupal through `composer`.
- Human readable local host names. No more ugly `localhost:PORT` stuff. Thanks to `https://github.com/jwilder/nginx-proxy`
- ReactJS application bootstrapped with `https://github.com/facebookincubator/create-react-app` - minimal & clean start for development.

## Getting started

1. Download this repo to your local environment:

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
    
    At this point you might already get the feeling of what will be the final result of set up.

3. Bootstrap docker containers listed in `docker-compose.yml` file:

    ```
    docker-compose up -d
    ```

    During the process all necessary containers will be downloaded. As well as that, `npm install` will be invoked to build reactjs dependencies inside of docker image.
    You DON'T need to have `npm` installed locally. This process may take several minutes.

4. At this point `./drupal` folder is still empty. Let's get it fixed:

    ```
    docker-compose run backend_php composer create-project drupal-composer/drupal-project:8.x-dev . --stability dev --no-interaction -vvv
    ```

    All we do here is downloading Drupal with its dependencies inside of `backend_php` container.
    You DON'T need to have `composer` installed locally.
    The installation might take around 5 minutes. No worries, it's expected.
    Please refer to `https://github.com/drupal-composer/drupal-project` for additional info.

5. Go ahead and open any host listed in step #2. You're ready to go!


## Shutting down the environments

To shut the environment run `docker-compose stop`.
It's also possible to shut it using `docker-compose down`, but the latter option will drop Drupal database.
Read more [here](https://github.com/wodby/docker4drupal/blob/master/CHANGELOG.md#action-required-before-upgrading)


## What needs to be commited to my own repository?

Everything not specified in `.gitignire`. It's actually safe to run `git add -A` and commit it.


## Making changes to Nodejs stack

If you want to make a change to `package.json` inside of any frontend application, then make this change as desired, then run:

```
# Rebuilding docker image with latest changes in package.json
docker-compose build frontend

# Tell Docker to use recently updated image.
docker-compose up -d
```
