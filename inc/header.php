<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <img src="wrapper/img/logo.png" alt="">
        <h1 class="sitename">CODEVERSE</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <?php
          if(isset($_SESSION['stu_user_name'])){
          ?>
          <li><a href="index.php" class="active">Home</a></li>
          <?php } ?>
          <li class="dropdown"><a href="courses.php"><span>Courses</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <?php
              $sql="SELECT * FROM course LIMIT 6";
              $res=$con->query($sql);
              while($row=$res->fetch_assoc()){
              ?>
              <li><a href="startcourse.php?scid=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
              <?php } ?>
            </ul>
          </li>
          <li><a href="practice_questions.php">Practice</a></li>
          <li><a href="compete.php">Compete</a></li>

          <?php
              if(isset($_SESSION['stu_user_name'])){
              ?>
          <div class="dropdown">
            <button class="btn btn-dark rounded dropdown-toggle me-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-person-circle"></i>
            </button>
           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
               <a><?php echo $_SESSION['stu_name']; ?></a>
               <li><hr class="dropdown-divider"></li>
               <li><a class="link-secondary" href="">My Profile</a></li>
               <li><hr class="dropdown-divider"></li>
               <a class="link-danger" href="logout.php">logout</a>
           </div>
          </div>
          <?php } ?>

            <?php
            if(isset($_SESSION['stu_user_name'])){
            ?>
            <li><a id="mode1" style="border: none;border-radius: 50px;"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368"><rect fill="none" height="24" width="24"/><path d="M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36c-0.98,1.37-2.58,2.26-4.4,2.26 c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z"/></svg></a>
            <a id="mode2" class="btnmode" style="border: none;background-color:020112fe;border-radius: 50px;display:none;"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF"><rect fill="none" height="24" width="24"/><path d="M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0 c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2 c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1 C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06 c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41 l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41 c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36 c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z"/></svg></a></li>
              <?php } ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        
      </nav>
             <?php
             if(isset($_SESSION['stu_user_name'])){
              echo "";
             }
             else{?>
              <a class="btn-getstarted" href="login_signup.php">Login</a>
              <?php } ?>
    </div>
  </header>