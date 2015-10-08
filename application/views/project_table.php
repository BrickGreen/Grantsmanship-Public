<div class="container">
<?php
	
	echo form_open('project/show_project/'.$project['PROJECT_TITLE']);
?>
<fieldset>
<legend><?php echo $project['PROJECT_TITLE']?></legend>
<div class="row">
	<div class="col-md-4">
	<?php

	if($this->ion_auth->in_group($project['PROJECT_TITLE']) || $this->ion_auth->is_admin()) {

		echo form_label('Title: ');
		echo nbs(2);
		echo form_input('proj_title', $project['PROJECT_TITLE'], "class='proj-input'");
		echo br(2);

		echo form_label('Start Date: ');
		echo nbs(2);
		echo form_input('proj_start', $project['START_DATE'], "class='proj-input'");
		echo br(2);

		echo form_label('End Date: ');
		echo nbs(2);
		echo form_input('proj_end', $project['END_DATE'], "class='proj-input'");
		echo br(2);


		echo form_label('Amount: ');
		echo nbs(2);
		echo form_input('proj_amount', $project['AMOUNT'], "class='proj-input'");
		echo br(2);


		echo form_label('Due Date: ');
		echo nbs(2);
		echo form_input('proj_due', $project['APP_DUE_DATE'], "class='proj-input'");
		echo br(2);

		echo form_label('Sponsor: ');
		echo nbs(2);
		echo form_input('proj_sponsor', $project['SPONSOR'], "class='proj-input'");
		echo br(2);

		echo form_label('Maximum Length: ');
		echo nbs(2);
		echo form_input('proj_max_length', $project['MAXIMUM_LENGTH'], "class='proj-input'");
		echo br(2);

		echo form_label('LOI Due: ');
		echo nbs(2);
		echo form_input('proj_letter_due', $project['LETTER_DUE_DATE'], "class='proj-input'");
		echo br(2);

		echo form_label('Primary Investigator: ');
		echo nbs(2);
		echo form_input('primary_investigator', $project['PRIMARY_INVESTIGATOR'], "class='proj-input'");
		echo br(2);

	echo '</div>';
	echo '<div class="col-md-7 col-md-offset-1">';

	
	$y = 0;
	echo '<table>';
	foreach ($cus_snippets as $snippet) {
		echo '<tr>';
		echo '<td>'.form_label($snippet['SNIPPET_TITLE'].':', $snippet['SNIPPET_TITLE']);
		// echo br();

		
		if ($snippet['CUSTOM_SNIPPET'] == NULL) {
			echo '<td>'.form_textarea('custom_snippet[]', $generic_snippets[$y]['SNIPPET'], "class='proj-textarea'");
			++$y;
		} else {
			echo '<td>'.form_textarea('custom_snippet[]', $snippet['CUSTOM_SNIPPET'], "class='proj-textarea'");
		}
		echo br(2);
	}

	echo '</table>';

	echo br();
	$button_data = array('type' => 'submit', 'name' => 'save_btn', 'value' => 'form_save', 'content' => 'Save', 'class' => 'btn btn-primary');
	echo form_button($button_data);
	$cancel_btn = array('type' => 'submit', 'content' => 'Cancel', 'class' => 'btn btn-danger');
	echo form_button($cancel_btn);
	echo br(2);


	echo '</div>';

} else {
	echo form_label('Title: ');
	echo nbs(2);
	echo form_input('', $project['PROJECT_TITLE'], "disabled class='proj-input proj-input-dis text-center'");
	echo br(2);

	echo form_label('Start Date: ');
	echo nbs(2);
	echo form_input('', $project['START_DATE'], "disabled class='proj-input proj-input-dis text-center'");
	echo br(2);

	echo form_label('End Date: ');
	echo nbs(2);
	echo form_input('', $project['END_DATE'], "disabled class='proj-input proj-input-dis text-center'");
	echo br(2);


	echo form_label('Amount: ');
	echo nbs(2);
	echo form_input('', $project['AMOUNT'], "disabled class='proj-input proj-input-dis text-center'");
	echo br(2);


	echo form_label('Due Date: ');
	echo nbs(2);
	echo form_input('', $project['APP_DUE_DATE'], "disabled class='proj-input proj-input-dis text-center'");
	echo br(2);

	echo form_label('Sponsor: ');
	echo nbs(2);
	echo form_input('', $project['SPONSOR'], "disabled class='proj-input proj-input-dis text-center'");
	echo br(2);

	echo form_label('Maximum Length: ');
	echo nbs(2);
	echo form_input('', $project['MAXIMUM_LENGTH'], "disabled class='proj-input proj-input-dis text-center'");
	echo br(2);

	echo form_label('LOI Due: ');
	echo nbs(2);
	echo form_input('', $project['LETTER_DUE_DATE'], "disabled class='proj-input proj-input-dis text-center'");
	echo br(2);

	echo form_label('Primary Investigator: ');
	echo nbs(2);
	echo form_input('', $project['PRIMARY_INVESTIGATOR'], "disabled class='proj-input proj-input-dis text-center'");
	echo br(2);



	foreach ($cus_snippets as $snippet) {
		echo form_label($snippet['SNIPPET_TITLE'].':', $snippet['SNIPPET_TITLE']);
		echo br();

		$x = 0;
		if ($snippet['CUSTOM_SNIPPET'] == NULL) {
			echo form_textarea('custom_snippet[]', $generic_snippets[$x]['SNIPPET'], "disabled class='proj-textarea proj-textarea-dis text-center'");
		} else {
			echo form_textarea('custom_snippet[]', $snippet['CUSTOM_SNIPPET'], "disabled class='proj-textarea proj-textarea-dis text-center'");
		}
		$x++;
		echo br(2);
	}
}
?>
</fieldset>
<?php
echo form_close();

?>

</div>