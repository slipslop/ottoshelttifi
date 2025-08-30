#!/bin/bash
DB_PASS=$(< ../docker/secrets/db_password.txt)
docker exec -e MYSQL_PWD="$DB_PASS" mariadb \
    mariadb-dump -u root ottoshelttifi > ./backup.sql
