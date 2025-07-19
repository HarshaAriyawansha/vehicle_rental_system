<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'employees';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`u`.`id`', 'dt' => 'id', 'field' => 'id' ),
	array( 'db' => '`u`.`emp_id`', 'dt' => 'emp_id', 'field' => 'emp_id' ),
	array( 'db' => '`u`.`emp_fp_id`', 'dt' => 'emp_fp_id', 'field' => 'emp_fp_id' ),
	array( 'db' => '`u`.`emp_name_with_initial`', 'dt' => 'emp_name_with_initial', 'field' => 'emp_name_with_initial' ),
	array( 'db' => '`u`.`calling_name`', 'dt' => 'calling_name', 'field' => 'calling_name' ),
	array( 'db' => '`u`.`emp_etfno`', 'dt' => 'emp_etfno', 'field' => 'emp_etfno' ),
	array( 'db' => '`br`.`branch`', 'dt' => 'branch', 'field' => 'branch' ),
	array( 'db' => '`u`.`service_no`', 'dt' => 'service_no', 'field' => 'service_no' ),
	array( 'db' => '`u`.`emp_join_date`', 'dt' => 'emp_join_date', 'field' => 'emp_join_date' ),
	array( 'db' => '`dep`.`department_name`', 'dt' => 'department_name', 'field' => 'department_name' ),
	array( 'db' => '`jt`.`jobtitle`', 'dt' => 'jobtitle', 'field' => 'jobtitle' ),
	array( 'db' => '`st`.`emp_status`', 'dt' => 'emp_status', 'field' => 'emp_status' ),
	array( 'db' => '`u`.`emp_mobile`', 'dt' => 'emp_mobile', 'field' => 'emp_mobile' ),
	array( 'db' => '`us`.`email`', 'dt' => 'email', 'field' => 'email' ),
	array( 'db' => '`us`.`emp_password`', 'dt' => 'emp_password', 'field' => 'emp_password' ),
);

// SQL server connection information
require('config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

$department = $_POST['department'];
$employee = $_POST['employee'];
$location = $_POST['location'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

$joinQuery = "FROM `attendances` AS `u`
			Inner JOIN `employees` AS `emp` ON `u`.`uid`=`emp`.`emp_fp_id`
			LEFT JOIN `shift_types` AS `sf` ON `emp`.`emp_shift`=`sf`.`id`
			LEFT JOIN `tbl_company_branch` AS `br` ON `br`.`idtbl_company_branch`=`u`.`location`";

$extraWhere = "`u`.`deleted` IN (0) AND `u`.`is_resigned` IN (0)";

if ($from_date != '' && $to_date != '') {
    $extraWhere .= " AND `u`.`emp_join_date` BETWEEN '$from_date' AND '$to_date'";
}

if ($department != '') {
    $extraWhere .= " AND `u`.`emp_department`='$department'";
}

if ($employee != '') {
    $extraWhere .= " AND `u`.`id`='$employee'";
}

if ($location != '') {
    $extraWhere .= " AND `u`.`emp_branch`='$location'";
}

echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);

