<h3>Header</h3>
<textarea class="form-control" rows="3" required="required"></textarea>
<script>
	$.get("/admin/api/edit-file.php", {filename: "Views/layout/header.php"},function(data) {
		console.log(data);
	})
</script>