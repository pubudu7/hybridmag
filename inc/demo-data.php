<?php
/**
 * Demo setup data needed for our BNM Blocks plugin's demo importer.
 */
function hybridmag_import_files() {
    return array(
		array(
			'import_file_name'              => 'Demo Import 1',
			'categories'                    => array( 'Category 1', 'Category 2' ),
            'import_file_url'               => 'https://themezhut.com/demo/ocdi/hybridmag/demotest/demo-content.xml',
            'import_widget_file_url'        => 'https://themezhut.com/demo/ocdi/hybridmag/demotest/widgets.wie',
            'import_customizer_file_url'    => 'https://themezhut.com/demo/ocdi/hybridmag/demotest/customizer.dat',
            'import_preview_image_url'      => 'https://themezhut.com/demo/ocdi/hybridmag/demotest/screenshot.png',
			'import_notice'                 => __( 'After you import this demo, you will have to setup the slider separately.', 'hybridmag' ),
			'preview_url'                   => 'https://themezhut.com/demo/bam-pro/',
            'plan'                          => 'free'
		),
		/*array(
			'import_file_name'              => 'Demo Import 2',
			'categories'                    => array( 'New category', 'Old category' ),
            'import_file_url'               => 'https://themezhut.com/demo/ocdi/bam-pro/demo2/demo-content.xml',
            'import_widget_file_url'        => 'https://themezhut.com/demo/ocdi/bam-pro/demo2/widgets.wie',
            'import_customizer_file_url'    => 'https://themezhut.com/demo/ocdi/bam-pro/demo2/customizer.dat',
            'import_preview_image_url'      => 'https://themezhut.com/demo/ocdi/bam-pro/demo2/demo2.jpg',
			'import_notice'                 => __( 'A special note for this import.', 'hybridmag' ),
			'preview_url'                   => 'https://themezhut.com/demo/bam-pro-demo-2/',
		),
        array(
            'import_file_name'              => 'Demo 3',
            'import_file_url'               => 'https://themezhut.com/demo/ocdi/bam-pro/demo3/demo-content.xml',
            'import_widget_file_url'        => 'https://themezhut.com/demo/ocdi/bam-pro/demo3/widgets.wie',
            'import_customizer_file_url'    => 'https://themezhut.com/demo/ocdi/bam-pro/demo3/customizer.dat',
            'import_preview_image_url'      => 'https://themezhut.com/demo/ocdi/bam-pro/demo3/demo3.jpg',
			'preview_url'                   => 'https://themezhut.com/demo/bam-pro-demo-3/',
        ),
        array(
            'import_file_name'              => 'Demo 4',
            'import_file_url'               => 'https://themezhut.com/demo/ocdi/bam-pro/demo4/demo-content.xml',
            'import_widget_file_url'        => 'https://themezhut.com/demo/ocdi/bam-pro/demo4/widgets.wie',
            'import_customizer_file_url'    => 'https://themezhut.com/demo/ocdi/bam-pro/demo4/customizer.dat',
            'import_preview_image_url'      => 'https://themezhut.com/demo/ocdi/bam-pro/demo4/demo4.jpg',
			'preview_url'                   => 'https://themezhut.com/demo/bam-pro-demo-4/',
        ),
        array(
            'import_file_name'              => 'Demo 5',
            'import_file_url'               => 'https://themezhut.com/demo/ocdi/bam-pro/demo5/demo-content.xml',
            'import_widget_file_url'        => 'https://themezhut.com/demo/ocdi/bam-pro/demo5/widgets.wie',
            'import_customizer_file_url'    => 'https://themezhut.com/demo/ocdi/bam-pro/demo5/customizer.dat',
            'import_preview_image_url'      => 'https://themezhut.com/demo/ocdi/bam-pro/demo5/demo5.jpg',
			'preview_url'                   => 'https://themezhut.com/demo/bam-pro-demo-5/',
        )*/
	);
}
add_filter( 'bnmbt_import_files', 'hybridmag_import_files' );

/**
 * This information is needed for the demo importer to function properly.
 */
function hybridmag_demo_importer_display_location() {
    return array(
        'parent_slug'   => 'themes.php',
        'menu_slug'     => 'hybridmag',
        'tab'           => 'starter-templates'
    );
}
add_filter( 'bnmbt_importer_display_location_data', 'hybridmag_demo_importer_display_location' );