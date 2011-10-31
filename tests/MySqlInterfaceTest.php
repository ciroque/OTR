<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/21/11
 * Time: 2:37 PM
 */

require_once(dirname(__FILE__) . "/../source/config.php");
 
class MySqlInterfaceTest extends PHPUnit_Framework_TestCase
{
    public function testCallingCloseOnUnopenedInterfaceDoesNotThrow()
    {
        $sql_interface = $this->createMySqlInterfaceInstance();

        $sql_interface->close();
    }

    public function testCallingOpenOnAlreadyOpenInterfaceDoesNotThrow()
    {
        $sql_interface = $this->createMySqlInterfaceInstance();

        $sql_interface->open();
        $sql_interface->open();
    }

    public function testCallingExecuteSqlWithoutExplicitCallToOpenWorks()
    {
        $sql_interface = $this->createMySqlInterfaceInstance();

        MySqlTestDataManager::setUpDatabase();
        $results = $sql_interface->executeSql("SELECT * FROM Outage;");
        MySqlTestDataManager::tearDownDatabase();

        $this->assertNotNull($results);
    }

    private function createMySqlInterfaceInstance()
    {
        $sql_interface = new MySqlInterface(
            __MYSQL_OUTAGE_HOSTNAME__,
            __MYSQL_OUTAGE_DBNAME__,
            __MYSQL_OUTAGE_USERNAME__,
            __MYSQL_OUTAGE_PASSWORD__);
        return $sql_interface;
    }
}
