


	<?php

	define('BASE_URI', str_replace('\\', '/', substr(__DIR__,
		strlen($_SERVER['DOCUMENT_ROOT']))));
	require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));
	$app = new Core\Core();
	$app->run();
	//$test = new Core\ORM();
	/*$test->create('users',  array(
		'email' => 'test',
		'password' => 'wow'
	)); */
	//$test->read('users', '56');
	/* $test->update('users', 203, array(
		'email' => 'ok',
		'password' => 'test'
	)); */ 
	//$test->delete('users', '94');
	/*$test->find('users', array(
		"WHERE" => "id < 100",
		'ORDER BY' => 'id ASC',
         'LIMIT' => '10'
	));*/
	//$test = new \src\Model\UserModel(202);
	?>

	<pre>
		<?php
		print_r($_GET);
		print_r($_POST);
		print_r($_SERVER);
		?>
	</pre>
