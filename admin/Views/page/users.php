<style>
	.word-wrap{
		max-width: 10px;
		word-wrap: break-word;
	}
</style>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th></th>
			<th>Username</th>
			<th>Account Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $users = $cAdmin->getListUsers(); ?>
		<?php foreach ($users as $key => $user): ?>
		<tr>
			<td class="text-center"><?php echo$key+1 ?></td>
			<td><?php echo"<a href=\"//fb.com/$user->user_id\" target=\"_blank\">$user->user_name</a>" ?></td>
			<!-- <td class="word-wrap"><?php //echo$user->access_token ?></td> -->
			<?php if ($user->is_admin): ?>
			<td><span class="label label-success">Admin</span></td>
			<td><a class="label label-success">Set User</a></td>
			<?php else: ?>
			<td><span class="label label-default">User</span></td>
			<td><a class="label label-success">Set Admin</a></td>
			<?php endif ?>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>