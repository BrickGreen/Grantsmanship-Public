<?php 
	
	$drop_titles = array();

	foreach ($titles as $title) {
		$drop_titles[$title["PROJECT_TITLE"]] = $title["PROJECT_TITLE"];
	}

	echo form_open('project/show_all_projects', 'name="title_drop"');

	echo form_dropdown('titles', $drop_titles);

	echo form_submit('sub_btn', 'View Project');

	echo form_close();

?>