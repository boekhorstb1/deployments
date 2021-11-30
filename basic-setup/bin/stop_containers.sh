#!/bin/bash

## If we have a .credentials file, source it
source ./.env || exit

docker container stop \
"${CONTAINER_PREFIX}horde_db" \
"${CONTAINER_PREFIX}horde_web" \

