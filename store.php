<?php 
session_start();



# Database Connection File
include "db_conn.php";

# Book helper function
include "php/func-book.php";
$books = get_all_books($conn);

# author helper function
include "php/func.author.php";
$authors = get_all_author($conn);

# Category helper function
include "php/func-category.php";
$category = get_all_category($conn);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Book Store</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/store.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="index.php">Online Book Store</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <li class="nav-item">
    <a class="nav-link active" href="index.php">
        <i class="fas fa-house"></i> Home
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="contact.php">
        <i class="fas fa-phone"></i> Contact
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="about.php">
        <i class="fas fa-circle-info"></i> About
    </a>
</li>

<?php if (!isset($_SESSION['user_id'])) { ?>

<li class="nav-item">
    <a class="nav-link" href="register.php">
        <i class="fas fa-user-plus"></i> Register
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="user_login.php">
        <i class="fas fa-right-to-bracket"></i> User Login
    </a>
</li>

<?php } else { ?>

<li class="nav-item">
    <a class="nav-link text-warning" href="logout2.php">
        <i class="fas fa-right-from-bracket"></i> Logout
    </a>
</li>

<?php } ?>

<li class="nav-item">
    <a class="nav-link" href="login.php">
        <i class="fas fa-user-shield"></i> Admin
    </a>
</li>

<?php  ?>



		      </ul>
		    </div>
		  </div>
		</nav>
		<!-- Hero Section -->
<div class="hero-section">
    <h1><i class="fas fa-book-open"></i> Welcome to Digital Library & E-Book Store</h1>
    <p>
        Discover thousands of books from different categories.
        Read online or download your favorite books anytime.
    </p>
</div>

<!-- Statistics -->
<div class="row text-center mb-4">
    <div class="col-md-4">
        <div class="stat-box">
            <i class="fas fa-book fa-2x"></i>
            <h3><?=count($books)?></h3>
            <p>Books</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-box">
            <i class="fas fa-user-edit fa-2x"></i>
            <h3><?=count($authors)?></h3>
            <p>Authors</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-box">
            <i class="fas fa-list fa-2x"></i>
            <h3><?=count($category)?></h3>
            <p>Categories</p>
        </div>
    </div>
</div>

<form action="search.php"
      method="get"
      class="search-box">

    <div class="input-group my-5">

        <input type="text"
               class="form-control"
               name="key"
               placeholder="Search books...">

        <button class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>

    </div>

</form>
		</div>
       </form>
		<div class="d-flex pt-3">
			<?php if ($books == 0){ ?>
				<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			    There is no book in the database
		       </div>
			<?php }else{ ?>
			<div class="pdf-list d-flex flex-wrap">
				<?php foreach ($books as $book) { ?>
				<div class="card m-1">
					<img src="upload/cover/<?=$book['cover']?>"
					     class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">
							<?=$book['title']?>
						</h5>
						<p class="card-text">
							<i><b>By:
								<?php foreach($authors as $author){ 
									if ($author['id'] == $book['author_id']) {
										echo $author['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
							<?=$book['description']?>
							<br><i><b>Category:
								<?php foreach($category as $cat){ 
									if ($cat['id'] == $book['category_id']) {
										echo $cat['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
						</p>
       <div class="d-flex justify-content-between mt-3">

<a href="upload/file/<?=$book['file']?>"
class="btn btn-success">
<i class="fas fa-book-open"></i> Read
</a>

<a href="download.php?file=<?=$book['file']?>"
class="btn btn-primary">
<i class="fas fa-download"></i> Download
</a>

</div>
					</div>
				</div>
				<?php } ?>
			</div>
		<?php } ?>

		<div class="category">
			<!-- List of categories -->
			<div class="list-group">
				<?php if (empty($category == 0)){
					// do nothing
				}else{ ?>
				<a href="#"
				   class="list-group-item list-group-item-action active">Category</a>
				   <?php foreach ($category as $cat ) {?>
				  
				   <a href="category.php?id=<?=$cat['id']?>"
				      class="list-group-item list-group-item-action">
				      <?=$cat['name']?></a>
				<?php } } ?>
			</div>

			<!-- List of authors -->
			<div class="list-group mt-5">
				<?php if ($authors == 0){
					// do nothing
				}else{ ?>
				<a href="#"
				   class="list-group-item list-group-item-action active">Author</a>
				   <?php foreach ($authors as $author ) {?>
				  
				   <a href="author.php?id=<?=$author['id']?>"
				      class="list-group-item list-group-item-action">
				      <?=$author['name']?></a>
				<?php } } ?>
			</div>
		</div>
		</div>
	</div>

	<footer class="footer text-center">

    <h4>Digital Library & E-Book Store</h4>

    <p>
        Read • Learn • Download
    </p>

    <hr>

    <p>
        © 2026 Digital Library & E-Book Store
    </p>

    <p>
        Developed by <strong>Shurayb and Aamin</strong>
    </p>

</footer>
</body>
</html>