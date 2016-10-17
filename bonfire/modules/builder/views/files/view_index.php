<?php

//------------------------------------------------------------------------------
// Setup the fields to be displayed in the view
//------------------------------------------------------------------------------
$field_prefix    = '';
$headers         = '';
$editColumnAdded = false;
$pager           = '';
$pencil_icon     = "'<span class=\"icon-pencil\"></span> ' . ";
$table_records   = '';

if ($usePagination) {
    $pager = "
    echo \$this->pagination->create_links();";
}

if ($db_required == 'new' && $table_as_field_prefix === true) {
    $field_prefix = "{$module_name_lower}_";
}

for ($counter = 1; $field_total >= $counter; $counter++) {
	// Only build on fields that have data entered.
	if (set_value("view_field_label$counter") == null
        || set_value("view_field_name$counter") == $primary_key_field
       ) {
		continue; // move onto next iteration of the loop
	}

	$label      = set_value("view_field_label$counter");
	$name       = set_value("view_field_name$counter");
    $field_name = "{$field_prefix}{$name}";

	$headers .= "
					<th><?php echo lang('{$module_name_lower}_field_{$name}'); ?></th>";

    // Instead of checking a specific $counter value, which may be skipped,
    // track whether the edit column has been added
	if ($editColumnAdded) {
		// When building from existing table, modify output of the 'deleted' maintenance column
		if  ($db_required == 'existing' && $field_name == $soft_delete_field) {
			$table_records .= "
					<td><?php echo \$record->{$field_name} > 0 ? lang('{$module_name_lower}_true') : lang('{$module_name_lower}_false'); ?></td>";
		} else {
			$table_records .= "
					<td><?php e(\$record->{$field_name}); ?></td>";
		}
    }
    // Add a link to the edit page on the first column
    else {
        $table_records .= "
				<?php if (\$can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/" . strtolower($controller_name) . "/{$module_name_lower}/edit/' . \$record->{$primary_key_field}, {$pencil_icon} \$record->{$field_name}); ?></td>
				<?php else : ?>
					<td><?php e(\$record->{$field_name}); ?></td>
				<?php endif; ?>";
        // Prevent the edit link from being added to multiple columns
        $editColumnAdded = true;
	}
}

// Only add maintenance columns to the view when module is creating a new db table
// (columns should already be present and handled above when existing table is used)
if ($db_required == 'new') {
	if ($useSoftDeletes) {
		$headers .= "
					<th><?php echo lang('{$module_name_lower}_column_deleted'); ?></th>";
		$table_records .= "
					<td><?php echo \$record->{$soft_delete_field} > 0 ? lang('{$module_name_lower}_true') : lang('{$module_name_lower}_false'); ?></td>";
		$field_total++;
	}
	if ($useCreated) {
		$headers .= "
					<th><?php echo lang('{$module_name_lower}_column_created'); ?></th>";
		$table_records .= "
					<td><?php e(\$record->{$created_field}); ?></td>";
		$field_total++;
	}
	if ($useModified) {
		$headers .= "
					<th><?php echo lang('{$module_name_lower}_column_modified'); ?></th>";
		$table_records .= "
					<td><?php e(\$record->{$modified_field}); ?></td>";
		$field_total++;
	}
}

$permissionName = preg_replace("/[ -]/", "_", ucfirst($module_name)) . '.' . ucfirst($controller_name);

//------------------------------------------------------------------------------
// Output the view
//------------------------------------------------------------------------------
echo '{$module_name_lower}_records_empty';