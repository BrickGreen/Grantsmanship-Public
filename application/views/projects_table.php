<div class="container panel panel-grant">
<div class="panel-heading">
	<h2>Current Projects</h2>
</div>
<div class="panel-body">
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Title</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Amount</th>
			<th>Submission Date</th>
			<th>Sponsor</th>
			<th>Max Length</th>
			<th>Primary Investigator</th>
		</tr>
	</thead>
	<tbody>

	<?php 
	$i = 0;

	foreach ($projects as $project_item) {
		echo " <tr> ";
		echo ' <td > ';
		echo $project_item['PROJECT_TITLE'];
		echo ' <td > ';
		echo $project_item['START_DATE'];
		echo ' <td > ';
		echo $project_item['END_DATE']; 
		echo ' <td > ';
		echo $project_item['AMOUNT'];
		echo ' <td > ';
		echo $project_item['APP_DUE_DATE'];
		echo ' <td > ';
		echo $project_item['SPONSOR'];
		echo ' <td > ';
		echo $project_item['MAXIMUM_LENGTH'];
		echo ' <td > ';
		echo $project_item['LETTER_DUE_DATE'];
		echo ' <td > ';
		echo $project_item['PRIMARY_INVESTIGATOR'];              
		$i++;
	}
	?>
	</tbody>
</table>

<br>

<?php 

	$drop_titles = array();

	foreach ($titles as $title) {
		$drop_titles[$title["PROJECT_TITLE"]] = $title["PROJECT_TITLE"];
	}

	echo form_open('project/show_all_projects', 'name="title_drop"');

	echo form_dropdown('titles', $drop_titles,'', "class='proj-dropdown'");

	echo form_submit('sub_btn', 'View Project', "class='btn btn-primary'");

	echo form_close();

?>
</div>
</div>