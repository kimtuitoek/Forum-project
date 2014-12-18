<?php?>

<script>
function back() {
    window.history.back()
}
</script>

<script>
function far_back_delete(String a) {
	<?php ?>
	header ( "Location: " . "delete.php?obj=" . a );
	die ( "Redirecting to: " . "delete.php?obj=" . a );
}
</script>