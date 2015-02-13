<html>
<head>
	<title>Add Book and Review</title>
	<link rel="stylesheet" type="text/css" href="../assets/books/css/add.css">
</head>
<body>
	<?php

	// var_dump($authors);

	?>
	<header>
		<ul>
			<li><a href="/books/index">Home</a></li>
			<li><a href="/users/logout">Logout</a></li>
		</ul>
	</header>
	<h4>Add a New Book Title and a Review:</h4>
	<form action="/books/add" method="post">
		<label>Book Title: <input type="text" name="title"></label>
		<label>Author: 

			<label>Choose from the list: 
				<select name="author">

					<?php

					foreach ($authors as $key => $value)
					{
						echo "<option value='".$value['name']."'>".$value['name']."</option>";
					}


					?>
				</select>
			</label>
			<label>Or add a new author: 
				<input type="text" name="new_author">
			</label>
			<label>
				<textarea name="content"></textarea>
			</label>
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
		</label>
		<input type="submit" value="Add Book and Review">
		<input type="hidden" name="" value="">
	</form>
</body>
</html>