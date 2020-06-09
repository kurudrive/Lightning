<?php get_header(); ?>

<?php
if ( lightning_is_page_header_and_breadcrumb() ){

	// Dealing with old files.
	// Actually, it's ok to only use get_template_part().
	/*-------------------------------------------*/
	/* Page Header
	/*-------------------------------------------*/
	$old_file_name[] = 'module_pageTit.php';
	if ( locate_template( $old_file_name, false, false ) ) {
		locate_template( $old_file_name, true, false );
	} else {
		get_template_part( 'template-parts/page-header' );
	}
	/*-------------------------------------------*/
	/* BreadCrumb
	/*-------------------------------------------*/
	do_action( 'lightning_breadcrumb_before' );
	$old_file_name[] = 'module_panList.php';
	if ( locate_template( $old_file_name, false, false ) ) {
		locate_template( $old_file_name, true, false );
	} else {
		get_template_part( 'template-parts/breadcrumb' );
	}
	do_action( 'lightning_breadcrumb_after' );
} // if ( lightning_is_page_header_and_top_breadcrumb() ){
?>

<div class="<?php lightning_the_class_name( 'siteContent' ); ?>">
<?php do_action( 'lightning_siteContent_prepend' ); ?>
<div class="container">
<?php do_action( 'lightning_siteContent_container_prepend' ); ?>
<div class="row">
<div class="<?php lightning_the_class_name( 'mainSection' ); ?>" id="main" role="main">
<?php do_action( 'lightning_mainSection_prepend' ); ?>

<?php
if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action( 'lightning_entry_body_before' ); ?>
	<div class="<?php lightning_the_class_name( 'entry-body' ); ?>">
	<?php the_content(); ?>
	</div>
	<?php do_action( 'lightning_entry_body_after' ); ?>

	<?php
	$args = array(
		'before'      => '<nav class="page-link"><dl><dt>Pages :</dt><dd>',
		'after'       => '</dd></dl></nav>',
		'link_before' => '<span class="page-numbers">',
		'link_after'  => '</span>',
		'echo'        => 1,
	);
	wp_link_pages( $args );
	do_action( 'lightning_comment_space' );
	?>
	</article><!-- [ /#post-<?php the_ID(); ?> ] -->

	<?php
	endwhile;
};
?>
<?php do_action( 'lightning_mainSection_append' ); ?>
</div><!-- [ /.mainSection ] -->

<?php if ( lightning_is_subsection_display() ) : ?>
<div class="<?php lightning_the_class_name( 'sideSection' ); ?>">
<?php get_sidebar( get_post_type() ); ?>
</div><!-- [ /.subSection ] -->
<?php endif; ?>

</div><!-- [ /.row ] -->
<?php do_action( 'lightning_site_content_container_apepend' ); ?>
</div><!-- [ /.container ] -->
<?php do_action( 'lightning_site_content_apepend' ); ?>
</div><!-- [ /.siteContent ] -->
<?php get_footer(); ?>
