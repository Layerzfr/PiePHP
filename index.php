


	<?php

	define('BASE_URI', str_replace('\\', '/', substr(__DIR__,
		strlen($_SERVER['DOCUMENT_ROOT']))));
	require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));
	$app = new Core\Core();
	$app->run();
	
	?>

	<pre>
		<?php
		print_r($_GET);
		print_r($_POST);
		print_r($_SERVER);
		?>
	</pre>
