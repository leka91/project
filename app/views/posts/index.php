<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('post_message'); ?>
<div class="row mb-3">
	<div class="col-md-6">
		<h1>Posts</h1>
	</div>
	<div class="col-md-6">
		<a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary float-right">
			Add Post
		</a>
	</div>
</div>

<?php if (empty($data['posts'])) : ?>

<div class="jumbotron jumbotron-fluid text-center">
	<div class="container">
		<h1 class="display-3">No Posts Yet!</h1>
		<p class="lead">When you add Posts, they'll show up here!</p>
	</div>
</div>

<?php endif; ?>

<?php foreach($data['posts'] as $post) : ?>
	<div class="card card-body mb-3">
		<h4 class="card-title"><?php echo $post->title; ?></h4>
		<div class="bg-light p-2 mb-3">
			Written by: <strong><?php echo $post->name; ?></strong> on <?php echo date('d. M Y, h:s A', strtotime($post->postCreated)); ?>
		</div>
		<p class="card-text"><?php echo $post->body; ?></p>
		<a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
	</div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>