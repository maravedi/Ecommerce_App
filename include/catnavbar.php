<?php
session_start();
?>
<link href="../style/elements.css" rel="stylesheet" type="text/css" media="all">
<div id="catnavbar">
	<center>
		<ul>
			<li><a href="../index.php" target="_parent">Home</a></li>
			<?php
			if (isset($_SESSION['username']) && $_SESSION['type'] == 1) {
				echo '<br/><li><a href="#" onclick="parent.window.frames[\'main\'].location = \'../transactions.php\'">Transactions</a></li><br/>';
				echo '<li><a href="#" onclick="parent.window.frames[\'main\'].location = \'../admin.php\'">Update</a></li><br/>';
			}
			echo '<hr>';
			include_once('../config/dbconfig.php');
			listCategory($connection);
			?>
			<hr>
		</ul>
		<center>
		</div>
		<?php

		function listCategory($connection) {
			$sql = 'SELECT DISTINCT cat_id, category_name FROM category
			WHERE category_name IS NOT NULL
			ORDER BY category_name';

			try {
				$rows = $connection->query($sql);
				foreach ($rows as $row) {
					$options = '<li><a href="#" onclick="parent.window.frames[\'main\'].location = \'categories.php?showProduct=' . $row['cat_id'] . '\'">' . ucwords($row['category_name']) . '</a></li><br/>';
				}
				echo $options;
			} Catch (PDOException $e) {
				echo 'Query failed:' . $e->getMessage();
			}
		}
		?>