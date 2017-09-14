<?php 
/*
Template Name: Test
Template Post Type: page
*/
?>
<?php get_header(); ?>

    <div class="content__inner content__inner_contacts" itemscope itemtype="http://schema.org/Article">
        <div class="container-fluid">
            <div class="content__layout">
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                    <?php if(function_exists('bcn_display')) {bcn_display(); }?>
                </div>
                <div class="content__body">
                    <a class="link-ajax" href="http://seohelp.the4mobile.com/sozdanie-saita/">sozdanie-saita</a><br>
                    <a class="link-ajax" href="http://seohelp.the4mobile.com/o-nas/">team</a><br>
                    <a class="link-ajax" href="http://seohelp.the4mobile.com/portfolio/">portfolio</a><br>
                    <br><br><br>
                    <div id="archives"></div>
                </div>
            </div>
        </div>
                     
    </div>

<?php get_footer(); ?>
