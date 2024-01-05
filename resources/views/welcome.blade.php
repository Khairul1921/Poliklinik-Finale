<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Poli</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <style>
            /* Resets */
            hr {
                margin-left: 0;
                max-width: 40px;
            }

            /* Jumbotron (hero) */
            .jumbotron {
                position: relative;
                background: url(https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D) no-repeat bottom center / cover;

                &:before {
                    position: absolute;
                    content: '';
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, .5);
                }

                .container {
                    padding: 75px 0;
                }

                h1,
                .lead {
                    color: #fff;
                }
            }

            /* Bustom button */
            .btn-primary {
                background: #1096fc;
                border: 0;

                &:hover {
                    background: #1096fc;
                }
            }

            /* Features */
            .sec-features {
                .row {
                    &:nth-of-type(n+2) {
                        margin-top: 160px;
                    }

                    &:last-of-type {
                        margin-bottom: 160px;
                    }
                }

                .feature-icon {
                    max-width: 150px;
                }
            }

            /* Testimonials */
            .sec-testimonials {
                padding-top: 128px;
                padding-bottom: 128px;
            }

            /* Carousel */
            .carousel-indicators {
                bottom: -30px;

                li {
                    background: rgba(33, 33, 33, .1);

                    &:focus,
                    &:hover {
                        background: rgba(33, 33, 33, .5);
                    }
                }

                .active {
                    background: rgba(33, 33, 33, .75);
                }
            }

            .carousel-control-next,
            .carousel-control-prev {
                & {
                    color: #212121;
                }

                &:focus,
                &:hover {
                    color: #111;
                }
            }

            /* Footer */
            .footer {
                padding-top: 24px;
                padding-bottom: 24px;
                background: #212121;

                li {
                    &:nth-of-type(n+2) {
                        margin-left: 8px;
                    }
                }

                a {
                    font-size: 18px;
                    color: rgba(255, 255, 255, .5);
                    transition: color .235s ease-in-out;

                    &:focus,
                    &:hover {
                        color: rgba(255, 255, 255, .25);
                    }
                }
            }
            .fixed-bottom {
                position: fixed;
                bottom: 0;
                width: 100%;
            }
        </style>
    </head>
    <body class="antialiased">
    <div class="wrapper">
        <section class="hero">
            <header>
                <div class="container">
                    <nav class="navbar navbar-light navbar-toggleable-sm">
                        <a href="#" class="navbar-brand mb-0">Poliklinik</a>

                    </nav>
                </div>
            </header>

            <div class="jumbotron jumbotron-fluid mb-0">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-10 col-lg-6">
                            <h1 class="display-5">Sistem Temu Janji <br> Pasien - Dokter</h1>

                            <p class="lead">Bimbingan Karir Web</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="sec-pricing" class="sec-pricing mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-block">
                                <h4 class="card-title h5">Login Sebagai Pasien</h4>

                                <p class="card-text">Apabila anda adalah seorang pasien, silahkan login terlebih dahulu untuk melakukan pendaftaran sebagai pasien.</p>

                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-block">
                                <h4 class="card-title h5">Login Sebagai Dokter</h4>

                                <p class="card-text">Apabila anda adalah seorang dokter, silahkan login terlebih dahulu untuk melakukan pendaftaran sebagai dokter.</p>

                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer class="footer">
            <div class="container">
                <p class="text-white text-center">CopyRight &copy; 2024</p>
            </div>
        </footer>
    </div>
    <script>
        $(() => {
            $('a[href*="#"]:not([href="#"])').click((e) => {
                const target = $(e.target.hash);

                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);

                    return false;
                }
            });
        });
    </script>
    </body>
</html>
