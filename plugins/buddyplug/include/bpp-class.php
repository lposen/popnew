<?php
/*
BuddyPlug Pluings API class
*/
class BPP_BuddyPress_Plugins {

	public $tag = 'buddyplug';

	function __construct() {
		add_filter( 'install_plugins_tabs', array( $this, 'add_buddypress_tab' ) );

		add_action( 'install_plugins_buddypress', array( $this, 'install_plugins_buddypress' ), 10, 1 );
		add_action( 'install_plugins_pre_buddypress', array( $this, 'get_buddypress_plugins' ) );
		add_action( 'install_plugins_buddypress', 'display_plugins_table');

	}

	function add_buddypress_tab( $tabs ) {
		$tabs['buddypress'] = __( 'BuddyPress' );
		return $tabs;
	}

	function install_plugins_buddypress() {

		$plugins = get_plugins('/buddypress');
		$plugins_active = is_plugin_active('buddypress/bp-loader.php');

		if ( isset( $_GET['filter'] ) && $_GET['filter'] == 'buddypress' ) {


		} else {

			if ( !$plugins ) {

				echo '<div class="updated settings-error"><p><strong>BuddyPress is not installed. <a href="plugin-install.php?tab=buddypress&filter=buddypress">To install BuddyPress click here</a></strong></p></div>';

			}
		}

		if ( !$plugins_active && $plugins ) {

			echo '<div class="updated settings-error"><p><strong>BuddyPress is not activated. <a href="plugins.php">To activate BuddyPress click here</a></strong></p></div>';

		}

?>			<?php if ( isset( $_GET['filter'] ) && $_GET['filter'] == 'buddypress' ): ?>
			<?php else : ?>
			<ul class="subsubsub">
				<li><a class="button" href="plugin-install.php?tab=buddypress">Curated</a></li>
				<li><a class="button" href="plugin-install.php?tab=buddypress&filter=all">All</a></li>
				<li><a class="button" href="plugin-install.php?tab=buddypress&filter=developer">Developer</a></li>
			</ul>
			 <?php endif ; ?>


			<br class="clear">
			<?php if ( isset( $_GET['filter'] ) && $_GET['filter'] == 'all' ): ?>

            <p><?php _e( 'All plugins tagged buddypress on WordPress.org. Not all of these plugins are updated.' ); ?></p>

            <?php elseif ( isset( $_GET['filter'] ) && $_GET['filter'] == 'developer' ): ?>

            <p><?php _e( 'Developer plugins to help you learn how to create and extend BuddyPress.' ); ?></p>

            <?php elseif ( isset( $_GET['filter'] ) && $_GET['filter'] == 'buddypress' ): ?>

            <div class="updated settings-error"><p><strong>Click Install now and activate BuddyPress</strong></p></div>

            <?php else : ?>

            <p><?php _e( 'Curated List of BuddyPress plugins hosted on WordPress.org that are real, updated and working. This list is community curated, if you know a working plugin not listed, post an issue here (<a href="https://github.com/modemlooper/BuddyPlug">BuddyPlug</a>).' ); ?></p>

            <?php endif ; ?>

        <?php
	}

	function get_buddypress_plugins() {
		global $wp_list_table, $paged;

		$paged = $wp_list_table->get_pagenum();
		$per_page = 20;

		if ( $this->tag ) {

			if ( isset( $_GET['filter'] ) && $_GET['filter'] == 'all' ) {
				$args = array( 'tag' => 'buddypress', 'page' => $paged, 'per_page' => $per_page, );
			} else if ( isset( $_GET['filter'] ) && $_GET['filter'] == 'developer' ) {
				$args = array( 'user' => 'buddyplugdev', 'page' => $paged, 'per_page' => $per_page, );
			} else if (  isset( $_GET['filter'] ) && $_GET['filter'] == 'buddypress' ) {
				$args = array( 'user' => 'buddyplugbp', 'page' => $paged, 'per_page' => $per_page, );
			} else {
				$args = array( 'user' => $this->tag, 'page' => $paged, 'per_page' => $per_page, );
			}

			$api = plugins_api( 'query_plugins', $args );

			$wp_list_table->items = $api->plugins;
			$wp_list_table->set_pagination_args(
				array(
					'total_items' => $api->info['results'],
					'per_page' => $per_page,
				)
			);

		} else {
			$args = false;
		}
	}

}