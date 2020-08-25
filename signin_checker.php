<?php
	if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']==TRUE) {
	}
	else{
	echo '<script>window.location.href = "logout"</script>';
	}
?>
