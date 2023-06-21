<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>News</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/7562-200.png" rel="icon">
  <link href="assets/img/7562-200.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizPage
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <style>
        .fixed-top {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 9999;
    }
  </style>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container-fluid">

      <div class="row justify-content-center align-items-center">
        <div class="col-xl-11 d-flex align-items-center justify-content-between">
          <h2 class="logo"><a href="index.php"><a href="index.php" class="logo"><img src="assets/img/logo-no-background.svg" alt="" class="img-fluid"></a></a>          <!-- Uncomment below if you prefer to use an image logo -->
</h2>

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
              <li><a class="nav-link  " href="news.php">News</a></li>
              <li><a class="nav-link  " href="jobs.php">Jobs</a></li>
              <li><a class="nav-link  " href="events.php">Events</a></li>
              <li class="dropdown"><a href="publish.php"><span>Publish</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a class="nav-link scrollto" href="publish.php#articles">Post Articles</a></li>
                  <li><a class="nav-link scrollto" href="publish.php#jobs">Post Jobs</a></li>
                  <li><a class="nav-link scrollto" href="publish.php#events">Post Events</a></li>

                </ul>
              </li>
              <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
        </div>
      </div>

    </div>
  </header><!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
          <h1>Welcome to our News Page</h1>
          <h2>Stay updated with the latest Healthcare Technology news and updates</h2>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="index.php">Home</a></li>
        </ol>
        <h2>News</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      
      <div class="sidebar-item container" data-aos="fade-up" >
      <div class="search">
  <div class="row">
    <div class="col-md-6">
      <div class="search-1">
        <i class="bi bi-file-earmark-text"></i>
        <input id="title-input" type="text" placeholder="Title">
      </div>
    </div>
    <div class="col-md-6">
      <div>
        <div class="search-2">
          <i class='bi bi-person'></i>
          <input id="author-input" type="text" placeholder="Author">
          <button id="search-button">Search</button>
        </div>
      </div>
    </div>
  </div>
</div>
        <div class="search-form input-group mb-3" style="margin-bottom: 25px;">


        <div class="row">



        <div class="col-lg-8 entries">
        <div id="articles-container" class="col-lg-12 entries">
          <?php
          $newsData = file_get_contents('data.json'); // Read the JSON file
          $newsItems = json_decode($newsData, true); // Decode the JSON data into an associative array

          // Loop through each news item and generate the HTML markup
          foreach ($newsItems as $news) {
            $title = $news['title'];
            $content = $news['content'];
            $author = $news['author'];
            $date_published = $news['date_published'];
          ?>
            <article class="entry">
              <div class="entry-img">
                <img src="assets/img/blog-1.jpg" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="#"><?php echo $title; ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center">
                    <i class="bi bi-person"></i> <?php echo $author; ?>
                  </li>
                  <li class="d-flex align-items-center">
                    <i class="bi bi-clock"></i> <?php echo $date_published; ?>
                  </li>
                </ul>
              </div>

              <div class="entry-content">
              <p>
  <?php
    $contentWords = explode(" ", $content);
    $shortContent = implode(" ", array_slice($contentWords, 0, 25));
    echo $shortContent;
    if (count($contentWords) > 25) {
      echo "...";
    }
  ?>
</p>

                <div class="read-more">
                <a href="news-single.php?id=<?php echo $news['id']; ?>" class="btn btn-primary">Read More</a>

                </div>
              </div>
            </article>
          <?php
          }
          ?>
        </div>

        </div>


          <div class="col-lg-4">

            <div class="sidebar">


              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">
                <?php
  $recentArticles = array_slice($newsItems, 0, 3); // Get the three most recent articles

  foreach ($recentArticles as $article) {
    $title = $article['title'];
    $datePublished = $article['date_published'];
  ?>
    <div class="post-item clearfix">
      <h4><a href="#"><?php echo $title; ?></a></h4>
      <time datetime="<?php echo $datePublished; ?>"><?php echo $datePublished; ?></time>
    </div>
  <?php
  }
  ?>


              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">Dates</h3>
              <div class="sidebar-item tags">
                <ul id="date-tags">
                  <!-- Add the following PHP code to generate the date tags dynamically -->
                  <?php
                  $currentDate = strtotime(date('Y-m-d')); // Get the current date
                  $dateFormat = 'Y-m-d'; // Specify the date format
                  for ($i = 0; $i < 11; $i++) {
                    $date = date($dateFormat, strtotime("-$i day", $currentDate)); // Get the date for the current iteration
                  ?>
                    <li><a href="#" onclick="searchByDate('<?php echo $date; ?>')"><?php echo $date; ?></a></li>
                  <?php
                  }
                  ?>
                </ul>
              </div><!-- End sidebar tags-->


            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3><a href="index.php"><a href="index.php" class="logo"><img style="filter: invert(100%);" src="assets/img/7562-200.png" alt="" class="img-fluid"></a></h3>
            <p></p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="publish.html">Publish</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#contact">Contact</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Guelph, Ontario <br>
              <strong>Email:</strong> info@hcsdevelopers.com<br>
            </p>

            <!-- <div class="social-links">
              <a href="https://ca.linkedin.com/company/hcs-developers?trk=public_jobs_topcard_logo" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div> -->

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Admin</h4>
            <p></p>
            <form action="admin.php" method="post">
              <input type="submit" value="Log In">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>BizPage</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
      -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <script>
document.getElementById("search-button").addEventListener("click", function() {
  var titleInput = document.getElementById("title-input").value;
  var authorInput = document.getElementById("author-input").value;
  searchArticles(titleInput, authorInput);
});

function searchArticles(title, author) {
  var articlesContainer = document.getElementById("articles-container");
  articlesContainer.innerHTML = ""; // Clear previous search results

  var newsData = <?php echo json_encode($newsItems); ?>;

  for (var i = 0; i < newsData.length; i++) {
    var news = newsData[i];
    var articleTitle = news['title'];
    var articleContent = news['content'];
    var articleAuthor = news['author'];

    // Filter articles based on title and author
    if ((title === "" || articleTitle.toLowerCase().includes(title.toLowerCase())) &&
        (author === "" || articleAuthor.toLowerCase().includes(author.toLowerCase()))) {

      // Generate HTML markup for each article
      var articleHTML = `
        <article class="entry">
          <div class="entry-img">
            <img src="assets/img/blog-1.jpg" alt="" class="img-fluid">
          </div>
          <h2 class="entry-title">
            <a href="#">${articleTitle}</a>
          </h2>
          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center">
                <i class="bi bi-person"></i> ${articleAuthor}
              </li>
              <li class="d-flex align-items-center">
                <i class="bi bi-clock"></i> ${news['date_published']}
              </li>
            </ul>
          </div>
          <div class="entry-content">
            <p>${articleContent}</p>
            <div class="read-more">
              <a href="#">Read More</a>
            </div>
          </div>
        </article>
      `;
      articlesContainer.innerHTML += articleHTML; // Append article HTML to container
    }
  }
}

</script>
<script>
  function searchByDate(date) {
  var articlesContainer = document.getElementById("articles-container");
  articlesContainer.innerHTML = ""; // Clear previous search results

  var newsData = <?php echo json_encode($newsItems); ?>;

  for (var i = 0; i < newsData.length; i++) {
    var news = newsData[i];
    var articleDate = news['date_published'];

    // Filter articles based on the selected date
    if (articleDate === date) {
      // Generate HTML markup for each article
      var articleHTML = `
        <article class="entry">
          <div class="entry-img">
            <img src="assets/img/blog-1.jpg" alt="" class="img-fluid">
          </div>
          <h2 class="entry-title">
            <a href="#">${news['title']}</a>
          </h2>
          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center">
                <i class="bi bi-person"></i> ${news['author']}
              </li>
              <li class="d-flex align-items-center">
                <i class="bi bi-clock"></i> ${news['date_published']}
              </li>
            </ul>
          </div>
          <div class="entry-content">
            <p>${news['content']}</p>
            <div class="read-more">
              <a href="#">Read More</a>
            </div>
          </div>
        </article>
      `;
      articlesContainer.innerHTML += articleHTML; // Append article HTML to container
    }
  }
}
</script>
              

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>