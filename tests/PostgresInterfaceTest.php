<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/24/11
 * Time: 9:13 AM
 * To change this template use File | Settings | File Templates.
 */

require_once 'PHPUnit/Framework/TestCase.php';

require_once("PostgreSqlTestDataManager.php");

class PostgresInterfaceTest extends PHPUnit_Framework_TestCase {

    public function testConnect()
    {
        PostgreSqlTestDataManager::setUpDatabase();
        PostgreSqlTestDataManager::tearDownDatabase();
    }
}
