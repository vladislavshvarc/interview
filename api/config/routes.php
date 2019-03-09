<?php
/**
 * Created by IntelliJ IDEA.
 * User: vladislav
 * Date: 3/8/19
 * Time: 12:13 PM
 */

return [
	'GET /'				=> 'voyages/index',
	'POST /'			=> 'voyages/create',
	'PUT <id:\d+>'		=> 'voyages/update',
	'DELETE <id:\d+>'	=> 'voyages/delete'
];