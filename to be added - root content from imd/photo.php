
<?php
include("head.php");
?>

<div class='underNavElse clearfix hidden-lg hidden-md hidden-sm'>
    <br /><br />
</div>

<script type='text/javascript'>
    jQuery(document).ready(function($) {

        $('#myCarousel1').carousel({
            interval: 5000
        });

        $('#carousel-text').html($('#slide-content-0').html());

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function() {
            var id_selector = $(this).attr("id");
            var id = id_selector.match('[0-9]+');
            var id = parseInt(id);
            $('#myCarousel1').carousel(id);
        });


        // When the carousel slides, auto update the text
        $('#myCarousel1').on('slid.bs.carousel', function(e) {
            var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-' + id).html());
        });
    });
</script>

<div class='container-fluid'>
    <h1>Photo Gallery</h1>

    IMD Specializes in a number of production processes for the Orthopaedic Industry. Below is a gallery
    of products we have manufactured for various clients.
</div>

<div class="container-fluid">
    <div id="main_area">
        <!-- Slider -->
        <div class="row">
            <div class="col-xs-12" id="slider">
                <!-- Top part of the slider -->
                <div class="row">
                    <div class="col-sm-12" id="carousel-bounding-box">
                        <div class="carousel slide" id="myCarousel1">
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <div class="active item" data-slide-number="0">
                                    <img src="images/gallery/1765-02.jpg"></div>

                                <div class="item" data-slide-number="1">
                                    <img src="images/gallery/1878.jpg"></div>

                                <div class="item" data-slide-number="2">
                                    <img src="images/gallery/4240.jpg"></div>

                                <div class="item" data-slide-number="3">
                                    <img src="images/gallery/5201_gold.jpg"></div>

                                <div class="item" data-slide-number="4">
                                    <img src="images/gallery/5211_gold.jpg"></div>

                                <div class="item" data-slide-number="5">
                                    <img src="images/gallery/5220_gold.jpg"></div>

                                <div class="item" data-slide-number="6">
                                    <img src="images/gallery/5230_gold.jpg"></div>

                                <div class="item" data-slide-number="7">
                                    <img src="images/gallery/6620.jpg"></div>

                                <div class="item" data-slide-number="8">
                                    <img src="images/gallery/6865-04_gold.jpg"></div>

                                <div class="item" data-slide-number="9">
                                    <img src="images/gallery/7400_handle.jpg"></div>

                                <div class="item" data-slide-number="10">
                                    <img src="images/gallery/9125.jpg"></div>

                                <div class="item" data-slide-number="11">
                                    <img src="images/gallery/T1006.jpg"></div>

                                <div class="item" data-slide-number="12">
                                    <img src="images/gallery/Tools-11.jpg"></div>

                                <div class="item" data-slide-number="13">
                                    <img src="images/gallery/Tools-15.jpg"></div>

                                <div class="item" data-slide-number="14">
                                    <img src="images/gallery/aluminum_remnants.jpg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/Slider-->

        <div class="row hidden-xs" id="slider-thumbs">

            <div class="container arrangeThumbs">
                <!-- Bottom switcher of slider -->
                <ul class="hide-bullets">
                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-0"><img src="images/gallery/1765-02.jpg" alt=""/></a>

                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-1"> <img src="images/gallery/1878.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-2"><img src="images/gallery/4240.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-3"><img src="images/gallery/5201_gold.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-4"><img src="images/gallery/5211_gold.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-5"><img src="images/gallery/5220_gold.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-6"><img src="images/gallery/5230_gold.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-7"><img src="images/gallery/6620.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-8"><img src="images/gallery/6865-04_gold.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-9"><img src="images/gallery/7400_handle.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-10"><img src="images/gallery/9125.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-11"><img src="images/gallery/T1006.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-12"><img src="images/gallery/Tools-11.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-13"><img src="images/gallery/Tools-15.jpg" alt=""/></a>
                    </li>

                    <li class="col-sm-2">
                        <a class="thumbnail" id="carousel-selector-14"><img src="images/gallery/aluminum_remnants.jpg" alt=""/></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
include("foot.php");
?>
