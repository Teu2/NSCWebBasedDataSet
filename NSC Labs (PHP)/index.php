
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
                    <h1>DATABASE</h1>
                </div>
                <div class="right_logo">
                    <img src="images/logo.jpg" alt="">  
                </div>
            </div>

            <!-- search bar -->
            <div class="search_sort" data-aos="fade-in" data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="400"> 
                <div class="left"> 
                    <form action="" method="GET">
                        <div class="left_search">
                            <img src="images/search.png" alt="">
                            <input type="text" placeholder="Search bugs..." size="60" id="myInput" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>">
                            <!-- <button type="submit" id="search_button" value="">Search</button> -->
                        </div>
                    </form>
                </div>

                <!-- drop down box -->
                <div class="right_sort" data-aos="fade-in" data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="400">
                    <div include="form-input-select()" class="select_box">
                        <form action="" method="GET">
                            <select name="sorted" onchange="this.form.submit()">
                                <option value="" hidden>Sort by... </option>
                                <option value="reportDateNew" <?php if(isset($_GET['sorted'])) {echo $_GET['sorted'];} ?> >Report Date (Newest)</option>
                                <option value="reportDateOld" <?php if(isset($_GET['sorted'])) {echo $_GET['sorted'];} ?> >Report Date (Oldest)</option>
                                <option value="fixDateNew" <?php if(isset($_GET['sorted'])) {echo $_GET['sorted'];} ?> >Fix Date (Newest)</option>
                                <option value="fixDateOld" <?php if(isset($_GET['sorted'])) {echo $_GET['sorted'];} ?> >Fix Date (Oldest)</option>
                                <option value="bugNumberHighest" <?php if(isset($_GET['sorted'])) {echo $_GET['sorted'];} ?> >Bug Number (Highest)</option>
                                <option value="bugNumberLowest" <?php if(isset($_GET['sorted'])) {echo $_GET['sorted'];} ?> >Fix Date (Lowest)</option>
                            </select>
                        </form>
                      </div>
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

                            $link = "LINK";
                            $download = "DOWNLOAD";

                            if(isset($_GET['search'])){

                                $searchedItem = $_GET['search'];
                                $filteredValues = $_GET['search'];
                                $filteredValues = cleanSearchString($searchedItem);
                                $filteredValues = str_replace(" ","", $filteredValues);

                                switch (true) { 

                                    case stristr($searchedItem, 'report') || stristr($searchedItem, 'Report'):
                                        $query = "SELECT * FROM `master2` WHERE CONCAT(reportDate) LIKE '%$filteredValues%'";
                                        runQuery($connection, $query);
                                        break;

                                    case stristr($searchedItem, 'fixing') || stristr($searchedItem, 'fix'):
                                        $query = "SELECT * FROM `master2` WHERE CONCAT(fixingDate) LIKE '%$filteredValues%'";
                                        runQuery($connection, $query);
                                        break;

                                    case searchIsDate($searchedItem): 
                                        $query = "SELECT * FROM `master2` WHERE CONCAT(reportDate, fixingDate) LIKE '%$filteredValues%'";
                                        runQuery($connection, $query);
                                        break;

                                    case  is_numeric($searchedItem): 
                                        //echo "<br/><b>string contains: </b> <br/>".$searchedItem;
                                        $query = "SELECT * FROM `master2` WHERE CONCAT(_record_number) LIKE '%$filteredValues%'";
                                        runQuery($connection, $query); 
                                        break;

                                    case stristr($searchedItem, 'security') || stristr($searchedItem, 'bug-security'): 
                                        $filteredValues = str_replace( array("bug", "Bug"), "", $filteredValues);
                                        $query = "SELECT * FROM `master2` WHERE CONCAT(bugType) LIKE '%$filteredValues%'";
                                        runQuery($connection, $query);
                                        break;

                                    case stristr($searchedItem, 'bug') || stristr($searchedItem, 'Bug'): 
                                        $filteredValues = str_replace("+","", $filteredValues);
                                        $query = "SELECT * FROM `master2` WHERE binary bugType = `%$filteredValues%`";
                                        runQuery($connection, $query);
                                        break;

                                    case stristr($searchedItem, 'not') || stristr($searchedItem, 'not regressed'): 
                                        $filteredValues = str_replace("regressed","", $filteredValues);
                                        $query = "SELECT * FROM `master2` WHERE CONCAT(regressedOrNot) LIKE '%$filteredValues%'";
                                        runQuery($connection, $query);
                                        break;

                                    case empty($_GET['search']) : 
                                        $sqlQuery  = "SELECT * FROM `master2`"; // IMPORTANT!!!!!!!!!!!!!!!!!!!!!!! change master to table name on your machine
                                        $result = $connection->query($sqlQuery);
                                        createTable($result);
                                        break;

                                    default: echo "<tr><td colspan='9'>No Records Found</td></tr>"; break;
                                }

                            } else if (isset($_GET['sorted'])){
                                sortData($connection);

                            } else {
                                $sqlQuery  = "SELECT * FROM `master2`"; // IMPORTANT!!!!!!!!!!!!!!!!!!!!!!! change master to table name on your machine
                                $result = $connection->query($sqlQuery);
                                createTable($result);
                            }

                        ?>
                        <?php

                            function createTable($resultRows){
                                $download = "DOWNLOAD";
                                $link = "LINK";

                                while ($row = $resultRows->fetch_assoc()) {
                                    echo " <tr>
                                    <td class='name'>" . $row["_record_number"] . "</td>
                                    <td>" . $row["bugType"] . "</td>
                                    <td class='link'><a href='". $row["bugInput"] ."' target='blank'>" . $download .  "<a></td>
                                    <td class='link'><a href='". $row["bugCommit"] ."' target='blank'>" . $link .  "<a></td>
                                    <td class='link'><a href='". $row["bugFixingCommit"] ."' target='blank'>" . $link .  "<a></td>";
                                    
                                    if ($row["regressedOrNot"] === "Not" || $row["regressedOrNot"] === "not" ) {
                                        echo "<td> Not </td>";
                                    } else {
                                        echo "<td class='link'><a href='". $row["regressedOrNot"] ."' target='blank'>" . $link .  "<a></td>";
                                    }
                                    
                                    echo "<td><p class='fixed'>" . $row["bugStatus"] . "</p></td>
                                    <td>" . $row["reportDate"] . "</td>
                                    <td>" . $row["fixingDate"] . "</td>
                                    ";
                                }

                                // echo "<br/><b>query: </b> <br/>".$query;
                            }

                            function cleanSearchString($str){
                                $resultStr = str_replace( array("report", "Report", "fix", "Fix", "ing", "date", "Date"), '', $str);
                                return $resultStr;
                            }

                            function runQuery($connection, $query){
                                $query_run = mysqli_query($connection, $query);
                                // echo "<br/><b>query: </b> <br/>".$query;

                                if (mysqli_num_rows($query_run) > 0 || empty($_GET['search'])) { 
                                    $results = $connection->query($query);
                                    createTable($results);
                                } else {
                                    echo "<tr><td colspan='9'>No Records Found</td></tr>";
                                }
                            }

                            function searchIsDate($str){
                                if (substr_count($str, '-') > 1){
                                    return true;
                                }
                            }

                            function sortData($connection){ 
                                if(isset($_GET['sorted'])){
    
                                    switch ($_GET['sorted']) {
                                        case "reportDateNew": $query = "SELECT * FROM `master2` ORDER BY reportDate desc"; 
                                            runQuery($connection, $query);
                                            break;
                                            
                                        case "reportDateOld": $query = "SELECT * FROM `master2` ORDER BY reportDate asc"; 
                                            runQuery($connection, $query);
                                            break;

                                        case "fixDateNew": 
                                            $query = "SELECT * FROM `master2` ORDER BY fixingDate desc"; 
                                            runQuery($connection, $query); break;

                                        case "fixDateOld": 
                                            $query = "SELECT * FROM `master2` ORDER BY fixingDate asc"; 
                                            runQuery($connection, $query); break;

                                        case "bugNumberHighest": 
                                            $query = "SELECT * FROM `master2` ORDER BY _record_number desc"; 
                                            runQuery($connection, $query); break;

                                        case "bugNumberLowest": 
                                            $query = "SELECT * FROM `master2` ORDER BY _record_number asc"; 
                                            runQuery($connection, $query); break;
                                    }
                                }
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
        </section> <!-- end of heading section-->

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

        <!-- <script src="./scripts/index.js"></script> -->
    </body>
</html>
