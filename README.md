# site-metrics

Before running this plugin, run these scripts in the following order to create the SQL user and database required by the software:

1) createUser.sql
2) createDB.sql

To use this scripts, from the command line input the following commands in order:

1) mysql -u root -p < createUser.sql
2) mysql -u root -p < createDB.sql

To remove the database from your system, run the following script:

resetDB.sql

NOTE: this script does NOT remove the db user created by createUser.sql
