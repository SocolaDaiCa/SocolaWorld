<?php require_once 'data/chuc-nang.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Socola world - nơi Socola biến những ý tưởng xàm xàm của mình thành hiện thực</title>
        <!-- Bootstrap Core CSS -->
        <?php require_once 'layout/header.php'; ?>
        <?php require_once 'layout/css.php'; ?>
        <!-- Custom Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <!-- Plugin CSS -->
        <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
        <!-- Theme CSS -->
        <link href="frontend/css/creative.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="page-top">
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">Socola world</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="#about">Giới thiệu</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#services">Ứng dụng</a>
                        </li>
                        <!--  <li>
                            <a class="page-scroll" href="#portfolio">Portfolio</a>
                        </li> -->
                        <li>
                            <a class="page-scroll" href="#contact">Liên hệ</a>
                        </li>
                        <li class="dropdown">
                            <?php echo $login; ?>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading">Chào mừng đến với thế giới của Socola</h1>
                    <hr>
                    <p>Nơi Socola biến những ý tưởng xàm xàm của mình thành hiện thực.</p>
                    <a href="#about" class="btn btn-primary btn-xl page-scroll">Giới thiệu</a>
                </div>
            </div>
        </header>
        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Mình có thứ mà bạn cần!</h2>
                        <hr class="light">
                        <p class="text-faded">Mình thích xài tiếng Việt nhưng nhiều từ không thể dịch hoặc dịch ra rất chuối nên để hỗn tạp vậy!</p>
                        <p class="text-faded">Chẳng biết phải viết gì ở đây nữa, bấm vào "dùng ngay" kìa!</p>
                        <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Dùng ngay!</a>
                    </div>
                </div>
            </div>
        </section>
        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Ứng dụng</h2>
                        <hr class="primary">
                    </div>
                </div>
            </div>
            <div class="container">
                <?php $width = 0; ?>
                <?php foreach ($chucNang as $key => $value): ?>
                <?php 
                    if ($width == 0) {
                        echo '<div class="row">';
                    }
                    $width += $col;
                    $value->showForIndex();
                    if ($width == 12) {
                        echo '</div>';
                        $width = 0;
                    }
                ?>
                <?php endforeach ?>
                <?php 
                    if ($width != 0) {
                        echo '</div>';
                    }
                ?>
            </div>
        </section>
        <section class="no-padding" id="portfolio">
            <div class="container-fluid">
                <div class="row no-gutter popup-gallery">
                    <div class="col-lg-4 col-sm-6">
                        <a href="frontend/images/portfolio/fullsize/1.jpg" class="portfolio-box">
                            <img src="frontend/images/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="frontend/images/portfolio/fullsize/2.jpg" class="portfolio-box">
                            <img src="frontend/images/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="frontend/images/portfolio/fullsize/3.jpg" class="portfolio-box">
                            <img src="frontend/images/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="frontend/images/portfolio/fullsize/4.jpg" class="portfolio-box">
                            <img src="frontend/images/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="frontend/images/portfolio/fullsize/5.jpg" class="portfolio-box">
                            <img src="frontend/images/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="frontend/images/portfolio/fullsize/6.jpg" class="portfolio-box">
                            <img src="frontend/images/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <aside class="bg-dark">
            <div class="container text-center">
                <div class="call-to-action">
                    <h2>Extension!</h2>
                    <a href="#" class="btn btn-default btn-xl sr-button">Tải ngay!</a>
                </div>
            </div>
        </aside>
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Liên hệ!</h2>
                        <hr class="primary">
                        <p>Nếu bạn cần trợ giúp hãy liên hệ ngay với mình.</p>
                    </div>
                    <div class="col-lg-4 col-lg-offset-2 text-center">
                        <i class="fa fa-phone fa-3x sr-contact"></i>
                        <p>096 8998 735</p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                        <p><a href="mailto:SocolaDaiCa@gmail.com">SocolaDaiCa@gmail.com</a></p>
                    </div>
                </div>
            </div>
        </section>
        <?php require_once 'layout/js.php'; ?>
        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="/vendor/scrollreveal/scrollreveal.min.js"></script>
        <script src="/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
        <!-- Theme JavaScript -->
        <script src="/frontend/js/creative.min.js"></script>
    </body>
</html>