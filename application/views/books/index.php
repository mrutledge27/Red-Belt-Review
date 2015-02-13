<html>
<head>
	<title>Books Home</title>
	<link rel="stylesheet" type="text/css" href="../assets/books/css/index.css">
</head>
<body>
	<?php

	// var_dump($user);
	// var_dump($reviews);

	?>
	<header>
		<h2>Welcome, <?= $user['alias'] ?>!</h2>
		<ul>
			<li><a href="/books/add_view">Add Book and Review</a></li>
			<li><a href="/users/logout">Logout</a></li>
		</ul>
	</header>
	<div id="reviews">
		<h4>Recent Book Reviews:</h4>

		<?php

		for ($i=0;$i<3;$i++)
		{
			echo "<h4><a href='/books/show/".$reviews[$i]['book_id']."'>".$reviews[$i]['title']."</a></h4>".

			"<div><p>Rating: ";

			for ($j=0;$j<5;$j++)
			{
						if ($j < $reviews[$i]['rating'])
						{
							echo "<img src='/assets/images/star.png'>";
						}
						else
						{
							echo "<img src='/assets/images/star_blank.png'>";
						}
			}

			echo "</p><p><span><a href='/users/profile/".$reviews[$i]['user_id']."'>".$reviews[$i]['name']."</a> says: </span>".$reviews[$i]['content']."</p>".
			"<p>Posted on ".$reviews[$i]['created_at']."</p></div>";
		}


		?>

		
	</div>

	<div id="other">
		<h4>Other Books with Reviews</h4>
		<div id="scroll">
			<?php

			for ($i=3;$i<count($reviews);$i++)
			{
				echo "<a href='/books/show/".$reviews[$i]['book_id']."'>".$reviews[$i]['title']."</a>";
			}



			?>

		</div>
	</div>
</body>
</html>