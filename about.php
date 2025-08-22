<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Online Coding Practice - CODEVERSE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="wrapper/img/logo.png" rel="icon">
  <link href="wrapper/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--Bootstrap Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Main CSS File -->
  <link id="theme-stylesheet" href="wrapper/css/main.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="starter-page-page">

   <?php  include("inc/header.php")  ?>
          <div class="page-title" id="starter-section">
              <div class="container d-lg-flex justify-content-between align-items-center" >
                        <h1 class="mb-2 mb-lg-0">About Us</h1>
                        <nav class="breadcrumbs">
                              <ol>
                                  <li><a href="index.php">Home</a></li>
                                  <li class="current">About Us</li>
                              </ol>
                        </nav>
              </div>
          </div>
    <section class="section about-us" id="about-us">
          <div class="container">
            <p>Codeverse is an online coding platform where you can <a href="courses.php">learn to code, </a><a href="ide.php"> practice coding</a>  and participate in <a href="compete.php">coding competitions</a>. Codeverse offers a variety of interactive courses on languages like Python, C, C++, Java, and JavaScript. We also have thousands of practice problems on programming languages, data structures, algorithms, SQL and web development.</p>

            <p>Codeverse offers multiple-choice questions (MCQs) as part of its practice material. These assessments are designed to test users' theoretical and conceptual knowledge of programming languages, data structures, algorithms, databases like SQL, and web development. Through these MCQ assessments, learners can evaluate their understanding of fundamental concepts, reinforce learning from the interactive courses, and identify areas where they may need further improvement. The format provides a more quiz-like experience, often offering immediate feedback, which helps in quick revision and concept reinforcement.</p>

            <p>Codeverse is the right place for anybody who wants to start with the world of programming and software development. Codeverse will provide you with structured content with ample practice problems to solidify your knowledge.</p>

            <p>The problems on Codeverse are logical in nature and focus more on problem solving than just regurgitating the syntax of the language. The difficulty of problems on Codeverse range from the complete beginner problems to very complex mathematical problems. Beginner problems focus on basic programming constructs and basic math, which are ideal for someone who wants to get used to coding in a particular language.</p>
            <br>
            <h2>Main Features of CODEVERSE</h2>
            <ul>
                <li><a href="ide.php">Check Time Complexity</a></li>
                <li><a href="practice_questions.php">Practice Problems</a></li>
                <li><a href="">MCQ bases Assessments on each Course</a></li>
                <li><a href="compete.php">Contests</a></li>
            </ul>

            <p><span>Know the time complexity of your code:</span> One standout feature of the IDE is its ability to analyze and display the time complexity of the user's code. Time complexity is crucial in understanding how efficiently a program runs, particularly with large inputs. The IDE provides users with insight into the performance of their code, helping them to write more efficient algorithms and optimize their solutions. Codeverse IDE efficiently analyze and provide feedback on the time complexity of your code, ensuring an optimal learning and practice experience.</p>

            <p>The platform offers support for over 10 programming languages, such as Python, C, C++, Java, JavaScript, and others. This flexibility allows users to practice coding in various languages depending on their preferences, goals, or course requirements.</p>

            <p>The IDE provides an interactive coding environment where users can input values dynamically. This feature mimics real-world scenarios where programs take input from users, helping learners gain experience with handling inputs and outputs in various coding problems.</p>
          </div>
    </section>

  <?php  include("inc/footer.php") ?>

  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/php-email-form/validate.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/mode.js"></script>

</body>

</html>