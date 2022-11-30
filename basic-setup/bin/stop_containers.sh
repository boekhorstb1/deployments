#!/bin/bash

## If we have a .credentials file, source it
source ".env" || exit
docker container stop \
"${PREFIX_CONTAINER}horde_db" \
"${PREFIX_CONTAINER}horde_web" \


