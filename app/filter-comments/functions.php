<?php
	function showTable($id)
	{
		echo('
			<table id="' . $id . '" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Usename</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		');
	}
?>