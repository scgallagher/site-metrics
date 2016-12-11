# site-metrics

Before running this plugin, run these scripts in the following order to create the SQL user and database required by the software:

1) createDB.sql<br>
2) createUser.sql<br>

To use this scripts, from the command line input the following commands in order:

1) mysql -u root -p < createDB.sql<br>
2) mysql -u root -p < createUser.sql<br>

To remove the database from your system, run the following script:

resetDB.sql

NOTE: this script does NOT remove the db user created by createUser.sql

Make sure the following extensions are enabled (uncommented) in php.ini

extension=php_curl.dll<br>
extension=php_pdo_mysql.dll
