  <footer id="footer" class="footer position-relative">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-4 footer-links">
          <h4>Learn Courses</h4>
          <ul>
              <?php
              $sql="SELECT * FROM course LIMIT 5";
              $res=$con->query($sql);
              while($row=$res->fetch_assoc()){
              ?>
              <li><a href="startcourse.php?scid=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
              <?php } ?>
              <li><a href="courses.php">More Courses</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-4 footer-links">
          <h4>Online Compilers</h4>
          <ul>
            <li><a href="ide.php?lang=<?php echo 'python3'; ?>">Python online Compiler</a></li>
            <li><a href="ide.php?lang=<?php echo 'java' ?>">Java online Compiler</a></li>
            <li><a href="ide.php?lang=<?php echo 'c' ?>">C online Compiler</a></li>
            <li><a href="ide.php?lang=<?php echo 'cpp' ?>">C++ online Compiler</a></li>
            <li><a href="ide.php?lang=<?php echo 'js' ?>">JavaScript online Compiler</a></li>
            <li><a href="ide.php">More online Compiler</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-4 footer-links">
          <h4>Others</h4>
          <ul>
            <li><a href="ide.php">Check Time Complexity</a></li>
            <li><a href="compete.php">Coding Contests</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
            <li><a href="privacy_policy.php">Privacy Policy</a></li>
            <li><a href="terms.php">Terms of Usage</a></li>
          </ul>
        </div>

      </div>
    </div>
  </footer>
  <div class="container-fluid" id="footer-bottom">
    <div class="row">
      <div class="col-md-5">
        <h2><a href="index.php" class="text-dark">CODEVERSE</a></h2>
      </div>
      <div class="col-md-7">
        <div class="social-icons">
            <h3>Follow Us</h3>  
            <a href="" class="" style="background-color: rgb(255, 255, 255);"><i class="bi bi-youtube" style="color: #ee5627;"></i></a>
            <a href="" class="" style="background-color: rgb(255, 255, 255);"><i class="bi bi-facebook" style="color: #0011ff;"></i></a>
            <a href="" class="" style="background-color: rgb(0, 0, 0);"><i class="bi bi-twitter-x" style="color: #ffffff"></i></a>
            <a href="" class="" style="background:linear-gradient(blue,rgba(226, 11, 129, 0.938),yellow)"><i class="bi bi-instagram" style="color: #ffffff;"></i></a>
            <a href="" class="" style="background-color: rgb(255, 255, 255);"><i class="bi bi-linkedin" style="color: #0004ff;"></i></a>
        </div>
      </div>
    </div>  
</div>