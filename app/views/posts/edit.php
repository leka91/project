<?php require APPROOT . '/views/inc/header.php'; ?>
<a class="btn btn-info" href="<?php echo URLROOT; ?>/posts">Back to Posts page</a>
<div class="card card-body bg-light mt-5">
	<h2>Edit Post</h2>
	<form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
		<div class="form-group">
			<label for="title">Title: <sup>*</sup></label>
			<input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>" id="title">
			<span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
		</div>

		<div class="form-group">
			<label for="body">Body: <sup>*</sup></label>
			<textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" id="body"><?php echo $data['body']; ?></textarea>
			<span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
		</div>

		<input type="submit" name="Submit" class="btn btn-success" value="Edit">
	</form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>