<?php
mysql_connect("sql300.epizy.com","epiz_32617535","o7NWrwBIBBjPs") or die("could not connect to database");
mysql_select_db(epiz_32617535_master2) or die("could not select database");

//collecting of the script
if(isset($_POST['search'])) {
	$searching_query = $_POST['search'];
	$searching_query = preg_replace("#[^0-9a-zA-Z]#i","",$searching_query);
	
	$query = mysql_query("SELECT * FROM master2 WHERE Bug Type LIKE '%$searching_query%' OR Regressed or not LIKE '%$searching_query%' OR Status (Verified or Fixed) LIKE '%$searching_query%' OR Report Date LIKE '%$searching_query%' OR Fixing Date LIKE '%$searching_query%' order by Report Date") or die("could not search");
	$search_count - mysql_num_rows($query);
	if($search_count == 0){
		$search_output = 'There was no search results';
	}else{
		while($row = mysql_fetch_array($query)) {
			$_record_number = $row["_record_number"];
			$bug_type = $row["Bug Type"];
			$bug_input = $row["Bug Input"];
			$bug_commit = $row["Bug Commit"];
			$bug_fixing_commit = $row["Bug-fixing Commit"];
			$regressed_or_not = $row["Regressed or not"];
			$status = $row["Status (Verified or Fixed)"];
			$report_date = $row["Report Date"];
			$fixing_date = $row["Fixing Date"];
			$link = "LINK";
			$download = "DOWNLOAD";	
		
			$search_output .= 
				" <tr>
				<td class='name'>" . $_record_number . "</td>
				<td>" . $bug_type . "</td>
				<td class='link'><a href='". $bug_input ."' target='blank'>" . $download .  "<a></td>
				<td class='link'><a href='". $bug_commit ."' target='blank'>" . $link .  "<a></td>
				<td class='link'><a href='". $bug_fixing_commit ."' target='blank'>" . $link .  "<a></td>
				<td class='link'><a href='". $regressed_or_not ."' target='blank'>" . $link .  "<a></td>
				<td><p class='fixed'>" . $status . "</p></td>
				<td>" . $report_date . "</td>
				<td>" . $fixing_date . "</td>
				";
		}
	}
}
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
    <link rel="stylesheet" href="./Styles/styles.css">
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
				<div class="current"><li><div class="nav_hover"><a href="index.php"><img src="./images/home.png" alt="">Home</a></div></li></div>
				<li><div class="nav_hover"><a href="about.php"><img src="./images/about.png" alt="">About</a></div></li>
				<li><div class="nav_hover"><a href="search.php"><img src="./images/search.png" alt="">Search</a></div></li> <!-- please change the image to a search image -->
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
				<img src="./images/logo.jpg" alt="">
			</div>
		</div>	
	
		<div class="left"> 
			<div class="left_search">
				<form action="search.php" method="post">
					<img src="images/search.png" alt="">
					<input type="text" placeholder="Search bugs..." size="60" name="search" />
					<input type="submit" name="submit" />
				</form>
			</div>
		</div>
		
		<?php print("$search_output");?>

	</body>
</html>

