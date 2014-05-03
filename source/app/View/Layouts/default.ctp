<?php
$cakeDescription = __d('cake_dev', 'Bishwanath Jha Blog\'s ');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <?php //echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
    <?php
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <!-- JS
     ================================================== -->
    <?php
    //        echo $this->Html->Script('http://code.jquery.com/jquery-1.8.3.min.js');
    echo $this->Html->Script('jquery.1.8.3.min');
    echo $this->Html->Script('bootstrap');
    //        echo $this->Html->Script('jquery.custom');
    echo $this->Html->Script('ckeditor/ckeditor');
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS
    ================================================== -->
    <?php
    //        echo $this->Html->css('http://fonts.googleapis.com/css?family=Oswald');
    echo $this->Html->css('font_oswald');
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('bootstrap-responsive');
    //        echo $this->Html->css('jquery.lightbox-0.5');
    //echo $this->Html->css('http://cdn.jsdelivr.net/bootstrap.lightbox/0.6.1/bootstrap-lightbox.min.css');
    echo $this->Html->css('custom-styles');
    ?>

    <!--[if lt IE 9]> -->
    <?php
        echo $this->Html->Script('html5');
        echo $this->Html->css('style-ie');
    ?>
    <!-- <![endif]-->

</head>

<?php
$source = 'primary';
if (!empty($this->request->params['admin']))
    $source = 'admin';
?>


<body>
<div class="color-bar-1"></div>
<div class="color-bar-2 color-bg"></div>

<div class="container main-container">
    <?php echo $this->element($source . '/header'); ?>

    <!-- Blog Content
================================================== -->
    <div class="row">

        <!-- Blog Posts
        ================================================== -->
        <?php echo $content_for_layout; ?>

        <!-- Blog Sidebar
        ================================================== -->
        <?php echo $this->element($source . '/sidebar'); ?>

    </div>

</div> <!-- End Container -->

<!-- Footer
================================================== -->
<?php echo $this->element($source . '/footer'); ?>


<!-- Scroll to Top -->
<div id="toTop" class="hidden-phone hidden-tablet">Back to Top</div>

</body>
</html>

