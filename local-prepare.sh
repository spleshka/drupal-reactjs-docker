#!/usr/bin/env bash

# Install composer inside of container with Drupal.
docker-compose run backend_php composer install

# Boot the dev environments.
docker-compose up -d
