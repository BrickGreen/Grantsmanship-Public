<div class="container">
<?php echo form_open('', 'name="title_dropdown"', 'class="snip_table"'); ?>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="2%"></th>
				<th width="6%">Title</th>
				<th width="70%">Snippet</th>
			</tr>
		</thead>
		<tbody>
	<?php
		$i = 0;
		foreach ($snippets as $snippet) {
			echo " <tr> ";
			echo ' <td align="center"> ';
			echo "<input  type='checkbox' name='checkbox[]' class='checkbox' value=$i>";
			echo ' <td> ';
			echo $snippet['SNIPPET_TITLE'];
			echo ' <td align="center"> ';
			echo $snippet['SNIPPET'];
			$i++;
		}
	?>
		</tbody>
	</table>
	<?php 
		$drop_titles = array();

		foreach ($titles as $title) {
			$drop_titles[$title["PROJECT_TITLE"]] = $title["PROJECT_TITLE"];
		}	
		echo form_dropdown('projecto_titles', $drop_titles,'', "class='proj-dropdown'");

		echo form_submit('insert', 'Insert', "class='btn btn-primary'");
		echo br(2);			

		echo form_close();
	?>

<?php 
	if($this->ion_auth->is_admin()) {
		echo form_open('', 'name="title_dropdown"');
		?> <hr style="border-width: 1px; border-color: #9e9e9e"> <?php
		echo br(2);

		echo form_label('New Title: ');
		echo form_input('snip_title');

		echo br(2);

		echo form_label('New Snippet: ');
		echo form_textarea('snippet');

		echo br(2);

		echo form_submit('new_insert', 'Insert New', "class='btn btn-primary'");
		echo form_close();
	} ?>
</div>