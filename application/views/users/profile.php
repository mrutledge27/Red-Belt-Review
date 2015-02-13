<html>
<head>
	<title>User Reviews</title>
	<link rel="stylesheet" type="text/css" href="../assets/users/css/index.css">
</head>
<body>
	<?php

	// var_dump($data);

	?>
	<header>
		<ul>
			<li><a href="/books/index">Home</a></li>
			<li><a href="/books/add_view">Add Book and Review</a></li>
			<li><a href="/users/logout">Logout</a></li>
		</ul>
	</header>
	<div id="user_data">
		<h3>User Alias: <?= $data[0]['alias'] ?></h3>
		<h4>Name: <?= $data[0]['name'] ?></h4>
		<h4>Email: <?= $data[0]['email'] ?></h4>
		<h4>Total Reviews: <?= count($data)+1 ?></h4>
	</div>
	<div>
		<h3>Posted Reviews on the following books:</h3>
		<ul>
			<?php

			foreach ($data as $key => $value)
			{
				echo "<li><a href='/books/show/".$value['id']."'>".$value['title']."</a></li>";
			}

			?>
		</ul>
	</div>
</body>
</html>