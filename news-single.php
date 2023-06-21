<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>News Single</title>
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
              <li class="dropdown"><a href="#"><span>Publish</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="#">Post Articles</a></li>
                  <li><a href="#">Post Jobs</a></li>
                  <li><a href="#">Post Events</a></li>

                </ul>
              </li>
              <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li><a href="news.php">News</a></li>
        </ol>
        <h2>News Single</h2>

      </div>
    </section><!-- End Breadcrumbs -->

  <!-- ======= News Single Section ======= -->
  <section id="News" class="News">
    <div class="container" data-aos="fade-up">

      <div class="row justify-content-center">

        <div class="col-lg-20 entries">

          <article class="entry entry-single">

            <!-- ...previous code... -->

            <?php
            // Retrieve news data from data.json file
            $newsData = file_get_contents('data.json');
            $newsArray = json_decode($newsData, true);

            // Check if the news ID is provided in the query parameter
            if (isset($_GET['id'])) {
              $newsId = $_GET['id'];

              // Find the news item with the provided ID
              $newsItem = array_filter($newsArray, function ($item) use ($newsId) {
                return $item['id'] === $newsId;
              });

              // If the news item is found, assign the values to variables
              if (!empty($newsItem)) {
                $newsItem = array_shift($newsItem);
                $title = $newsItem['title'];
                $author = $newsItem['author'];
                $datePublished = $newsItem['date_published'];
                $content = $newsItem['content'];
              }
            }
            ?>
            
          <article class="entry entry-single">
          </article>

            <div class="entry-header">
              <h2 class="entry-title text-center"><div class="paragraph-separator2"></div>
                <a href="News-single.html"><?php echo $title; ?></a>
              </h2>
            </div>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="News-single.html"><?php echo $author; ?></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="News-single.html"><time datetime="<?php echo $datePublished; ?>"><?php echo $datePublished; ?></time></a></li>
              </ul>
            </div>    <div class="paragraph-separator2"></div>
            <style>
  .entry-content {
    width: 90%;
    margin: 0 auto;
  }

  .paragraph-separator {
    height: 30px; /* Adjust the height as per your preference */
  }

  .paragraph-separator2 {
    height: 50px; /* Adjust the height as per your preference */
  }

  @media (max-width: 768px) {
    .entry-content {
      width: 90%;
    }
  }
</style>

<div class="entry-content">
    <?php
    $words = preg_split('/\s+/', $content);
    $wordCount = 0;
    $wordsPerSeparator = 70;

    foreach ($words as $word) {
      echo $word . ' ';
      $wordCount++;

      if ($wordCount % $wordsPerSeparator === 0) {
        echo "<div class='paragraph-separator'></div>";
      }
    }
    ?>

    <div class="paragraph-separator"></div> <!-- Add this line for separation before the footer -->
    <div class="paragraph-separator2"></div>
  </div>

  </div>

          </article><!-- End News entry -->

          <!-- ...previous code... -->

        </div><!-- End col-lg-8 -->

        <!-- ...previous code... -->

      </div><!-- End row -->

    </div><!-- End container -->
  </section><!-- End News Single Section -->


            </div><!-- End sidebar -->

          </div><!-- End News sidebar -->

        </div>

      </div>
    </section><!-- End News Single Section -->

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