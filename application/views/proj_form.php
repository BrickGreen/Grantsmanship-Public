<div class="container">
	<div class="panel panel-grant project-form">
		<div class="panel-heading">
			<h1><?php echo $title; ?></h1>
		</div>
		<div class="panel-body">
			<?php

			// echo validation_errors();
			echo form_open('project/create_form');

			echo form_label('Title: ');
			echo form_input('proj_title');
			echo br(2);

			echo form_label('Start Date: ');
			echo form_input('proj_start');
			echo br(2);

			echo form_label('End Date: ');
			echo form_input('proj_end');
			echo br(2);


			echo form_label('Amount: ');
			echo form_input('proj_amount');
			echo br(2);


			echo form_label('Due Date: ');
			echo form_input('proj_due');
			echo br(2);

			echo form_label('Sponsor: ');
			echo form_input('proj_sponsor');
			echo br(2);

			echo form_label('Maximum Length: ');
			echo form_input('proj_max_length');
			echo br(2);

			echo form_label('LOI Due: ');
			echo form_input('proj_letter_due');
			echo br(2);

			echo form_label('Primary Investigator: ');
			echo form_input('primary_investigator');
			echo br(3);

			echo 'Select project users:';
			echo br(2);

			foreach ($users as $user) {
				echo form_checkbox('checkbox[]', $user->id);
				echo form_label($user->first_name." ".$user->last_name." (".$user->company.")");
				echo br();
			}
			echo br();
			echo form_submit('submit', 'Submit');
			echo form_close();

			?>
		</div>	
	</div>
</div>