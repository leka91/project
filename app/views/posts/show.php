<?php require APPROOT . '/views/inc/header.php'; ?>
<p><a class="btn btn-info" href="<?php echo URLROOT; ?>/posts">Back to Posts page</a></p>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
	Written by: <?php echo $data['post']->name; ?> on <?php echo date('d. M Y, h:s A', strtotime($data['post']->postCreated)); ?>
</div>
<p><?php echo $data['post']->body; ?></p>

<?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
	<hr>
	<a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->postId; ?>" class="btn btn-dark">Edit</a>

	<form class="float-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->postId; ?>" method="post">
		<input type="submit" value="Delete" class="btn btn-danger">
	</form>

<?php endif; ?>


<?php require APPROOT . '/views/inc/footer.php'; ?>