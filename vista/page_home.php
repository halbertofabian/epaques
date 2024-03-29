<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900|Rubik:300,400,500,700,900');

    * {
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
        -webkit-text-shadow: rgba(0, 0, 0, .01) 0 0 1px;
        text-shadow: rgba(0, 0, 0, .01) 0 0 1px
    }

    body {
        font-family: 'Rubik', sans-serif;
        font-size: 14px;
        font-weight: 400;
        background: #eff6fa;
        color: #000000
    }

    div {
        display: block;
        position: relative;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }

    .bbb_viewed {
        padding-top: 51px;
        padding-bottom: 60px;
        background: #eff6fa
    }

    .bbb_main_container {
        background-color: #fff;
        padding: 11px
    }

    .bbb_viewed_title_container {
        border-bottom: solid 1px #dadada
    }

    .bbb_viewed_title {
        margin-bottom: 16px;
        margin-top: 8px
    }

    .bbb_viewed_nav_container {
        position: absolute;
        right: -5px;
        bottom: 14px
    }

    .bbb_viewed_nav {
        display: inline-block;
        cursor: pointer
    }

    .bbb_viewed_nav i {
        color: #dadada;
        font-size: 18px;
        padding: 5px;
        -webkit-transition: all 200ms ease;
        -moz-transition: all 200ms ease;
        -ms-transition: all 200ms ease;
        -o-transition: all 200ms ease;
        transition: all 200ms ease
    }

    .bbb_viewed_nav:hover i {
        color: #606264
    }

    .bbb_viewed_prev {
        margin-right: 15px
    }

    .bbb_viewed_slider_container {
        padding-top: 13px
    }

    .bbb_viewed_item {
        width: 100%;
        background: #FFFFFF;
        border-radius: 2px;
        padding-top: 25px;
        padding-bottom: 25px;
        padding-left: 30px;
        padding-right: 30px
    }

    .bbb_viewed_image {
        width: 150px;
        height: 150px
    }

    .bbb_viewed_image img {
        display: block;
        max-width: 100%
    }

    .bbb_viewed_content {
        width: 100%;
        margin-top: 25px
    }

    .bbb_viewed_price {
        font-size: 16px;
        color: #000000;
        font-weight: 500
    }

    .bbb_viewed_item.discount .bbb_viewed_price {
        color: #df3b3b
    }

    .bbb_viewed_price span {
        position: relative;
        font-size: 12px;
        font-weight: 400;
        color: rgba(0, 0, 0, 0.6);
        margin-left: 8px
    }

    .bbb_viewed_price span::after {
        display: block;
        position: absolute;
        top: 6px;
        left: -2px;
        width: calc(100% + 4px);
        height: 1px;
        background: #8d8d8d;
        content: ''
    }

    .bbb_viewed_name {
        margin-top: 3px
    }

    .bbb_viewed_name a {
        font-size: 14px;
        color: #000000;
        -webkit-transition: all 200ms ease;
        -moz-transition: all 200ms ease;
        -ms-transition: all 200ms ease;
        -o-transition: all 200ms ease;
        transition: all 200ms ease
    }

    .bbb_viewed_name a:hover {
        color: #0e8ce4
    }

    .item_marks {
        position: absolute;
        top: 18px;
        left: 18px
    }

    .item_mark {
        display: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        color: #FFFFFF;
        font-size: 10px;
        font-weight: 500;
        line-height: 36px;
        text-align: center
    }

    .item_discount {
        background: #df3b3b;
        margin-right: 5px
    }

    .item_new {
        background: #0e8ce4
    }

    .bbb_viewed_item.discount .item_discount {
        display: inline-block
    }

    .bbb_viewed_item.is_new .item_new {
        display: inline-block
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="dist/img/logo_rfm.png" width="200">
    </a>
    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> -->

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item active">
                <a class="nav-link" href="#">Sucursales <span class="sr-only">(current)</span></a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
            </li> -->

        </ul>

    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-1">
            <div id="map" style="height:730px">

            </div>
        </div>


    </div>
</div>
<!-- <div class="bbb_viewed">
    <div class="container-fluid">
        <div class="row">
            <div class="col mb-5">
                <div class="bbb_main_container">
                    <div class="bbb_viewed_title_container">
                        <h3 class="bbb_viewed_title">Productos</h3>
                        <div class="bbb_viewed_nav_container">
                            <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>
                    <div class="bbb_viewed_slider_container">
                        <div class="owl-carousel owl-theme bbb_viewed_slider">

                            <div class="owl-item">
                                <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="bbb_viewed_image"><img src="https://plastibol.com.mx/wp-content/uploads/2019/07/VITAFILM-VARIAS-MEDIDAS.jpeg" alt=""></div>
                                    <div class="bbb_viewed_content text-center">
                                       
                                        <div class="bbb_viewed_name"><a href="#">Producto 1</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="bbb_viewed_image"><img src="https://cs21.com.mx/wp-content/uploads/2020/08/plastico-adherible-romfilm-1.png" alt=""></div>
                                    <div class="bbb_viewed_content text-center">
                                      
                                        <div class="bbb_viewed_name"><a href="#">Producto 2</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="bbb_viewed_image"><img src="https://peliculaparaemplayar.com/wp-content/uploads/2020/07/STRETCH-FILM-MANUAL.jpg" alt=""></div>
                                    <div class="bbb_viewed_content text-center">
                                      
                                        <div class="bbb_viewed_name"><a href="#">Producto 3</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div> -->
<?php

$sucursales = SocioModelo::mdlMostrarSucursales(0);
// var_dump($sucursales);

?>
<script>
    navigator.geolocation.getCurrentPosition(
        (pos) => {

            const {
                coords
            } = pos
            const {
                latitude,
                longitude
            } = coords
            var map = L.map('map').setView([latitude, longitude], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            <?php
            foreach ($sucursales as $key => $scl) :
                $site_web = "<strong>Sitio web: </strong> <a href='$scl[scl_sitio]' target='_blank'>$scl[scl_sitio]<a>";
                $tel = "<strong>Teléfono: </strong> <a href='tel:$scl[sc_tel]' target='_blank'>$scl[sc_tel]<a>";
                $direccion = "<strong>Dirección: </strong> <a href='https://maps.google.com?q=$scl[scl_lat],$scl[scl_lon]' target='_blank'>Ir a la direccion<a>";
                $label = "<div  ><center><strong>" . $scl['scl_nombre'] . "</strong></center>" . $scl['scl_calle'] . " " . $scl['scl_ne'] . " " . $scl['scl_ne'] . " " . $scl['scl_municipio'] . " CP." . $scl['scl_cp'] . ", " . $scl['scl_estado'] . ", México</div><br> $site_web <br> $tel <br> $direccion ";
                // $label = "<div  ><center><strong>" . $scl['scl_nombre'] . "</strong></center>";
            ?>

                L.marker([<?php echo $scl['scl_lat'] ?>, <?php echo $scl['scl_lon'] ?>]).addTo(map)
                    .bindPopup("<?php echo $label ?>")

            <?php endforeach; ?>

            setTimeout(() => {
                map.panTo(new L.LatLng(latitude, longitude))
            }, 5000)
        },
        (error) => {
            console.log(error)
        }, {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        })



    // function opens(e) {
    //     alert(e.getLatLng());
    // }
    // function opens(e) {alert(e.latlng);}

    $(document).ready(function() {


        if ($('.bbb_viewed_slider').length) {
            var viewedSlider = $('.bbb_viewed_slider');

            viewedSlider.owlCarousel({
                loop: true,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 6000,
                nav: false,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    575: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    991: {
                        items: 4
                    },
                    1199: {
                        items: 6
                    }
                }
            });

            if ($('.bbb_viewed_prev').length) {
                var prev = $('.bbb_viewed_prev');
                prev.on('click', function() {
                    viewedSlider.trigger('prev.owl.carousel');
                });
            }

            if ($('.bbb_viewed_next').length) {
                var next = $('.bbb_viewed_next');
                next.on('click', function() {
                    viewedSlider.trigger('next.owl.carousel');
                });
            }
        }


    });
</script>