<?php
/* Plugin Name: My First Plugin */ 

// Set your own path here
include( dirname( __FILE__ ) . '/library/my-first-admin-page-framework.min.php' );
if ( ! class_exists( 'MyFirstPlugin_AdminPageFramework' ) ) {
    return;
}

class MyFirstPlugin extends MyFirstPlugin_AdminPageFramework {

    public function setUp() {

        $this->setRootMenuPage( 'Settings' ); 
        $this->addSubMenuItem(
            array(
                'title'     => 'My First Page',
                'page_slug' => 'my_first_page'
            )
        );

    }
    /**
     * Triggered in the middle of rendering the page.
     * 
     * Inserts your custom contents here.
     * 
     * @remark      do_{page slug}
     */
    public function do_my_first_page() {

        ?>
        <h3>Say Something</h3>
        <p>This is my first admin page!</p>
        <?php   

    }

}

new MyFirstPlugin;