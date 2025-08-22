<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item nav-category">Elements</li>
            
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#Courses" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-note-text"></i>
                <span class="menu-title">Courses</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="Courses">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add_course.php">Add Course</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#resources" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-video"></i>
                <span class="menu-title">Videos</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="resources">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="upload_video.php">Upload Videos</a></li>
                  <li class="nav-item"> <a class="nav-link" href="list_videos.php">Your Videos</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#Questions" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-help-circle-outline"></i>
                <span class="menu-title">Questions</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="Questions">
                <ul class="nav flex-column sub-menu">
                  <p><u>Course Questions</u></p>
                  <li class="nav-item"> <a class="nav-link" href="upload_questions.php"> Add Questions </a></li>
                  <li class="nav-item"> <a class="nav-link" href="list_questions.php"> List Questions </a></li>
                  <p><u>Practical Questions</u></p>
                  <li class="nav-item"> <a class="nav-link" href="add_practical_questions.php">Add Practical Questions</a></li>
                  <li class="nav-item"> <a class="nav-link" href="list_practical_questions.php"> List Questions </a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-content-paste"></i>
                <span class="menu-title">Exams</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="view_task.php">Assigned Exam Task</a></li>
                  <li class="nav-item"> <a class="nav-link" href="contests_assigned.php">Contests Assigned</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>