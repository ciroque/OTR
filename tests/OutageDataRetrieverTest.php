<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/12/11
 * Time: 3:18 PM
 */

require_once(dirname(__FILE__) . "/../source/OutageDataRetriever.php");
require_once(dirname(__FILE__) . "/../source/MeanTimeBetweenFailuresOutageDataRetriever.php");
require_once(dirname(__FILE__) . "/../source/OutageData.php");

define ("OUTAGE_TABLE_DDL", "create table Outage
(
	id int(9) not null primary key AUTO_INCREMENT,
	severity int(3) NOT NULL default 0,
	pop varchar(30) not null,
	subject tinytext null,
	issue mediumtext null,
	ticket varchar(30) not null,
	updates longtext null,
	start_date datetime not null,
	end_date datetime not null,
	update_date datetime not null,
	expected_update datetime not null,
	external_visible tinyint(3) not null default 3,
	revenue_impact tinyint(3) not null default 3,
	capping_impact tinyint(3) not null default 3,
	report_impact tinyint(3) not null default 3,
	work_event varchar(30) not null default 'NOC',
	customer_impact text not null,
	cause mediumtext null,
	product varchar(120) not null default 'TBD',
	files mediumblob not null,
	event_time varchar(30) null,
	total_time varchar(30) null,
	requires_data tinyint(3) not null default 3,
	notes_information text not null,
	restore mediumtext null
);");

/**
 * Tests for OutageDataRetriever
 */
class OutageDataRetrieverTest extends PHPUnit_Framework_TestCase {

    private static $sample_data = array
    (
        // pop, ticket, start_date, end_date, customer_impact, product, notes_information
        array("pop", "ticket1", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Product1", "Notes...")
        , array("pop", "ticket2", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Product1", "Notes...")
        , array("pop", "ticket3", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Product1", "Notes...")
        , array("pop", "ticket4", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Product2", "Notes...")
        , array("pop", "ticket5", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Product3", "Notes...")
    );

    /**
     * @return void
     */
    public function testMeanTimeBetweenFailuresOutageDataRetriever()
    {
        $retriever = new MeanTimeBetweenFailuresOutageDataRetriever();
        $retrieved = $retriever->retrieve();

        $this->assertEquals(5, $retrieved->getRowCount());

        $results = $retrieved->getResults();
        $this->assertEquals(2, sizeof($results[0]));

        $this->assertNotNull($results[0]["start_date"]);
        $this->assertNotNull($results[0]["end_date"]);
    }

    public static function setUpBeforeClass()
    {
        $db_con = mysql_connect(__MYSQL_HOSTNAME__, __MYSQL_USERNAME__, __MYSQL_PASSWORD__);
        mysql_query("DROP DATABASE " . __MYSQL_DBNAME__ . ";");
        OutageDataRetrieverTest::ensureTestDataExists();
        mysql_close($db_con);
    }

    public static function tearDownAfterClass()
    {
        $db_con = mysql_connect(__MYSQL_HOSTNAME__, __MYSQL_USERNAME__, __MYSQL_PASSWORD__);
        mysql_query("DROP DATABASE " . __MYSQL_DBNAME__ . ";");
        mysql_close($db_con);
    }

    private static function ensureTestDataExists()
    {
        mysql_query("CREATE DATABASE " . __MYSQL_DBNAME__ . ";") or die("ERROR: Unable to create database " . __MYSQL_DBNAME__ . "!");
        mysql_select_db(__MYSQL_DBNAME__) or die("ERROR: Unable to switch to " . __MYSQL_DBNAME__ . "!");
        mysql_query(OUTAGE_TABLE_DDL) or die("ERROR: Unable to create table!");
        OutageDataRetrieverTest::populateData();
    }

    private static function populateData()
    {
        foreach(OutageDataRetrieverTest::$sample_data as $datum)
        {
            $query = "INSERT INTO Outage
                (pop, ticket, start_date, end_date, customer_impact, product, notes_information)
                VALUES ('$datum[0]', '$datum[1]', '$datum[2]', '$datum[3]', '$datum[4]', '$datum[5]', '$datum[6]');";
            mysql_query($query);
        }
    }
}

?>