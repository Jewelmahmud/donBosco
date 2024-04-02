<?php get_header(); ?>


<section class="error-404 text-center">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icons/shape-7.svg" alt="" class="smile-vector d-none d-md-block position-absolute ani3">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icons/shape-6.svg" alt="" class="curved-line ani3 d-none d-md-block position-absolute">
    <div class="line-32x12 d-none d-md-block position-absolute ani4"></div>
    <div class="horizontal-bar1 d-none d-md-block position-absolute">
      <span class="circle ani4"></span>
    </div>
    <div class="horizontal-bar2 d-none d-md-block position-absolute">
      <span class="circle"></span>
    </div>
    <div class="vertical-bar d-none d-md-block position-absolute">
      <span class="line-52x17"></span>
    </div>
    <div class="content">
        <h1 class="text-404">4<span class="p-color">0</span>4</h1>
        <h2><strong><?php esc_html_e('Oops!', 'b2works'); ?></strong> <?php esc_html_e('Something went wrong', 'b2works'); ?></h2>
        <p><?php esc_html_e('This may be because the link has expired or the website is experiencing a few issues behind the scenes.', 'b2works'); ?></p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-secondary">
            <?php esc_html_e('Back to homepage', 'b2works'); ?>
        </a>
    </div>
  </section>


<?php get_footer(); ?>

<script>
  const b2Logo = initializeRive("rive/main-logo.riv", "main-logo", "b2Logo");
  const r8 = initializeRive("rive/logo-b2-white.riv", "logo-b2-white", "r8");
  const r9 = initializeRive("rive/line-white.riv", "line-white", "r9");
  const r10 = initializeRive("rive/smile-white.riv", "smile-rive3", "r10");
</script>