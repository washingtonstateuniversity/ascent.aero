<?php

class Ascent_UC_Project {
	/**
	 * Setup the extension.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );
	}

	/**
	 * Add meta boxes to the appropriate display.
	 *
	 * @param string $post_type
	 */
	public function add_meta_boxes( $post_type ) {
		if ( 'wsuwp_uc_project' !== $post_type ) {
			return;
		}

		add_meta_box( 'ascent-project-number', 'Project Number', array( $this, 'display_project_number_meta_box' ), null, 'normal', 'default' );
	}

	/**
	 * Display the meta box used to capture a project number.
	 *
	 * @param WP_Post $post
	 */
	public function display_project_number_meta_box( $post ) {
		$project_number = get_post_meta( $post->ID, '_ascent_uc_project_number', true );

		wp_nonce_field( 'ascent-project-nonce', '_ascent_project_nonce' );
		?>
		<label for="project-number">Project Number:</label>
		<input type="text" id="project-number" name="project_number" value="<?php echo esc_attr( $project_number ); ?>" />
		<?php
	}

	/**
	 * Save post meta for the UC project type.
	 *
	 * @param int $post_id
	 * @param WP_Post $post
	 */
	public function save_post( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( 'wsuwp_uc_project' !== $post->post_type ) {
			return;
		}

		if ( 'auto-draft' === $post->post_status ) {
			return;
		}

		if ( ! isset( $_POST['_ascent_project_nonce'] ) || false === wp_verify_nonce( $_POST['_ascent_project_nonce'], 'ascent-project-nonce' ) ) {
			return;
		}

		if ( ! isset( $_POST['project_number'] ) ) {
			return;
		}

		update_post_meta( $post_id, '_ascent_uc_project_number', sanitize_text_field( $_POST['project_number'] ) );
	}
}
new Ascent_UC_Project();