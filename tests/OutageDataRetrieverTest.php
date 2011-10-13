<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/12/11
 * Time: 3:18 PM
 */

define ("TEST_DATA_DATABASE_NAME", "__test_data__");
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

class OutageDataRetrieverTest extends PHPUnit_Framework_TestCase {

    private $db_con = null;

    public function testPass()
    {
        $this->assertTrue(true);
    }

    public function setUp()
    {
        $this->db_con = mysql_connect("localhost", "dev_test", "dev&test");
        $this->ensureTestDataExists();
    }

    public function tearDown()
    {
        mysql_query("DROP DATABASE " . TEST_DATA_DATABASE_NAME . ";");
        mysql_close($this->db_con);
    }

    private function ensureTestDataExists()
    {
        mysql_query("CREATE DATABASE " . TEST_DATA_DATABASE_NAME . ";") or die("ERROR: Unable to create database " . TEST_DATA_DATABASE_NAME . "!");
        mysql_select_db(TEST_DATA_DATABASE_NAME) or die("ERROR: Unable to switch to " . TEST_DATA_DATABASE_NAME . "!");
        mysql_query(OUTAGE_TABLE_DDL) or die("ERROR: Unable to create table!");
        $this->populateData();
    }

    private function populateData()
    {
        $data = array
        (
            // pop, ticket, start_date, end_date, customer_impact, notes_information
            array("pop", "ticket1", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Notes...")
            , array("pop", "ticket2", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Notes...")
            , array("pop", "ticket3", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Notes...")
            , array("pop", "ticket4", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Notes...")
            , array("pop", "ticket5", "0001-01-01 00:00:00", "0001-01-01 00:00:00", "Very impactfull", "Notes...")
        );

        foreach($data as $datum)
        {
            $query = "INSERT INTO Outage
                (pop, ticket, start_date, end_date, customer_impact, notes_information)
                VALUES ('$datum[0]', '$datum[1]','$datum[2]','$datum[3]','$datum[4]','$datum[5]');";
            mysql_query($query);
        }
    }
}

?>