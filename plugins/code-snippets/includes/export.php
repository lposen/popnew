<?php

/**
 * This file handles the export functions
 *
 * It's better to call the $code_snippets->export()
 * and $code_snippets->export_php() methods then
 * directly use those in this file
 *
 * @package    Code_Snippets
 * @subpackage Functions
 */

if ( ! function_exists( 'code_snippets_export' ) ) :

/**
 * Exports selected snippets to a XML or PHP file.
 *
 * @since  1.3
 * @param  array  $ids    The IDs of the snippets to export
 * @param  string $format The format of the export file
 * @return void
 */
function code_snippets_export( $ids, $format = 'xml' ) {

	global $wpdb, $code_snippets;
	$ids = (array) $ids;

	if ( 1 === count( $ids ) ) {
		/* If there is only snippet to export, use its name instead of the site name */
		$snippet  = $code_snippets->get_snippet( $ids );
		$sitename = strtolower( $snippet->name );
	} else {
		/* Otherwise, use the site name as set in Settings > General */
		$sitename = strtolower( get_bloginfo( 'name' ) );
	}

	$filename = sanitize_file_name( apply_filters(
		'code_snippets/export/filename',
		"{$sitename}.code-snippets.{$format}",
		$format, $sitename
	) );

	/* Apply the file headers */

	header( 'Content-Disposition: attachment; filename=' . $filename );

	if ( $format === 'xml' ) {
		header( 'Content-Type: text/xml; charset=' . get_bloginfo('charset') );

		echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . "\" ?>\n";

		?>
<!-- This is a code snippets export file generated by the Code Snippets WordPress plugin. -->
<!-- http://wordpress.org/plugins/code-snippets -->

<!-- To import these snippets a WordPress site follow these steps: -->
<!-- 1. Log in to that site as an administrator. -->
<!-- 2. Install the Code Snippets plugin using the directions provided at the above link. -->
<!-- 3. Go to 'Tools: Import' in the WordPress admin panel. -->
<!-- 4. Click on the "Code Snippets" importer in the list -->
<!-- 5. Upload this file using the form provided on that page. -->
<!-- 6. Code Snippets will then import all of the snippets and associated information -->
<!--    contained in this file into your site. -->
<!-- 7. You will then have to visit the 'Snippets: Manage' admin menu and activate desired snippets -->

<?php

		/* Run the generator line through the standard WordPress filter */
		$gen  = sprinf (
			'<!-- generator="Code Snippets/%s" created="%s" -->',
			$code_snippets->version,
			date('Y-m-d H:i')
		);
		$type = 'code_snippets_export';
		echo apply_filters( "get_the_generator_$type", $gen, $type );

		/* Start the XML section */
		echo "\n<snippets>";

	} elseif ( 'php' === $format ) {

		echo "<?php\n";

	}

	do_action( 'code_snippets/export/after_header', $format, $ids, $filename );

	/* Loop through the snippets */

	$table   = $code_snippets->get_table_name();
	$exclude = apply_filters( 'code_snippets/export/exclude_from_export', array( 'id', 'active' ) );

	foreach ( $ids as $id ) {

		/* Grab the snippet from the database */
		$snippet = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id = %d", $id ), ARRAY_A );

		/* Remove slashes */
		$snippet = stripslashes_deep( $snippet );

		if ( 'xml' === $format ) {

			echo "\n\t" . '<snippet>';

			foreach ( $snippet as $field => $value ) {

				/*  Don't export certain fields */
				if ( in_array( $field, $exclude ) )
					continue;

				/* Output the field and value as indented XML */
				if ( $value = apply_filters( "code_snippets/export/$field", $value ) )
					echo "\n\t\t<$field>$value</$field>";
			}
			echo "\n\t" . '</snippet>';
		}
		elseif ( 'php' === $format ) {

			echo "\n/**\n * {$snippet['name']}\n";

			if ( ! empty( $snippet['description'] ) ) {

				/* Convert description to PhpDoc */
				$desc = strip_tags( str_replace( "\n", "\n * ", $snippet['description'] ) );

				echo " *\n * $desc\n";
			}

			echo " */\n{$snippet['code']}\n";
		}
	}

	do_action( 'code_snippets/export/after_snippets', $format, $id, $filename );

	/* Finish off the file */

	if ( 'xml' === $format ) {

		echo "\n</snippets>";

	} elseif ( 'php' === $format ) {

		echo '?>';

	}

	do_action( 'code_snippets/export/after_footer', $format, $ids, $filename );

	exit;
}

endif; // function exists check
