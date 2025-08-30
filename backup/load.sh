#!/bin/bash

DB_PASS=$(< ../docker/secrets/db_password.txt)

docker exec -e MYSQL_PWD="$DB_PASS" -i  mariadb \
  mariadb -u root ottoshelttifi < ./backup.sql
