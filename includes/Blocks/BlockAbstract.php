<?php


namespace InteractiveLesson\Blocks;
use WP_Block;

defined( 'ABSPATH' ) || exit;

abstract class BlockAbstract {
	/**
	 * Block namespace.
	 *
	 * @var string
	 */
	protected string $namespace = 'interactive-lesson';
	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected string $block_name = '';

	/**
	 * Attributes.
	 *
	 * @var array
	 */
	protected array $attributes = array();

	/**
	 * Block content.
	 *
	 * @var string
	 */
	protected string $content = '';

	/**
	 * Block instance.
	 *
	 * @var \WP_Block
	 */
	protected WP_Block $block;

	/**
	 * Constructor.
	 *
	 * @param string $block_name Block name.
	 */
	public function __construct( string $block_name = '' ) {
		$this->block_name = empty( $block_name ) ? $this->block_name : $block_name;
		$this->register();
	}

	/**
	 * Register.
	 *
	 * @return void
	 */
	protected function register(): void {
		if ( empty( $this->block_name ) ) {
			_doing_it_wrong( __CLASS__, esc_html__( 'Block name is not set.', 'interactive-lesson' ), IL_VERSION );

			return;
		}
		$metadata = $this->get_metadata_base_dir() . "/$this->block_name/block.json";

		if ( ! file_exists( $metadata ) ) {
			_doing_it_wrong(
				__CLASS__,
				/* Translators: 1: Block name */
				esc_html( sprintf( __( 'Metadata file for %s block does not exist.', 'interactive-lesson' ), $this->block_name ) ),
				IL_VERSION
			);

			return;
		}
		
		register_block_type_from_metadata(
			$metadata,
			array(
				'render_callback' => array( $this, 'render' ),
			)
		);
	}

	/**
	 * Get base metadata path.
	 * npm
	 *
	 * @return string
	 */
	protected function get_metadata_base_dir(): string {
		return dirname( IL_PLUGIN_FILE ) . '/chunks';
	}

	/**
	 * Get block type.
	 *
	 * @return string
	 */
	protected function get_block_type(): string {
		return "$this->namespace/$this->block_name";
	}

	/**
	 * Render callback.
	 *
	 * @param array $attributes Block attributes.
	 * @param string $content Block content.
	 * @param \WP_Block $block Block object.
	 *
	 * @return string
	 */
	public function render( array $attributes, string $content, WP_Block $block ): string {
		$this->attributes = $attributes;
		$this->block      = $block;
		$this->content    = $content;


		return apply_filters(
			"interactive_lesson_{$this->block_name}_content",
			$this->build_html( $this->content ),
			$this
		);
	}

	/**
	 * build_html
	 *
	 * @param $content
	 *
	 * @return mixed
	 */
	protected function build_html(  $content ) {
		return $content;
	}
}
