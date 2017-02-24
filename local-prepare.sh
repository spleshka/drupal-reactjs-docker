#!/usr/bin/env bash

# Install composer inside of Gifts Backend.
docker-compose run be_gifts composer install

# Install composer inside of Gifts Backend.
docker-compose run be_donations composer install

# Boot the dev environments.
docker-compose up -d
