<?php

// Username is root
$user = 'root';
$password = '';

// Database name is geeksforgeeks
$database = 'test_one.0';

// Server is localhost with
// port number 3306
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);

// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);


    $columns = array('_record_number','Bug Type','Bug Input','Bug Commit','Bug-fixing Commit','Regressed or not','Report Date','Fixing Date','Status(Verified or Fixed)');
    $column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
    $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

        if ($result = $mysqli->query('SELECT * FROM students ORDER BY ' .  $column . ' ' . $sort_order)) {

          $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
          $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
          $add_class = ' class="highlight"';
}

// SQL query to select data from database
$sql = " SELECT * FROM userdata ORDER BY score DESC ";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSCLab Web Based Dataset</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="images/DataSetWindowsIcon.png">
    <link rel="stylesheet" href="./styles/styles.css">
</head>
    <body>
        <!-- side menu section -->
        <section id="side_menu" data-aos="fade-right" data-aos-duration="700">
            <div class="bug_logo">
                <img src="images/Bug Hosting.png" alt="bug logo">
                <div id="header_text">
                    <h2>NSC Dataset</h2>
                    <p>Ver 2.0.1</p>
                </div>
            </div>

            <!-- naviation links -->
            <div class="navigation">
                <ul>
                    <div class="current"><li><div class="nav_hover"><a href="index.html"><img src="./images/home.png" alt="">Home</a></div></li></div>
                    <li><div class="nav_hover"><a href="about.html"><img src="./images/about.png" alt="">About</a></div></li>
                    <li><div class="nav_hover"><a href="http://nsclab.org/nsclab/" target="_blank"><img src="./images/domain.png" alt="">NSCLab</a></div></li>
                </ul>
            </div>
        </section> <!-- end of side menu section -->

        <!-- heading section -->
        <section id="interface">
            <div class="search_heading" data-aos="fade-down" data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="400">
                <div class="left">
                    <h1>DATABASE</h1>
                </div>
                <div class="right_logo">
                    <img src="images/logo.jpg" alt="">
                </div>
            </div>

            <!-- search bar -->
            <div class="search_sort" data-aos="fade-in" data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="400">
                <div class="left">
                    <div class="left_search">
                        <img src="images/search.png" alt="">
                        <input type="text" placeholder="Search bugs..." size="60" id="myInput" onkeyup="search()">
                    </div>
                </div>

                <!-- drop down box -->
                <div class="right_sort" data-aos="fade-in" data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="400">
                    <div include="form-input-select()" class="select_box">
                        <select required><option value="" hidden>Sort by... </option>
                          <option value="1">Newest</option>
                          <option value="2">Oldest</option>
                          <option value="3">Type</option>
                          <option value="4">Regression</option>
                        </select>
                      </div>
                </div>
            </div>


            <!-- table with dummy data -->
            <div class="container" data-aos="fade-in" data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="400">
                <table class="table" id="our-table">
                    <thead>
                        <tr>
                            <th><?php echo $asc_or_desc; ?>Bug Name<i class="fas fa-sort<?php echo $column == '_record_number' ? '-' . $up_or_down : ''; ?>"></i></th>
                            <th><?php echo $asc_or_desc; ?>Bug Type<i class="fas fa-sort<?php echo $column == 'Bug Type' ? '-' . $up_or_down : ''; ?>"></i></th>
                            <th><?php echo $asc_or_desc; ?>Bug Input<i class="fas fa-sort<?php echo $column == 'Bug Input' ? '-' . $up_or_down : ''; ?>"></i></th>
                            <th><?php echo $asc_or_desc; ?>Bug Commit<i class="fas fa-sort<?php echo $column == 'Bug Commit' ? '-' . $up_or_down : ''; ?>"></i></th>
						                <th><?php echo $asc_or_desc; ?>Bug-Fixing Commit<i class="fas fa-sort<?php echo $column == 'Bug-fixing Commit' ? '-' . $up_or_down : ''; ?>"></i></th>
                            <th><?php echo $asc_or_desc; ?>Regression<i class="fas fa-sort<?php echo $column == 'Regressed or not' ? '-' . $up_or_down : ''; ?>"></i></th>
                            <th><?php echo $asc_or_desc; ?>Status<i class="fas fa-sort<?php echo $column == 'Status(Verified or Fixed)' ? '-' . $up_or_down : ''; ?>"></i></th>
                            <th><?php echo $asc_or_desc; ?>Report Date<i class="fas fa-sort<?php echo $column == 'Report Date' ? '-' . $up_or_down : ''; ?>"></i></th>
                            <th><?php echo $asc_or_desc; ?>Fix Date<i class="fas fa-sort<?php echo $column == 'Fixing Date' ? '-' . $up_or_down : ''; ?>"></i></th>
                        </tr>
							<?php
							// LOOP TILL END OF DATA
								while($rows=$result->fetch_assoc())
								{
							?>
                    </thead>
                    <tbody id="table-body"> <!-- table data will be generated within this <tbody> tag -->

						<tr>
						<!-- FETCHING DATA FROM EACH
							ROW OF EVERY COLUMN -->
						<td><?php echo $column == '_record_number' ? $add_class : ''; ?>><?php echo $rows['_record_number'];?></td>
						<td><?php echo $column == 'Bug Type' ? $add_class : ''; ?>><?php echo $rows['Bug Type'];?></td>
						<td><?php echo $column == 'Bug Input' ? $add_class : ''; ?>><?php echo $rows['Bug Input'];?></td>
						<td><?php echo $column == 'Bug Commit' ? $add_class : ''; ?>><?php echo $rows['Bug Commit'];?></td>
						<td><?php echo $column == 'Bug-fixing Commit' ? $add_class : ''; ?>><?php echo $rows['Bug-fixing Commit'];?></td>
						<td><?php echo $column == 'Regressed or not' ? $add_class : ''; ?>><?php echo $rows['Regressed or not'];?></td>
						<td><?php echo $column == 'Report Date' ? $add_class : ''; ?>><?php echo $rows['Report Date'];?></td>
						<td><?php echo $column == 'Fixing Date' ? $add_class : ''; ?>><?php echo $rows['Fixing Date'];?></td>
						<td><?php echo $column == 'Status(Verified or Fixed)' ? $add_class : ''; ?>><?php echo $rows['Status(Verified or Fixed)'];?></td>
						</tr>
						<?php
							}
						?>
                    </tbody>
                    <script src="script.js"></script>
                </table>
            </div>

            <!-- this div let's us browse 1000+ records in pages instead of scrolling for eternity -->
            <div class="container">
                <div id="count">Showing '16' of 1000</div>
                <div id="pagination-wrapper"></div>
            </div>

            <script src="./scripts/tablesearch.js"></script>
        </section> <!-- end of heading section-->

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

        <script src="./scripts/index.js"></script>
    </body>
</html>
