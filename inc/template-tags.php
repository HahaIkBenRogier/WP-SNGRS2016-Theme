<?php

function mellow_get_tax( $post, $post_type){

			global $ttrust_config;

			if( 'home' == $post_type ) {
				$tax = 'category';
            }
			else{
				$tax = $post_type;
            }
    

	        // Zero all variables each time function is run
			$ttrust_config['isotope_terms'] = array();
	        $ttrust_config['isotope_names'] = array();
	        $ttrust_config['isotope_class'] = '';

			$terms = get_the_terms( $post->ID, $tax );

			if ( $terms ) {
				foreach ( $terms as $term ) {
					$ttrust_config['isotope_terms'][] = $term->slug;
	                $ttrust_config['isotope_names'][] = $term->name;
				}

	            $ttrust_config['isotope_class'] = implode(' ', $ttrust_config['isotope_terms']);
			}

			return $ttrust_config;

	} // mellow_get_tax


function mellow_filter_nav( $tax, $page_skills = null ) {

		if( 'home' == $tax ) {
			$tax = 'category';
        }

		$args = array(
			'taxonomy'     => $tax,
			'orderby'      => 'slug',
			'hide_empty'   => 1
		);

		/** @var string $filter Comma-separated list of IDs for skill(s) when using filtered portfolio pages */
		$filter = mellow_filtered_portfolio();
            print_r($filter);

		if( $filter ){

			$filter = implode( ',', $filter);

			$args = array(
				'taxonomy'   => $tax,
				'orderby'    => 'slug',
				'include'    => $filter
			);

		}

		$categories = get_categories( $args );

		//Display FilterNav only if there is more than one skill
		if( sizeof( $categories ) > 0 ) { ?>
			<ul id="filter-nav" class="inline clearfix">
				<li class="all-btn"><a href="#" data-filter="*" class="selected"><?php _e( 'Alles', 'ridge' ); ?></a></li>
				<?php
				foreach( $categories as $pcat ) {

					$output = sprintf( '<li><a href="#" data-filter=".%1$s">%2$s</a></li>%3$s',
						esc_attr( $pcat->slug ),
						ucfirst( esc_attr( $pcat->name ) ),
						"\n"
					);

					echo $output;

				} // foreach

				?>
			</ul>
		<?php
		} // if

	} // mellow_filter_nav

?>