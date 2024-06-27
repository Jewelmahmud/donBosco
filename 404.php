<?php get_header(); ?>


<div class="error-404 text-center">
      <div class="side-icon position-absolute right d-none d-lg-block">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/404-home-icon-r.svg" alt="404 home icon" class="img-fluid">
      </div>
      <div class="side-icon position-absolute left d-none d-lg-block">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/404-home-icon-l.svg" alt="404 home icon" class="img-fluid">
      </div>
      <div class="content text-white">
        <h1 class="text-404">404</h1>
        <h2><strong>Oops!</strong> Pagina niet gevonden</h2>
        <p>Onze fout. Misschien bestaat de pagina die je zocht niet meer. Of is hij verplaatst. Klik hieronder om terug te gaan naar de homepagina. Succes!</p>
        <a href="<?php echo site_url();?>" class="btn btn-primary">Terug naar homepagina</a>
    </div>
</div>

</div>


<?php get_footer(); ?>