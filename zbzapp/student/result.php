<?php
require_once('../config.php');
require_once('loggedin.php');
$titleset="Result for Test:";
include('header.php');
?>
<style>

	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {

		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		tr { border: 1px solid #ccc; }
		
		td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee; 
			position: relative;
			padding-left: 50%; 
		}
		
		td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		td:nth-of-type(1):before { content: "Test Name"; }
		td:nth-of-type(2):before { content: "Average Marks"; }
	}
	
	/* Smartphones (portrait and landscape) ----------- */
	@media only screen
	and (min-device-width : 320px)
	and (max-device-width : 480px) {
		body { 
			padding: 0; 
			margin: 0; 
			width: 320px; }
		}

		/* iPads (portrait and landscape) ----------- */
		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
			body { 
				width: 495px; 
			}
		}

</style><style>

	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {

		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		tr { border: 1px solid #ccc; }
		
		td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee; 
			position: relative;
			padding-left: 50%; 
		}
		
		td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		td:nth-of-type(1):before { content: "Test ID"; }
		td:nth-of-type(2):before { content: "Course ID"; }
		td:nth-of-type(3):before { content: "Test Name"; }
		td:nth-of-type(4):before { content: "Test Description"; }
		td:nth-of-type(5):before { content: "Test Duration"; }
		td:nth-of-type(6):before { content: "Total Questions"; }
		td:nth-of-type(7):before { content: "Actions"; }
	}
	
	/* Smartphones (portrait and landscape) ----------- */
	@media only screen
	and (min-device-width : 320px)
	and (max-device-width : 480px) {
		body { 
			padding: 0; 
			margin: 0; 
			width: 320px; }
		}

		/* iPads (portrait and landscape) ----------- */
		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
			body { 
				width: 495px; 
			}
		}

</style>
<div class="wrapper">
	<div class="grids">
		<h2>Welcome to zBzQuiz Web App Interface</h2>

		<?php 
		if(checkIfStuLoggedIn($_SESSION['LoggedIn'],$_SESSION['stuname'])==1)
		{
		?>
			<div class="grid-10">
				<div id="chartdiv" style="height:400px;width:300px; "><div class="jqplot-target" id="chart1" style="height: 300px; width: 600px; position: relative;"></div></div>
				<table>
								<thead>
									<tr>
										<th>Test Name</th>
										<th>Average Marks</th>
									</tr>
								</thead>
					<tbody>
										<tr>
											<td>Test1</td>
											<td>14</td>
										</tr>
										<tr>
											<td>Test2</td>
											<td>32</td>
										</tr>
										<tr>
											<td>Test3</td>
											<td>41</td>
										</tr>
										<tr>
											<td>Test4</td>
											<td>44</td>
										</tr>
										<tr>
											<td>Test5</td>
											<td>40</td>
										</tr>
										<tr>
											<td>Test6</td>
											<td>47</td>
										</tr>
										<tr>
											<td>Test7</td>
											<td>53</td>
										</tr>
									</tbody>
				</table>

		<?php 
		}
		else
		{
			echo "<p><b>You are currently not logged in. You will have to <a href=\"index.php\">login</a> to access this page.</b></p>"; 
		}
		?>
		</div>
	</div>
	<!--end of grids-->
</div>
<!--end of wrapper-->
<hr />
<script type="text/javascript">

          $(document).ready(function(){
          var line1 = [14, 32, 41, 44, 40, 47, 53, 67];
          var plot1 = $.jqplot('chart1', [line1], {
              title: 'Average performance for Chem1',
              seriesDefaults: {
                showMarker:false,
                pointLabels: { show:true }
              },
              axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "Test",
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
          label: "Marks"
        	}
    	}
          });
        });
</script>
<?php
include('footer.php');
?>
