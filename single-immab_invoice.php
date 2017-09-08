<?php
get_header();
the_post();

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">


        <div class="container-fluid" >

            <div class="container  " >
        <div class="container" >
            <div class="prog-page ">


                <div class="prof-page-info">
                    <div class="row">



                        <div class="col-md-12">


                            <div class="prof-info">

                                <div class="info"><h1><?php   the_field(kund_namn); ?></h1></div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="container" >
            <div class="prog-page ">


                <div class="prof-page-info">
                    <div class="row">



                        <div class="col-md-12">


                            <div class="prof-info">
                                <?php if( !post_password_required( $post )): ?>
                                <div class="info"><label><i class="fa fa-user"></i>Kundens namn :</label>  <span><?php  the_field('kund_namn'); ?></span></div>
                                <div class="info"><label><i class="fa fa-calendar"></i>Födelsedatum :</label>  <span><?php  the_field('kund_birthday'); ?></span></div>
                                <div class="info"><label><i class="fa fa-envelope"></i>E-post :</label>  <span><?php  the_field('kund_epost'); ?></span></div>
                                <div class="info"><label><i class="fa fa-map-marker"></i>Adress :</label>  <span><?php  the_field('kund_adress'); ?></span></div>
                                <div class="info"><label><i class="fa fa-phone"></i>Telefonnummer :</label>  <span><?php  the_field('kund_tel'); ?></span></div>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
            <br>
        <div class="container" >
            <div class="prog-page ">


                <div class="prof-page-info">
                    <div class="row">



                        <div class="col-md-12">


                            <div class="prof-info">

                                <div class="info"><label><i class="fa fa-money"></i>Totalkostnad :</label>  <span><?php  the_field('kund_pris'); ?>  <strong>kr</strong></span></div>
                                <div class="info"><label><i class="fa fa-money"></i>Månadskostnad :</label>  <span><?php  the_field('kund_manads_kostnad'); ?> <strong>kr</strong></span></div>
                                <div class="info"><label><i class="fa fa-plug"></i>Energibesparing :</label>  <span><?php  the_field('kund_energibesp'); ?> <strong>%</strong></span></div>
                                <div class="info"><label><i class="fa fa-download"></i>Ladda ner :</label>
                                        <?php

                                        $file = get_field('kund_fil');

                                        if( $file ):

	// vars
	$url = $file['url'];
	$title = $file['title'];
	$caption = $file['caption'];


	// icon
	$icon = $file['icon'];

	if( $file['type'] == 'image' ) {

        $icon =  $file['sizes']['thumbnail'];

    }


	if( $caption ): ?>

                                    <div class="wp-caption">

                                        <?php endif; ?>

                                        <a href="<?php echo $url; ?>" title="<?php echo $title; ?>">

                                            <img src="<?php echo $icon; ?>" />


                                        </a>

                                        <?php if( $caption ): ?>

                                        <p class="wp-caption-text"><?php echo $caption; ?></p>

                                    </div>

                                <?php endif; ?>

                                    <?php endif; ?></div>


                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>



                <?php endif; ?>

        <div class="container" >
            <div class="prog-page ">


                <div class="prof-page-info">
                    <div class="row">



                        <div class="col-md-12">


                            <div class="prof-info">

                                <div class="info"><h5><?php   the_content(); ?></h5></div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

    </main><!-- .site-main -->


</div><!-- .content-area -->

<?php

get_footer(); ?>
