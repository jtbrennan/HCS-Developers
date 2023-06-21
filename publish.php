<?php
// JSON file paths
$articlesJsonFile = 'data.json';
$jobsJsonFile = 'data2.json';
$eventsJsonFile = 'data3.json';

// Function to read data from the JSON file
function readData($jsonFile) {
    $jsonData = file_get_contents($jsonFile);
    return json_decode($jsonData, true);
}

// Function to write data to the JSON file
function writeData($jsonFile, $data) {
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($jsonFile, $jsonData);
}

// Check if the JSON files exist, otherwise create empty arrays
if (!file_exists($articlesJsonFile)) {
    writeData($articlesJsonFile, []);
}

if (!file_exists($jobsJsonFile)) {
    writeData($jobsJsonFile, []);
}

if (!file_exists($eventsJsonFile)) {
    writeData($eventsJsonFile, []);
}

// Read data from the JSON files
$articles = readData($articlesJsonFile);
$jobs = readData($jobsJsonFile);
$events = readData($eventsJsonFile);

$successMessage = '';

// Check which form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitArticle'])) {
        // Get the article form data
        $title = $_POST['articleTitle'];
        $content = $_POST['articleContent'];
        $author = $_POST['articleAuthor'];
        $datePublished = date('Y-m-d');

        // Generate a unique ID for the article
        $id = uniqid();

        // Create a new article entry
        $article = [
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'published' => 'Pending Approval',
            'author' => $author,
            'date_published' => $datePublished
        ];

        // Add the new article to the articles array
        $articles[] = $article;

        // Write updated data to the JSON file
        writeData($articlesJsonFile, $articles);
        $successMessage = 'Your article has been submitted successfully.';
    } elseif (isset($_POST['submitJob'])) {
        // Get the job form data
        $id = uniqid();
        // Get the form data
        $title = $_POST['jobTitle'];
        $location = $_POST['jobLocation'];
        $payPerHour = $_POST['pay_per_hour'];
        $company = $_POST['company'];
        $companyLink = $_POST['company_link'];
        $submittedDate = date('Y-m-d'); // Get the current date
    
        // Create a new job entry
        $job = [
            'id' => $id,
            'title' => $title,
            'location' => $location,
            'pay_per_hour' => $payPerHour,
            'company' => $company,
            'company_link' => $companyLink,
            'submitted_date' => $submittedDate // Add the submitted date to the job
        ];

        // Add the new job to the jobs array
        $jobs[] = $job;

        // Write updated data to the JSON file
        writeData($jobsJsonFile, $jobs);
        $successMessage = 'Your job has been submitted successfully.';
    } elseif (isset($_POST['submitEvent'])) {
        // Get the event form data
        $id = uniqid();
        // Get the form data
        $title = $_POST['title'];
        $date = $_POST['date'];
        $host = $_POST['host'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $link = $_POST['link'];
    
        // Create a new event entry
        $event = [
            'id' => $id,
            'title' => $title,
            'date' => $date,
            'host' => $host,
            'description' => $description,
            'location' => $location,
            'link' => $link
        ];

        // Add the new event to the events array
        $events[] = $event;

        // Write updated data to the JSON file
        writeData($eventsJsonFile, $events);
        $successMessage = 'Your event has been submitted successfully.';
    }

    // Redirect to the success page
    header('Location: publish.php?success=' . urlencode($successMessage));
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Publish</title>
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
  @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");a,abbr,acronym,address,applet,article,aside,audio,b,big,blockquote,body,canvas,caption,center,cite,code,dd,del,details,dfn,div,dl,dt,em,embed,fieldset,figcaption,figure,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,html,i,iframe,img,ins,kbd,label,legend,li,mark,menu,nav,object,ol,output,p,pre,q,ruby,s,samp,section,small,span,strike,strong,sub,summary,sup,table,tbody,td,tfoot,th,thead,time,tr,tt,u,ul,var,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:initial}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:after,blockquote:before,q:after,q:before{content:"";content:none}table{border-collapse:collapse;border-spacing:0}.nice-form-group{--nf-input-size:1rem;--nf-input-font-size:calc(var(--nf-input-size)*0.875);--nf-small-font-size:calc(var(--nf-input-size)*0.875);--nf-input-font-family:inherit;--nf-label-font-family:inherit;--nf-input-color:#20242f;--nf-input-border-radius:0.25rem;--nf-input-placeholder-color:#929292;--nf-input-border-color:#c0c4c9;--nf-input-border-width:1px;--nf-input-border-style:solid;--nf-input-border-bottom-width:2px;--nf-input-focus-border-color:#3b4ce2;--nf-input-background-color:#f9fafb;--nf-invalid-input-border-color:var(--nf-input-border-color);--nf-invalid-input-background-color:var(--nf-input-background-color);--nf-invalid-input-color:var(--nf-input-color);--nf-valid-input-border-color:var(--nf-input-border-color);--nf-valid-input-background-color:var(--nf-input-background-color);--nf-valid-input-color:inherit;--nf-invalid-input-border-bottom-color:red;--nf-valid-input-border-bottom-color:green;--nf-label-font-size:var(--nf-small-font-size);--nf-label-color:#374151;--nf-label-font-weight:500;--nf-slider-track-background:#dfdfdf;--nf-slider-track-height:0.25rem;--nf-slider-thumb-size:calc(var(--nf-slider-track-height)*4);--nf-slider-track-border-radius:var(--nf-slider-track-height);--nf-slider-thumb-border-width:2px;--nf-slider-thumb-border-focus-width:1px;--nf-slider-thumb-border-color:#fff;--nf-slider-thumb-background:var(--nf-input-focus-border-color);display:block;margin-top:calc(var(--nf-input-size)*1.5);line-height:1;white-space:nowrap;--switch-orb-size:var(--nf-input-size);--switch-orb-offset:calc(var(--nf-input-border-width)*2);--switch-width:calc(var(--nf-input-size)*2.5);--switch-height:calc(var(--nf-input-size)*1.25 + var(--switch-orb-offset))}.nice-form-group>label{font-weight:var(--nf-label-font-weight);display:block;color:var(--nf-label-color);font-size:var(--nf-label-font-size);font-family:var(--nf-label-font-family);margin-bottom:calc(var(--nf-input-size)/2);white-space:normal}.nice-form-group>label+small{font-style:normal}.nice-form-group small{font-family:var(--nf-input-font-family);display:block;font-weight:400;opacity:.75;font-size:var(--nf-small-font-size);margin-bottom:calc(var(--nf-input-size)*0.75)}.nice-form-group small:last-child{margin-bottom:0}.nice-form-group>legend{font-weight:var(--nf-label-font-weight);display:block;color:var(--nf-label-color);font-size:var(--nf-label-font-size);font-family:var(--nf-label-font-family);margin-bottom:calc(var(--nf-input-size)/5)}.nice-form-group>.nice-form-group{margin-top:calc(var(--nf-input-size)/2)}.nice-form-group>input[type=checkbox],.nice-form-group>input[type=date],.nice-form-group>input[type=email],.nice-form-group>input[type=month],.nice-form-group>input[type=number],.nice-form-group>input[type=password],.nice-form-group>input[type=radio],.nice-form-group>input[type=search],.nice-form-group>input[type=tel],.nice-form-group>input[type=text],.nice-form-group>input[type=time],.nice-form-group>input[type=url],.nice-form-group>input[type=week],.nice-form-group>select,.nice-form-group>textarea{background:var(--nf-input-background-color);font-family:inherit;font-size:var(--nf-input-font-size);border-bottom-width:var(--nf-input-border-width);font-family:var(--nf-input-font-family);box-shadow:none;border-radius:var(--nf-input-border-radius);border:var(--nf-input-border-width) var(--nf-input-border-style) var(--nf-input-border-color);border-bottom:var(--nf-input-border-bottom-width) var(--nf-input-border-style) var(--nf-input-border-color);color:var(--nf-input-color);width:100%;padding:calc(var(--nf-input-size)*0.75);height:calc(var(--nf-input-size)*2.75);line-height:normal;-webkit-appearance:none;-moz-appearance:none;appearance:none;transition:all .15s ease-out;--icon-padding:calc(var(--nf-input-size)*2.25);--icon-background-offset:calc(var(--nf-input-size)*0.75)}.nice-form-group>input[type=checkbox]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=date]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=email]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=month]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=number]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=password]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=radio]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=search]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=tel]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=text]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=time]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=url]:required:not(:placeholder-shown):invalid,.nice-form-group>input[type=week]:required:not(:placeholder-shown):invalid,.nice-form-group>select:required:not(:placeholder-shown):invalid,.nice-form-group>textarea:required:not(:placeholder-shown):invalid{background-color:var(--nf-invalid-input-background-color);border-bottom-color:var(--nf-valid-input-border-color);border-color:var(--nf-valid-input-border-color) var(--nf-valid-input-border-color) var(--nf-invalid-input-border-bottom-color);color:var(--nf-invalid-input-color)}.nice-form-group>input[type=checkbox]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=date]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=email]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=month]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=number]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=password]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=radio]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=search]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=tel]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=text]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=time]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=url]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>input[type=week]:required:not(:placeholder-shown):invalid:focus,.nice-form-group>select:required:not(:placeholder-shown):invalid:focus,.nice-form-group>textarea:required:not(:placeholder-shown):invalid:focus{background-color:var(--nf-input-background-color);border-color:var(--nf-input-border-color);color:var(--nf-input-color)}.nice-form-group>input[type=checkbox]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=date]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=email]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=month]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=number]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=password]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=radio]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=search]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=tel]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=text]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=time]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=url]:required:not(:placeholder-shown):valid,.nice-form-group>input[type=week]:required:not(:placeholder-shown):valid,.nice-form-group>select:required:not(:placeholder-shown):valid,.nice-form-group>textarea:required:not(:placeholder-shown):valid{background-color:var(--nf-valid-input-background-color);border-bottom-color:var(--nf-valid-input-border-color);border-color:var(--nf-valid-input-border-color) var(--nf-valid-input-border-color) var(--nf-valid-input-border-bottom-color);color:var(--nf-valid-input-color)}.nice-form-group>input[type=checkbox]:disabled,.nice-form-group>input[type=date]:disabled,.nice-form-group>input[type=email]:disabled,.nice-form-group>input[type=month]:disabled,.nice-form-group>input[type=number]:disabled,.nice-form-group>input[type=password]:disabled,.nice-form-group>input[type=radio]:disabled,.nice-form-group>input[type=search]:disabled,.nice-form-group>input[type=tel]:disabled,.nice-form-group>input[type=text]:disabled,.nice-form-group>input[type=time]:disabled,.nice-form-group>input[type=url]:disabled,.nice-form-group>input[type=week]:disabled,.nice-form-group>select:disabled,.nice-form-group>textarea:disabled{cursor:not-allowed;opacity:.75}.nice-form-group>input[type=checkbox]::-webkit-input-placeholder,.nice-form-group>input[type=date]::-webkit-input-placeholder,.nice-form-group>input[type=email]::-webkit-input-placeholder,.nice-form-group>input[type=month]::-webkit-input-placeholder,.nice-form-group>input[type=number]::-webkit-input-placeholder,.nice-form-group>input[type=password]::-webkit-input-placeholder,.nice-form-group>input[type=radio]::-webkit-input-placeholder,.nice-form-group>input[type=search]::-webkit-input-placeholder,.nice-form-group>input[type=tel]::-webkit-input-placeholder,.nice-form-group>input[type=text]::-webkit-input-placeholder,.nice-form-group>input[type=time]::-webkit-input-placeholder,.nice-form-group>input[type=url]::-webkit-input-placeholder,.nice-form-group>input[type=week]::-webkit-input-placeholder,.nice-form-group>select::-webkit-input-placeholder,.nice-form-group>textarea::-webkit-input-placeholder{color:var(--nf-input-placeholder-color);letter-spacing:0}.nice-form-group>input[type=checkbox]:-ms-input-placeholder,.nice-form-group>input[type=date]:-ms-input-placeholder,.nice-form-group>input[type=email]:-ms-input-placeholder,.nice-form-group>input[type=month]:-ms-input-placeholder,.nice-form-group>input[type=number]:-ms-input-placeholder,.nice-form-group>input[type=password]:-ms-input-placeholder,.nice-form-group>input[type=radio]:-ms-input-placeholder,.nice-form-group>input[type=search]:-ms-input-placeholder,.nice-form-group>input[type=tel]:-ms-input-placeholder,.nice-form-group>input[type=text]:-ms-input-placeholder,.nice-form-group>input[type=time]:-ms-input-placeholder,.nice-form-group>input[type=url]:-ms-input-placeholder,.nice-form-group>input[type=week]:-ms-input-placeholder,.nice-form-group>select:-ms-input-placeholder,.nice-form-group>textarea:-ms-input-placeholder{color:var(--nf-input-placeholder-color);letter-spacing:0}.nice-form-group>input[type=checkbox]:-moz-placeholder,.nice-form-group>input[type=checkbox]::-moz-placeholder,.nice-form-group>input[type=date]:-moz-placeholder,.nice-form-group>input[type=date]::-moz-placeholder,.nice-form-group>input[type=email]:-moz-placeholder,.nice-form-group>input[type=email]::-moz-placeholder,.nice-form-group>input[type=month]:-moz-placeholder,.nice-form-group>input[type=month]::-moz-placeholder,.nice-form-group>input[type=number]:-moz-placeholder,.nice-form-group>input[type=number]::-moz-placeholder,.nice-form-group>input[type=password]:-moz-placeholder,.nice-form-group>input[type=password]::-moz-placeholder,.nice-form-group>input[type=radio]:-moz-placeholder,.nice-form-group>input[type=radio]::-moz-placeholder,.nice-form-group>input[type=search]:-moz-placeholder,.nice-form-group>input[type=search]::-moz-placeholder,.nice-form-group>input[type=tel]:-moz-placeholder,.nice-form-group>input[type=tel]::-moz-placeholder,.nice-form-group>input[type=text]:-moz-placeholder,.nice-form-group>input[type=text]::-moz-placeholder,.nice-form-group>input[type=time]:-moz-placeholder,.nice-form-group>input[type=time]::-moz-placeholder,.nice-form-group>input[type=url]:-moz-placeholder,.nice-form-group>input[type=url]::-moz-placeholder,.nice-form-group>input[type=week]:-moz-placeholder,.nice-form-group>input[type=week]::-moz-placeholder,.nice-form-group>select:-moz-placeholder,.nice-form-group>select::-moz-placeholder,.nice-form-group>textarea:-moz-placeholder,.nice-form-group>textarea::-moz-placeholder{color:var(--nf-input-placeholder-color);letter-spacing:0}.nice-form-group>input[type=checkbox]:focus,.nice-form-group>input[type=date]:focus,.nice-form-group>input[type=email]:focus,.nice-form-group>input[type=month]:focus,.nice-form-group>input[type=number]:focus,.nice-form-group>input[type=password]:focus,.nice-form-group>input[type=radio]:focus,.nice-form-group>input[type=search]:focus,.nice-form-group>input[type=tel]:focus,.nice-form-group>input[type=text]:focus,.nice-form-group>input[type=time]:focus,.nice-form-group>input[type=url]:focus,.nice-form-group>input[type=week]:focus,.nice-form-group>select:focus,.nice-form-group>textarea:focus{outline:none;border-color:var(--nf-input-focus-border-color)}.nice-form-group>input[type=checkbox]+small,.nice-form-group>input[type=date]+small,.nice-form-group>input[type=email]+small,.nice-form-group>input[type=month]+small,.nice-form-group>input[type=number]+small,.nice-form-group>input[type=password]+small,.nice-form-group>input[type=radio]+small,.nice-form-group>input[type=search]+small,.nice-form-group>input[type=tel]+small,.nice-form-group>input[type=text]+small,.nice-form-group>input[type=time]+small,.nice-form-group>input[type=url]+small,.nice-form-group>input[type=week]+small,.nice-form-group>select+small,.nice-form-group>textarea+small{margin-top:.5rem}.nice-form-group>input[type=checkbox].icon-left,.nice-form-group>input[type=date].icon-left,.nice-form-group>input[type=email].icon-left,.nice-form-group>input[type=month].icon-left,.nice-form-group>input[type=number].icon-left,.nice-form-group>input[type=password].icon-left,.nice-form-group>input[type=radio].icon-left,.nice-form-group>input[type=search].icon-left,.nice-form-group>input[type=tel].icon-left,.nice-form-group>input[type=text].icon-left,.nice-form-group>input[type=time].icon-left,.nice-form-group>input[type=url].icon-left,.nice-form-group>input[type=week].icon-left,.nice-form-group>select.icon-left,.nice-form-group>textarea.icon-left{background-position:left var(--icon-background-offset) bottom 50%;padding-left:var(--icon-padding);background-size:var(--nf-input-size)}.nice-form-group>input[type=checkbox].icon-right,.nice-form-group>input[type=date].icon-right,.nice-form-group>input[type=email].icon-right,.nice-form-group>input[type=month].icon-right,.nice-form-group>input[type=number].icon-right,.nice-form-group>input[type=password].icon-right,.nice-form-group>input[type=radio].icon-right,.nice-form-group>input[type=search].icon-right,.nice-form-group>input[type=tel].icon-right,.nice-form-group>input[type=text].icon-right,.nice-form-group>input[type=time].icon-right,.nice-form-group>input[type=url].icon-right,.nice-form-group>input[type=week].icon-right,.nice-form-group>select.icon-right,.nice-form-group>textarea.icon-right{background-position:right var(--icon-background-offset) bottom 50%;padding-right:var(--icon-padding);background-size:var(--nf-input-size)}.nice-form-group>input[type=checkbox]:-webkit-autofill,.nice-form-group>input[type=date]:-webkit-autofill,.nice-form-group>input[type=email]:-webkit-autofill,.nice-form-group>input[type=month]:-webkit-autofill,.nice-form-group>input[type=number]:-webkit-autofill,.nice-form-group>input[type=password]:-webkit-autofill,.nice-form-group>input[type=radio]:-webkit-autofill,.nice-form-group>input[type=search]:-webkit-autofill,.nice-form-group>input[type=tel]:-webkit-autofill,.nice-form-group>input[type=text]:-webkit-autofill,.nice-form-group>input[type=time]:-webkit-autofill,.nice-form-group>input[type=url]:-webkit-autofill,.nice-form-group>input[type=week]:-webkit-autofill,.nice-form-group>select:-webkit-autofill,.nice-form-group>textarea:-webkit-autofill{padding:calc(var(--nf-input-size)*0.75)!important}.nice-form-group>input[type=search]:placeholder-shown{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-search'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='M21 21l-4.35-4.35'/%3E%3C/svg%3E");background-position:left calc(var(--nf-input-size)*0.75) bottom 50%;padding-left:calc(var(--nf-input-size)*2.25);background-size:var(--nf-input-size);background-repeat:no-repeat}.nice-form-group>input[type=search]::-webkit-search-cancel-button{-webkit-appearance:none;width:var(--nf-input-size);height:var(--nf-input-size);background:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x'%3E%3Cpath d='M18 6L6 18M6 6l12 12'/%3E%3C/svg%3E")}.nice-form-group>input[type=search]:focus{padding-left:calc(var(--nf-input-size)*0.75);background-position:left calc(var(--nf-input-size)*-1) bottom 50%}.nice-form-group>input[type=email][class^=icon]{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-at-sign'%3E%3Ccircle cx='12' cy='12' r='4'/%3E%3Cpath d='M16 8v5a3 3 0 006 0v-1a10 10 0 10-3.92 7.94'/%3E%3C/svg%3E");background-repeat:no-repeat}.nice-form-group>input[type=tel][class^=icon]{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-phone'%3E%3Cpath d='M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z'/%3E%3C/svg%3E");background-repeat:no-repeat}.nice-form-group>input[type=url][class^=icon]{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-link'%3E%3Cpath d='M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71'/%3E%3Cpath d='M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71'/%3E%3C/svg%3E");background-repeat:no-repeat}.nice-form-group>input[type=password]{letter-spacing:2px}.nice-form-group>input[type=password][class^=icon]{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-lock'%3E%3Crect x='3' y='11' width='18' height='11' rx='2' ry='2'/%3E%3Cpath d='M7 11V7a5 5 0 0110 0v4'/%3E%3C/svg%3E");background-repeat:no-repeat}.nice-form-group>input[type=range]{-webkit-appearance:none;width:100%;cursor:pointer}.nice-form-group>input[type=range]:focus{outline:none}.nice-form-group>input[type=range]::-webkit-slider-runnable-track{width:100%;height:var(--nf-slider-track-height);background:var(--nf-slider-track-background);border-radius:var(--nf-slider-track-border-radius)}.nice-form-group>input[type=range]::-moz-range-track{width:100%;height:var(--nf-slider-track-height);background:var(--nf-slider-track-background);border-radius:var(--nf-slider-track-border-radius)}.nice-form-group>input[type=range]::-webkit-slider-thumb{height:var(--nf-slider-thumb-size);width:var(--nf-slider-thumb-size);border-radius:var(--nf-slider-thumb-size);background:var(--nf-slider-thumb-background);border:0;border:var(--nf-slider-thumb-border-width) solid var(--nf-slider-thumb-border-color);-webkit-appearance:none;appearance:none;margin-top:calc(var(--nf-slider-track-height)*0.5 - var(--nf-slider-thumb-size)*0.5)}.nice-form-group>input[type=range]::-moz-range-thumb{height:var(--nf-slider-thumb-size);width:var(--nf-slider-thumb-size);border-radius:var(--nf-slider-thumb-size);background:var(--nf-slider-thumb-background);border:0;border:var(--nf-slider-thumb-border-width) solid var(--nf-slider-thumb-border-color);-moz-appearance:none;appearance:none;box-sizing:border-box}.nice-form-group>input[type=range]:focus::-webkit-slider-thumb{box-shadow:0 0 0 var(--nf-slider-thumb-border-focus-width) var(--nf-slider-thumb-background)}.nice-form-group>input[type=range]:focus::-moz-range-thumb{box-shadow:0 0 0 var(--nf-slider-thumb-border-focus-width) var(--nf-slider-thumb-background)}.nice-form-group>input[type=color]{border:var(--nf-input-border-width) solid var(--nf-input-border-color);border-bottom-width:var(--nf-input-border-bottom-width);height:calc(var(--nf-input-size)*2);border-radius:var(--nf-input-border-radius);padding:calc(var(--nf-input-border-width)*2)}.nice-form-group>input[type=color]:focus{outline:none;border-color:var(--nf-input-focus-border-color)}.nice-form-group>input[type=color]::-webkit-color-swatch-wrapper{padding:5%}.nice-form-group>input[type=color]::-moz-color-swatch{border-radius:calc(var(--nf-input-border-radius)/2);border:none}.nice-form-group>input[type=color]::-webkit-color-swatch{border-radius:calc(var(--nf-input-border-radius)/2);border:none}.nice-form-group>input[type=number]{width:auto}.nice-form-group>input[type=date],.nice-form-group>input[type=month],.nice-form-group>input[type=week]{min-width:14em;background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-calendar'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'/%3E%3Cpath d='M16 2v4M8 2v4M3 10h18'/%3E%3C/svg%3E")}.nice-form-group>input[type=time]{min-width:6em;background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-clock'%3E%3Ccircle cx='12' cy='12' r='10'/%3E%3Cpath d='M12 6v6l4 2'/%3E%3C/svg%3E")}.nice-form-group>input[type=date],.nice-form-group>input[type=month],.nice-form-group>input[type=time],.nice-form-group>input[type=week]{background-position:right calc(var(--nf-input-size)*0.75) bottom 50%;background-repeat:no-repeat;background-size:var(--nf-input-size);width:auto}.nice-form-group>input[type=date]::-webkit-calendar-picker-indicator,.nice-form-group>input[type=date]::-webkit-inner-spin-button,.nice-form-group>input[type=month]::-webkit-calendar-picker-indicator,.nice-form-group>input[type=month]::-webkit-inner-spin-button,.nice-form-group>input[type=time]::-webkit-calendar-picker-indicator,.nice-form-group>input[type=time]::-webkit-inner-spin-button,.nice-form-group>input[type=week]::-webkit-calendar-picker-indicator,.nice-form-group>input[type=week]::-webkit-inner-spin-button{-webkit-appearance:none;cursor:pointer;opacity:0}@-moz-document url-prefix(){.nice-form-group>input[type=date],.nice-form-group>input[type=month],.nice-form-group>input[type=time],.nice-form-group>input[type=week]{min-width:auto;width:auto;background-image:none}}.nice-form-group>textarea{height:auto}.nice-form-group>input[type=checkbox],.nice-form-group>input[type=radio]{width:var(--nf-input-size);height:var(--nf-input-size);padding:inherit;margin:0;display:inline-block;vertical-align:top;border-radius:calc(var(--nf-input-border-radius)/2);border-width:var(--nf-input-border-width);cursor:pointer;background-position:50%}.nice-form-group>input[type=checkbox]:focus:not(:checked),.nice-form-group>input[type=radio]:focus:not(:checked){border:var(--nf-input-border-width) solid var(--nf-input-focus-border-color);outline:none}.nice-form-group>input[type=checkbox]:hover,.nice-form-group>input[type=radio]:hover{border:var(--nf-input-border-width) solid var(--nf-input-focus-border-color)}.nice-form-group>input[type=checkbox]+label,.nice-form-group>input[type=radio]+label{display:inline-block;margin-bottom:0;padding-left:calc(var(--nf-input-size)/2.5);font-weight:400;-webkit-user-select:none;user-select:none;cursor:pointer;max-width:calc(100% - var(--nf-input-size)*2);line-height:normal}.nice-form-group>input[type=checkbox]+label>small,.nice-form-group>input[type=radio]+label>small{margin-top:calc(var(--nf-input-size)/4)}.nice-form-group>input[type=checkbox]:checked{background:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23FFF' stroke-width='3' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E") no-repeat 50%/85%;background-color:var(--nf-input-focus-border-color);border-color:var(--nf-input-focus-border-color)}.nice-form-group>input[type=radio]{border-radius:100%}.nice-form-group>input[type=radio]:checked{background-color:var(--nf-input-focus-border-color);border-color:var(--nf-input-focus-border-color);box-shadow:inset 0 0 0 3px #fff}.nice-form-group>input[type=checkbox].switch{width:var(--switch-width);height:var(--switch-height);border-radius:var(--switch-height);position:relative}.nice-form-group>input[type=checkbox].switch:after{background:var(--nf-input-border-color);border-radius:var(--switch-orb-size);height:var(--switch-orb-size);left:var(--switch-orb-offset);position:absolute;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%);width:var(--switch-orb-size);content:"";transition:all .2s ease-out}.nice-form-group>input[type=checkbox].switch+label{margin-top:calc(var(--switch-height)/8)}.nice-form-group>input[type=checkbox].switch:checked{background:none;background-position:0 0;background-color:var(--nf-input-focus-border-color)}.nice-form-group>input[type=checkbox].switch:checked:after{-webkit-transform:translateY(-50%) translateX(calc(var(--switch-width)/2 - var(--switch-orb-offset)));transform:translateY(-50%) translateX(calc(var(--switch-width)/2 - var(--switch-orb-offset)));background:#fff}.nice-form-group>input[type=file]{background:rgba(0,0,0,.025);padding:var(--nf-input-size);display:block;width:100%;border-radius:var(--nf-input-border-radius);border:1px dashed var(--nf-input-border-color);outline:none;cursor:pointer}.nice-form-group>input[type=file]:focus,.nice-form-group>input[type=file]:hover{border-color:var(--nf-input-focus-border-color)}.nice-form-group>input[type=file]::file-selector-button{background:var(--nf-input-focus-border-color);border:0;-webkit-appearance:none;-moz-appearance:none;appearance:none;padding:.5rem;border-radius:var(--nf-input-border-radius);color:#fff;margin-right:1rem;outline:none;font-family:var(--nf-input-font-family);cursor:pointer}.nice-form-group>input[type=file]::-webkit-file-upload-button{background:var(--nf-input-focus-border-color);border:0;-webkit-appearance:none;appearance:none;padding:.5rem;border-radius:var(--nf-input-border-radius);color:#fff;margin-right:1rem;outline:none;font-family:var(--nf-input-font-family);cursor:pointer}.nice-form-group>select{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-down'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");background-position:right calc(var(--nf-input-size)*0.75) bottom 50%;background-repeat:no-repeat;background-size:var(--nf-input-size)}*,:after,:before{box-sizing:inherit}html{font-size:16px;box-sizing:border-box}body{background:#f3f0e7;font-family:Roboto,sans-serif;color:#4b5563;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.demo-page{margin:0 auto;display:-webkit-flex;display:flex;max-width:100%}.demo-page .demo-page-navigation{width:18em;padding:2em 1em}@media only screen and (max-width:750px){.demo-page .demo-page-navigation{display:none}}.demo-page .demo-page-navigation nav{position:-webkit-sticky;position:sticky;top:2em;background:#fff;padding:.5em;border-radius:.75rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.1),0 4px 6px -2px rgba(0,0,0,.05)}.demo-page .demo-page-navigation a{display:-webkit-flex;display:flex;padding:.75em 1em;text-decoration:none;border-radius:.25em;color:#374151;-webkit-align-items:center;align-items:center}.demo-page .demo-page-navigation a:hover{background:#f3f4f6}.demo-page .demo-page-navigation a svg{width:1.25em;height:1.25em;margin-right:1em;color:#1f2937}.demo-page .demo-page-content{padding:2em 1em;max-width:100%}@media only screen and (min-width:750px){.demo-page .demo-page-content{width:calc(100% - 18em)}}footer{text-align:center;margin:2.5em 0}.href-target{position:absolute;top:-2em}.to-repo,.to-reset{display:-webkit-inline-flex;display:inline-flex;background:#24292e;color:#fff;border-radius:5px;padding:.5em 1em;text-decoration:none;-webkit-align-items:center;align-items:center;transition:background .2s ease-out}.to-repo:hover,.to-reset:hover{background:#000}.to-repo svg,.to-reset svg{width:1.125rem;height:1.125rem;margin-right:.75em}.to-reset{background:#3b4ce2}.to-reset:hover{background:#2538df}section{background:#fff;padding:2em;border-radius:.75rem;line-height:1.6;overflow:hidden;margin-bottom:2rem;position:relative;font-size:.875rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.1),0 4px 6px -2px rgba(0,0,0,.05)}section h1{font-weight:500;font-size:1.25rem;color:#000;margin-bottom:.75rem}section h1 svg{width:1em;height:1em;display:inline-block;vertical-align:-10%;margin-right:.25em}section h1.package-name{font-size:2rem;margin-bottom:.75rem;margin-top:-.5rem}section strong{font-weight:500;color:#000}section p{margin:.5rem 0 1.5rem}section p a{text-decoration:none;font-weight:500;color:#3b4ce2}section p:last-child{margin-bottom:0}section code{font-weight:500;font-family:Consolas,monaco,monospace;position:relative;z-index:1;margin:0 2px;background:#f3f4f4;content:"";border-radius:3px;padding:2px 5px;white-space:nowrap}section ul{margin-top:.5em;padding-left:1em;list-style-type:disc}details{background:#f1f1f1;margin:2em -2em -2em;padding:1.5em 2em}details .gist{margin-top:1.5em}details .toggle-code{display:inline-block;padding:.5em 1em;border-radius:5px;font-size:.875rem;background:#10b981;top:1em;right:1em;color:#fff;font-weight:500;-webkit-user-select:none;user-select:none;cursor:pointer}details .toggle-code:hover{background:#0ea271}details .toggle-code svg{display:inline-block;vertical-align:-15%;margin-right:.25em}details summary{outline:none;list-style-type:none}details summary::marker{display:none}details summary::-webkit-details-marker{display:none}
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
                  <li><a class="nav-link scrollto" href="publish.php#structure">Post Articles</a></li>
                  <li><a class="nav-link scrollto" href="publish.php#input-types">Post Jobs</a></li>
                  <li><a class="nav-link scrollto" href="publish.php#icons">Post Events</a></li>

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

  <style>
    .form-control:focus{color: #495057;background-color: #fff;border-color: #80bdff;outline: 0;box-shadow: 0 0 0 0rem rgba(0,123,255,.25)}.btn-secondary:focus{box-shadow: 0 0 0 0rem rgba(108,117,125,.5)}.close:focus{box-shadow: 0 0 0 0rem rgba(108,117,125,.5)}.mt-200{margin-top:200px}
</style>



  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="index.php">Home</a></li>
        </ol>
        <h2>Publish</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      
      <div class="sidebar-item container" data-aos="fade-up" >

        <div class="search-form input-group mb-3" style="margin-bottom: 25px;">
        <?php
$successMessage = isset($_GET['success']) ? $_GET['success'] : '';
?>

        <div class="alert alert-success<?php echo $successMessage ? '' : ' d-none'; ?> text-center mx-auto w-50">
    <?php echo $successMessage; ?>
</div>



 <div class="container">
 <div class="demo-page">
  <div class="demo-page-navigation">
    <nav>
      <ul>
        <li>
          <a href="#structure">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers">
              <polygon points="12 2 2 7 12 12 22 7 12 2" />
              <polyline points="2 17 12 22 22 17" />
              <polyline points="2 12 12 17 22 12" />
            </svg>

            Publish an Article</a>
        </li>
        <li>
          <a href="#input-types">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tool">
              <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
              </svg>
            Post a Job</a>
        </li>
        <li>
          <a href="#icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify">
              <line x1="21" y1="10" x2="3" y2="10" />
              <line x1="21" y1="6" x2="3" y2="6" />
              <line x1="21" y1="14" x2="3" y2="14" />
              <line x1="21" y1="18" x2="3" y2="18" />
            </svg>
            Post an Event</a>
        </li>

      </ul>
    </nav>
  </div>
  <main class="demo-page-content">


  <section>
            <div class="href-target" id="structure"></div>
            <h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers">
              <polygon points="12 2 2 7 12 12 22 7 12 2" />
              <polyline points="2 17 12 22 22 17" />
              <polyline points="2 12 12 17 22 12" />
            </svg>
                Article
            </h1>
            <p>Use this form to publish an article. Fill in the fields with the article's title, content, and author. Submit the form to share your article with others.</p>
            <form method="POST" action="publish.php">
                <div class="nice-form-group">
                    <label>Title</label>
                    <input type="text" placeholder="" id="title" name="articleTitle" />
                </div>

                <div class="nice-form-group">
                    <label>Content</label>
                    <small></small>
                    <input id="content" name="articleContent" type="text" placeholder="" />
                </div>

                <div class="nice-form-group">
                    <label>Author</label>
                    <input type="text" placeholder="" type="text" id="author" name="articleAuthor" />
                    <small></small>
                </div>

                <input type="hidden" id="date_published" name="date_published" value="<?php echo date('Y-m-d'); ?>">

                <details>
  <summary>
      <button type="submit" name="submitArticle" value="Submit Article" class="btn btn-success" style="background-color: green; color: #ffffff;" onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='green';" onmouseout="this.style.backgroundColor='green'; this.style.color='#ffffff';">Submit</button>
  </summary>
</details>

            </form>
        </section>

    <section>
      <div class="href-target" id="input-types"></div>
      <h1>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tool">
              <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
              </svg>
        Job
      </h1>
      <p>Post a job listing using this form. Provide the job title, location, pay per hour, company name, and a link to the company's website. Submit the form to advertise the job opportunity.</p>


<form method="POST" action="publish.php">
      <div class="nice-form-group">
        <label>Title</label>
        <input type="text" id="jobTitle" name="jobTitle" >
      </div>

      <div class="nice-form-group">
        <label>Location:</label>
        <small></small>
        <input type="text" id="jobLocation" name="jobLocation" >
      </div>

      
      <div class="nice-form-group">
        <label>Pay per Hour:</label>
        <input type="text" id="pay_per_hour" name="pay_per_hour" >
        <small></small>
      </div>

      <div class="nice-form-group">
        <label>Company:</label>
        <input type="text" id="company" name="company" >
        <small></small>
      </div>

      <div class="nice-form-group">
        <label>Link to Company Site:</label>
        <input type="text" id="company_link" name="company_link" >
        <small></small>
      </div>

            
      <input type="hidden" id="date_published" name="date_published" value="<?php echo date('Y-m-d'); ?>">

      <details>
  <summary>
      <button type="submit" name="submitJob" value="Submit Job" class="btn btn-success" style="background-color: green; color: #ffffff;" onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='green';" onmouseout="this.style.backgroundColor='green'; this.style.color='#ffffff';">Submit</button>
  </summary>
</details>

    </section>

    <section>
      <div class="href-target" id="icons"></div>
      <h1>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify">
              <line x1="21" y1="10" x2="3" y2="10" />
              <line x1="21" y1="6" x2="3" y2="6" />
              <line x1="21" y1="14" x2="3" y2="14" />
              <line x1="21" y1="18" x2="3" y2="18" />
            </svg>
        Event
      </h1>
      <p>Use this form to announce an upcoming event. Enter the event's title, date, host, description, location, and a link for more information. Submit the form to share details about the event
      </p>


<form method="POST" action="publish.php">
      <div class="nice-form-group">
        <label>Title</label>
        <input type="text" id="title" name="title">
      </div>

      <div class="nice-form-group">
        <label>Date:</label>
        <small></small>
        <input type="date" id="date" name="date">
      </div>

      
      <div class="nice-form-group">
        <label>Host:</label>
        <input type="text" id="host" name="host" >
        <small></small>
      </div>

      <div class="nice-form-group">
        <label>Description:</label>
        <textarea id="description" name="description"></textarea>
        <small></small>
      </div>

      <div class="nice-form-group">
        <label>Location:</label>
        <input type="text" id="location" name="location" >
        <small></small>
      </div>

      <div class="nice-form-group">
        <label>Link:</label>
        <input type="text" id="link" name="link" >
        <small></small>
      </div>

            

      <details>
  <summary>
      <button type="submit" name="submitEvent" value="Submit Event" class="btn btn-success" style="background-color: green; color: #ffffff;" onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='green';" onmouseout="this.style.backgroundColor='green'; this.style.color='#ffffff';">Submit</button>
  </summary>
</details>
    </section>

 
  </main>
</div>
     </div>
 </div>


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
              <li><i class="bi bi-chevron-right"></i> <a href="publish.php">Publish</a></li>
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