<html>
<head>
	<title>Add Book and Review</title>
	<link rel="stylesheet" type="text/css" href="/assets/books/css/show.css">
</head>
<body>

	<?php
		// var_dump($reviews);
	?>

	<header>
		<ul>
			<li><a href="/books/index">Home</a></li>
			<li><a href="/users/logout">Logout</a></li>
		</ul>
	</header>
	<h3>
		<?=
			$reviews[0]['title'];
		?>
	</h3>
	<h4>Author: 
		<?=
			$reviews[0]['name'];
		?>
	</h4>

	<div id="reviews">
		<h3>Reviews:</h3>

		<?php


		foreach ($reviews[1] as $key => $value)
		{?>
			<div>
				<p>Rating: 
			<?php for ($i=0;$i<5;$i++)
					{
						if ($i < $value['rating'])
						{
							echo "<img src='/assets/images/star.png'>";
						}
						else
						{
							echo "<img src='/assets/images/star_blank.png'>";
						}
					}?>
				</p>
				<p><span><?=

				'<a href="/users/profile/'.$value["id"].'">'.$value["name"].'</a>' ?> says: </span>
				<?= $value['content']; ?> </p>
				<p>Posted on <?= $value['created_at'] ?></p>
				<?php
				if ($value['id'] == $this->session->userdata('id'))
				{
					echo "<a href='/books/delete/".$value['review_id']."'>Delete this Review</a>";
				}
				?>
			</div>
	<?php	}


		?>


	</div>
	<div id="add_review">
		<form action=
		<?= '"/books/add/'. $reviews[0]['id'].'"'  ?>
		method="post">
			<h5>Add a Review:</h5>
			<textarea name="content"></textarea>
			<label>Rating: 
				<select name="rating">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				stars.
			</label>
			<input type="submit" value="Submit Review">
			<input type="hidden" name="title" value= <?= '"'.$reviews[0]['title'].'"' ?> >
			<input type="hidden" name="author" value= <?= '"'.$reviews[0]['name'].'"' ?> >
	</div>
</body>
</html>