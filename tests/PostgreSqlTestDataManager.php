<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/24/11
 * Time: 9:27 AM
 * To change this template use File | Settings | File Templates.
 */

define ("SIMPLE_TEST_TABLE_DDL", "
    create sequence simple_test_id_seq;
    create table simple_test (
        id int not null unique,
        start_date timestamp not null,
        end_time timestamp not null);
    alter table simple_test alter column id set default nextval('simple_test_id_seq');
    ");

class PostgreSqlTestDataManager {

    public static function setUpDatabase()
    {
        PostgreSqlTestDataManager::executeInOpenDatabase(
            function()
            {
                PostgreSqlTestDataManager::dropDatabase();
                pg_query("CREATE DATABASE " . __PGSQL_DBNAME__ . ";");
            } , __PGSQL_POSTGRES_DB__
        );

        PostgreSqlTestDataManager::executeInOpenDatabase(
            function()
            {
                pg_query(SIMPLE_TEST_TABLE_DDL);
            } , __PGSQL_DBNAME__
        );
    }

    public static function tearDownDatabase()
    {
        PostgreSqlTestDataManager::executeInOpenDatabase(
            function()
            {
                PostgreSqlTestDataManager::dropDatabase();
            } , __PGSQL_POSTGRES_DB__
        );
    }

    public function dropDatabase()
    {
        PostgreSqlTestDataManager::conditionalExecute(
            "SELECT COUNT(*) FROM pg_class WHERE relname ='simple_test_id_seq';",
            "DROP SEQUENCE simple_test_id_seq CASCADE;"
        );

        PostgreSqlTestDataManager::conditionalExecute(
            "SELECT COUNT(*) FROM pg_tables WHERE tablename ='simple_test';",
            "DROP SEQUENCE simple_test_id_seq CASCADE;"
        );

        PostgreSqlTestDataManager::conditionalExecute(
            "SELECT COUNT(*) FROM pg_database WHERE datname = '" . __PGSQL_DBNAME__ . "';",
            "DROP DATABASE " . __PGSQL_DBNAME__ . ";"
        );
    }

    private static function conditionalExecute($cond, $exec)
    {
        $result = pg_query($cond);
        $count = pg_fetch_result($result, 0, 0);
        if($count == 1)
        {
            pg_query($exec);
        }
        pg_free_result($result);
    }

    private static function executeInOpenDatabase($fx, $db_name)
    {
        $db_con = pg_connect(
            "host=" . __PGSQL_HOSTNAME__
            . " dbname=" . $db_name
            . " user=" . __PGSQL_USERNAME__
            . " password=". __PGSQL_PASSWORD__
        );
        $fx();
        pg_close($db_con);
    }
}
