<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Music</title>

    <link rel="shortcut icon" href="{{ asset('./assets/img/Images/logo-foursquare.svg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/component.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/grid.css') }}">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Open+Sans:ital,wght@0,400;1,300&family=Playfair+Display:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&family=Shizuru&display=swap" rel="stylesheet">

    <!-- LINK CAROUSEL -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">



    <!-- BOX ICON  -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="./themify-icons/themify-icons.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>

{{--    <div class="progress-bar" id="progress-bar">--}}
{{--        <a href="#" id="progress-val">--}}
{{--            <ion-icon name="logo-foursquare"></ion-icon>--}}
{{--        </a>--}}
{{--    </div>--}}

    <div class="container">
        <div class="nav bg-color">
            <a href="index.html" class="logo">
                <i style="margin-right: 10px;" class='bx bx-movie-play bx-tada main-color'></i>Mu<span class="main-color">sic</span>x
            </a>

            <form action="" class="search-box">
                <input type="text" name="search" placeholder="Search Your Music ....." class="nav-search">
                <button type="password">
                    <i class='bx bx-search-alt'></i>
                </button>
            </form>

            <div class="nav-sign">
                <a href="#" class="btn btn-hover">
                    <span>Sign in</span>
                </a>

            </div>
            <div class="menu-toggle">
                <ion-icon name="menu-outline" class="open"></ion-icon>
                <ion-icon name="close-outline" class="close"></ion-icon>
            </div>
        </div>
    </div>


    <!-- SECTIONS -->

    <section class="movie-banner">
        <div class="hero-wrapper">
            <div class="movie-banner-item">
                <img src="./assets/img/Images/raya3.jpg" alt="">
            </div>

            <div class="movie-card">
                <img src="assets/img/Images/anhhieuemma.jpg" alt="raya">

                <div class="movie-card-content">
                    <h2>G???i t??n em trong ????m</h2>


                    <ul class="movie-card-btns">
                        <li class="movie-card-btn">
                            Nh???c hot
                        </li>
                        <li class="movie-card-btn">
                            Nh???c m???i
                        </li>

                    </ul>
                    <h3>Shot</h3>
                    <div class="movie-casts">
                        <div class="movie-cast-item">
                            <img src="assets/img/Images/trachmocnhaubactinh.jpg" alt="cast1">
                        </div>
                        <div class="movie-cast-item">
                            <img src="assets/img/Images/anhhieuemma.jpg" alt="cast1">
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="international-trailer">
        <div class="trailer-title">
            <h3>Nghe Nh???c</h3>
        </div>
        <audio controls="controls" autoplay="autoplay" loop="1">
            <source src="./assets/mp3/DauConGiTrongNhau-TruongThaoNhiTangPhuc-7210328.mp3" type="audio/mpeg">
            <embed height="50" width="100" src="./assets/mp3/DauConGiTrongNhau-TruongThaoNhiTangPhuc-7210328.mp3">
        </audio>
        <p class="movie-card-description mt-4">
            L???i b??i h??t: ????u C??n G?? Trong Nhau
            <br>
            Nh???c s??: Hu???nh Qu???c Huy
            <br>
            L???i ????ng b???i: chieu_pt
            <br>
            Sau t???t c??? ch??ng ta s??? l???i
            <br>
            L???i quay v??? n??i b???t ?????u
            <br>
            Ch???ng c??n ch??t li??n quan g?? nhau
            <br>
            Sau t???t c??? ch???c em s??? l???i
            <br>
            L???i y??u m???t ng?????i ?????n sau
            <br>
            ????? n???i ??au ngu??i ngoai th???t mau
            <br>

            Em c???n m???t ai ???? ?????n xoa d???u ??o???n ???????ng t??nh ?????ng cay
            <br>
            C??n anh c???n th???i gian ????? ?????ng d???y sau chia tay
            <br>

            ????u c??n ng??y mong ng??ng
            <br>
            Ai ?????i ai n??i cu???i con ???????ng
            <br>
            T???ng n??? h??n v???n v????ng
            <br>
            G???i nhau b???ng ti???ng y??u th????ng
            <br>
            Ng?????i quan tr???ng nh???t
            <br>

            ????u c??n l?? h??i ???m
            <br>
            Ng?????i c???n m???i khi hiu qu???nh
            <br>
            V?? m???t m??nh trong b??o gi??ng
            <br>
            N??i ???y c?? ch???c ai kia s??? d??nh c??? tr??i tim ????? y??u em nh?? anh t???ng y??u.
        </p>
    </section>
    <footer class="footer ">
        <div class="section-wrapper trailer">
            <div class="row">
                <div class="col-6 footer-header">
                    <a href="#" class="logo">
                        <i style="margin-right: 10px;" class='bx bx-movie-play bx-tada main-color'></i>Mu<span class="main-color">sic</span>x
                    </a>

                    <p class="description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quas, possimus eius. Deserunt non odit, cum vero reprehenderit
                        laudantium odio vitae autem quam, incidunt molestias ratione mollitia accusantium,
                        facere ab suscipit.
                    </p>
                    <div class="social-list">
                        <a href="#" class="social-item">
                            <i class="bx bxl-facebook"></i>
                        </a>
                        <a href="#" class="social-item">
                            <i class="bx bxl-instagram"></i>
                        </a>
                        <a href="#" class="social-item">
                            <i class="bx bxl-twitter"></i>
                        </a>
                    </div>
                </div>

                <div class="col-12 footer-item">
                    <div class="row">
                        <div class="col-4 align-items-center">
                            <div class="content">
                                <p class="main-color" style="font-size: 1.2rem;"><b>Mp3</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#"> About us</a></li>
                                    <li><a href="#"> My profile</a></li>
                                    <li><a href="#"> Pricing plans</a></li>
                                    <li><a href="#"> Contacts</a></li>
                                </ul>
                            </div>
                        </div>


                        <div class="col-4 align-items-center">
                            <div class="content">
                                <p class="main-color" style="font-size: 1.2rem;"><b>Browse</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Live TV</a></li>
                                    <li><a href="#">Live Movies</a></li>
                                    <li><a href="#">Live Series</a></li>
                                    <li><a href="#">Streaming Library</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-4 align-items-center">
                            <div class="content">
                                <p class="main-color" style="font-size: 1.2rem;"><b>Help</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Account & Billing</a></li>
                                    <li><a href="#">Plans & Pricing</a></li>
                                    <li><a href="#">Supported devices</a></li>
                                    <li><a href="#">Accessibility</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </footer>




    <script src="main.js"></script>

</body>
</html>
