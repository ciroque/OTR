<?php
/**
 * Created by JetBrains PhpStorm.
 * User: steve wagner
 * Date: 10/17/11
 * Time: 1:33 PM
 */
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

class MySqlTestDataManager {

    private static $sample_data = array
    (
        // pop, ticket, start_date, end_date, customer_impact, product, notes_information
          array("pop", "ticket1", "0001-01-01 00:00:00", "0001-01-01 01:00:00", "Very impactful", "Product1", "Notes...")
        , array("pop", "ticket2", "0001-01-02 00:00:00", "0001-01-02 01:00:00", "Very impactful", "Product1", "Notes...")
        , array("pop", "ticket3", "0001-01-03 00:00:00", "0001-01-03 01:00:00", "Very impactful", "Product1", "Notes...")

        , array("pop", "ticket4", "0001-01-04 00:00:00", "0001-01-04 01:00:00", "Very impactful", "Product2", "Notes...")
        , array("pop", "ticket4", "0001-01-05 00:00:00", "0001-01-05 01:00:00", "Very impactful", "Product2", "Notes...")

        , array("pop", "ticket5", "0001-01-06 00:00:00", "0001-01-06 01:00:00", "Very impactful", "Product3", "Notes...")
        , array("pop", "ticket5", "0001-01-07 00:00:00", "0001-01-07 01:00:00", "Very impactful", "Product3", "Notes...")
    );

    public static function getDistinctProductNames()
    {
        $names = array();
        foreach(MySqlTestDataManager::$sample_data as $datum)
        {
            $names[] = $datum[5];
        }

        return array_unique($names);
    }

    public static function setUpDatabase()
    {
        MySqlTestDataManager::executeInOpenDatabase(
            function()
            {
                mysql_query(MySqlTestDataManager::getDropStatement());
                MySqlTestDataManager::ensureTestDataExists();
            });
    }

    public static function tearDownDatabase()
    {
        MySqlTestDataManager::executeInOpenDatabase(
            function()
            {
                mysql_query(MySqlTestDataManager::getDropStatement());
            });
    }

    public static function getDropStatement()
    {
        return "DROP DATABASE " . __MYSQL_OUTAGE_DBNAME__ . ";";
    }

    public static function ensureTestDataExists()
    {
        mysql_query("CREATE DATABASE " . __MYSQL_OUTAGE_DBNAME__ . ";") or die("ERROR: Unable to create database " . __MYSQL_OUTAGE_DBNAME__ . "!");
        mysql_select_db(__MYSQL_OUTAGE_DBNAME__) or die("ERROR: Unable to switch to " . __MYSQL_OUTAGE_DBNAME__ . "!");
        mysql_query(OUTAGE_TABLE_DDL) or die("ERROR: Unable to create table!");
        MySqlTestDataManager::populateData();
    }

    private static function populateData()
    {
        foreach(MySqlTestDataManager::$sample_data as $datum)
        {
            $query = "INSERT INTO Outage
                (pop, ticket, start_date, end_date, customer_impact, product, notes_information)
                VALUES ('$datum[0]', '$datum[1]', '$datum[2]', '$datum[3]', '$datum[4]', '$datum[5]', '$datum[6]');";
            mysql_query($query);
        }
    }

    private static function executeInOpenDatabase($fx)
    {
        $db_con = mysql_connect(__MYSQL_OUTAGE_HOSTNAME__, __MYSQL_OUTAGE_USERNAME__, __MYSQL_OUTAGE_PASSWORD__);
        $fx();
        mysql_close($db_con);
    }
}
