docker exec mariadb \
    mariadb-import -u root -p  ottoshelttifi < ./backup.sql
