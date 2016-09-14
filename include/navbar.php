<!DOCTYPE html>
<div id="navbar">
	<center>
		<ul>
			<?php
			#session_start();
			###############################
			#		AUTHENTICATED ADMIN
			###############################
			if (isset($_SESSION['username']) && $_SESSION['type'] == 1) {
				echo '<li><a href="logout.php" target="_top">Admin Logout</a></li>';
				?>
				<script>
					window.opener.location.reload();
					window.close();
				</script>
				<?php
			}
			###############################
			#		UNAUTHENTICATED ADMIN
			###############################
			else {
				echo '<li><a href="#" onclick="parent.window.frames[\'main\'].location = \'loginadmin.php\'">Admin Login</a></li>';
			}
			?>
			</a></li>
			<?php
			###############################
			#		AUTHENTICATED CUSTOMER
			###############################
			if (isset($_SESSION['username']) && $_SESSION['type'] == 0) {
				echo '<li><a href="logout.php" target="_top">Customer Logout</a></li>';
				?>
				<script>
					window.opener.location.reload();
					window.close();
				</script>
				<?php
			}
			###############################
			#		UNAUTHENTICATED USER
			###############################
			else {
				echo '<li><a href="#" onclick="parent.window.frames[\'main\'].location = \'login.php\'">Customer Login</a></li>';
			}
			?>
			<li>
				<a href="#" onclick="parent.window.frames['main'].location='register.php'">
					Register
				</a>
			</li>
		</ul>
	</center>
</div>