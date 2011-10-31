<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/13/11
 * Time: 9:22 AM
 *
 * Master configuration file for the framework.
 */

/* ***************************************************************************
 *  The MySQL configuration parameters.
 */
define("__MYSQL_OUTAGE_HOSTNAME__", "localhost");
define("__MYSQL_OUTAGE_DBNAME__", "__test_data__");
define("__MYSQL_OUTAGE_USERNAME__", "dev_test");
define("__MYSQL_OUTAGE_PASSWORD__", "dev&test");

/* ***************************************************************************
 *  The PostgreSQL configuration parameters.
 */
define("__PGSQL_HOSTNAME__", "localhost");
define("__PGSQL_DBNAME__", "__test_data__");
define("__PGSQL_USERNAME__", "dev_test");
define("__PGSQL_PASSWORD__", "dev&test");
define("__PGSQL_POSTGRES_DB__", "postgres");

/* ***************************************************************************
 *  General configuration parameters.
 */
define("__EPOCH__", "0001-01-01 00:00:00");
?>