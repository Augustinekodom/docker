<?php
require 'setup.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>

	

		<nav>
			<ul>
				<?php
				$stmt = $pdo->prepare('SELECT * FROM article order by publishDate DESC LIMIT 1;');
				$stmt->execute();

				$articles = $stmt->fetch();
				$article_id = $articles['id'];
				
				?>
				
				<li><a href="article.php?id=<?php echo $article_id; ?>">Latest Articles</a></li>
				<li><a href="#">Select Category</a>
					<ul>
						<?php
						//Collect the id of the last article posted 
						$stmt = $pdo->prepare('SELECT id, category_name FROM categories');
						$stmt->execute();
						while ($categories = $stmt->fetch()) {
						echo '<li><a class="articleLink" href="category.php?id=' . $categories['id'] . '">' . $categories['category_name'].'</a></li>';
						}
			
						?>
						
					</ul>
				</li>
			</ul>
		</nav>


		
		<img src="images/banners/randombanner.php" />
		<main>
			<!-- Delete the <nav> element if the sidebar is not required -->

			
