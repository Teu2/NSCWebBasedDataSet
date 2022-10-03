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
    <link rel="stylesheet" href="./Styles/styles.css">
</head>
    <body>
        <!-- side menu section -->
        <section id="side_menu" data-aos="fade-right" data-aos-duration="700">
            <div class="bug_logo">
                <img src="images/Bug Hosting.svg" alt="bug logo">
                <div id="header_text">
                    <h2>NSC Dataset</h2>
                    <p>Ver 2.0.1</p>
                </div>
            </div>

            <!-- naviation links -->
            <div class="navigation">
                <ul>
                    <div class="current"><li><div class="nav_hover"><a href="index.php"><img src="./images/home.png" alt="">Home</a></div></li></div>
                    <li><div class="nav_hover"><a href="about.php"><img src="./images/about.png" alt="">About</a></div></li>
                    <li><div class="nav_hover"><a href="http://nsclab.org/nsclab/" target="_blank"><img src="./images/domain.png" alt="">NSCLab</a></div></li>
                </ul>
            </div>
        </section> <!-- end of side menu section -->

        <!-- heading section -->
        <section id="interface">
            <div class="search_heading" data-aos="fade-down" data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="400">
                <div class="left">
                    <h1>SEARCH RESULTS</h1>
                </div>
                <div class="right_logo">
                    <img src="images/logo.jpg" alt="">
                </div>
            </div>

            <!-- search bar -->
            <div class="search_sort" data-aos="fade-in" data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="400">
                <div class="left">
                    <div class="left_search">
                        <form action="index.php" method="post">
				<img src="images/search.png" alt=""/>
				<input type="text" placeholder="Search for more bugs..." size="60" name="myInput" pattern="[A-Za-z0-9]+"/>
				<input type="submit" value="Search" />
			</form>
			<?php
				if (isset($_POST["myInput"])) {
				  	$servername = "sql300.epizy.com"; // change to sql300.epizy.com
					$username = "epiz_32617535"; //change credentials to infinity free login for cpanel epiz_32617535
					$password = "o7NWrwBIBBjPs"; //change credentials to infinity free login for cpanel o7NWrwBIBBjPs
					$database = "epiz_32617535_master2"; // IMPORTANT!!!!!!!!!!!!!!!!!!!!!!! change nscbugdataset to the database name on your machine, change to epiz_32617535_master2

					// create a connection
					$connection = new mysqli($servername, $username, $password, $database);

					// check connection
					if ($connection->connect_error) {
						die("connection failed: " . $connection->connect_error);
					}

					if (!isset($_POST["Bug_Type"])&&!isset($_POST["Regression"])&&!isset($_POST["Status"])&&!isset($_POST["Report_Date"])&&!isset($_POST["Fix_Date"]))
						$search_results = "SELECT * FROM master2 order by Report_Date;";
					else {
						$Bug_Type=trim($_POST["Bug_Type"]);
						$Regression=trim($_POST["Regression"]);
						$Status=trim($_POST["Status"]);
						$Report_Date=trim($_POST["Report_Date"]);
						$Fix_Date=trim($_POST["Fix_Date"]);
						$search_results="SELECT * FROM master2 WHERE Bug_Type = '$Bug_Type' or Regression = '$Regression' or Status = '$Status' or Report_Date = '$Report_Date' or Fix_Date = '$Fix_Date' order by Report_Date";
					}
				  if (count($search_results) > 0) { foreach ($search_results as $r) {
					echo " <tr>
					<td class='name'>" . $row["_record_number"] . "</td>
					<td>" . $row["Bug Type"] . "</td>
					<td class='link'><a href='". $row["Bug Input"] ."' target='blank'>" . $download .  "<a></td>
					<td class='link'><a href='". $row["Bug Commit"] ."' target='blank'>" . $link .  "<a></td>
					<td class='link'><a href='". $row["Bug-fixing Commit"] ."' target='blank'>" . $link .  "<a></td>
					<td class='link'><a href='". $row["Regressed or not"] ."' target='blank'>" . $link .  "<a></td>
					<td><p class='fixed'>" . $row["Status (Verified or Fixed)"] . "</p></td>
					<td>" . $row["Report Date"] . "</td>
					<td>" . $row["Fixing Date"] . "</td>
					";
							  }} else { echo "No results found"; }
							}
						?>
                    </div>
                </div>

            <!-- table with dummy data -->
            <div class="container" data-aos="fade-in" data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="400">
                <table class="table" id="our-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Bug Type</th>
                            <th>Bug Input</th>
                            <th>Bug Commit</th>
                            <th>Fix Commit</th>
                            <th>Regression</th>
                            <th>Status</th>
                            <th>Report Date</th>
                            <th>Fix Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body"> <!-- table data will be generated within this <tbody> tag -->
                        <?php
                            $servername = "sql300.epizy.com"; // change to sql300.epizy.com
                            $username = "epiz_32617535"; //change credentials to infinity free login for cpanel epiz_32617535
                            $password = "o7NWrwBIBBjPs"; //change credentials to infinity free login for cpanel o7NWrwBIBBjPs
                            $database = "epiz_32617535_master2"; // IMPORTANT!!!!!!!!!!!!!!!!!!!!!!! change nscbugdataset to the database name on your machine, change to epiz_32617535_master2

                            // create a connection
                            $connection = new mysqli($servername, $username, $password, $database);

                            // check connection
                            if ($connection->connect_error) {
                                die("connection failed: " . $connection->connect_error);
                            }

                            $sqlQuery  = "SELECT * FROM `master2`"; // IMPORTANT!!!!!!!!!!!!!!!!!!!!!!! change master to table name on your machine, keep the same as master2 for now.
                            $result = $connection->query($sqlQuery);

                            $link = "LINK";
                            $download = "DOWNLOAD";

                            while ($row = $result->fetch_assoc()) {
                                echo " <tr>
                                <td class='name'>" . $row["_record_number"] . "</td>
                                <td>" . $row["Bug Type"] . "</td>
                                <td class='link'><a href='". $row["Bug Input"] ."' target='blank'>" . $download .  "<a></td>
                                <td class='link'><a href='". $row["Bug Commit"] ."' target='blank'>" . $link .  "<a></td>
                                <td class='link'><a href='". $row["Bug-fixing Commit"] ."' target='blank'>" . $link .  "<a></td>
                                <td class='link'><a href='". $row["Regressed or not"] ."' target='blank'>" . $link .  "<a></td>
                                <td><p class='fixed'>" . $row["Status (Verified or Fixed)"] . "</p></td>
                                <td>" . $row["Report Date"] . "</td>
                                <td>" . $row["Fixing Date"] . "</td>
                                ";
                            }

                        ?>
                    </tbody>
                    <script src="script.js"></script>
                </table>
            </div>

            <!-- this div let's us browse 1000+ records in pages instead of scrolling for eternity -->
            <div class="container">
                <div id="pagination-wrapper"></div>
            </div>

            <!-- <script src="./scripts/tablesearch.js"></script> -->
        </section>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

        <!-- <script src="./scripts/index.js"></script> -->
    </body>
</html>