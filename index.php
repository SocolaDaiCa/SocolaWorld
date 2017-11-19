<?php
session_start();
require_once __DIR__ . '/Controller/Controller_Layout.php';
$cLayout = new Controller_Layout();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once 'Views/layout/header.php'; ?>
        <title>Socola world - nơi Socola biến những ý tưởng của mình thành hiện thực</title>
        <?php $bor = false ?>
        <?php require_once 'Views/layout/css.php'; ?>
        <link rel="stylesheet" href="/public/css/cuntom-index.css">
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
                        <li><a class="page-scroll" href="#about">Giới thiệu</a></li>
                        <li><a class="page-scroll" href="#services">Ứng dụng</a></li>
                        <li><a class="page-scroll" href="#portfolio">Extension</a></li>
                        <li><a class="page-scroll" href="#contact">Liên hệ</a></li>
                        <li><a href="https://socoladaica.blogspot.com">Blog</a></li>
                        <?php echo$cLayout->showBtnLogin() ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading">Socola World</h1>
                    <hr>
                    <p>Nơi Socola biến những ý tưởng của mình thành hiện thực.</p>
                    <a href="#about" class="btn btn-primary btn-xl page-scroll">Giới thiệu</a>
                </div>
            </div>
        </header>
        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Giới Thiệu</h2>
                        <hr class="light">
                        <p class="text-faded">Đa số các ứng dụng mình viết chủ yếu giúp việc sử dụng và quản lý group, page và cả trang cá nhân</p>
                        <!-- <p class="text-faded">Chẳng biết phải viết gì ở đây nữa, bấm vào "dùng ngay" kìa!</p> -->
                        <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Trải Nghiệm Ngay!</a>
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
                <?php foreach ($cLayout->getListApps() as $key => $app): ?>
                <div class="col-lg-3 col-md-6 text-center" style="height: 200px;">
                    <div class="service-box">
                        <a href="<?php echo"/apps/$app->path" ?>" title=""><i class="<?php echo$app->icon ?> fa-4x"></i>
                        </a>
                        <h3><a href="<?php echo"/apps/$app->path" ?>"><?php echo$app->name ?></a></h3>
                        <p class="text-muted text-justify"><?php echo$app->description ?></p>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </section>
        <section class="no-padding" id="portfolio">
            <div class="container-fluid">
                <div class="row no-gutter popup-gallery">
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/1.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
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
                        <a href="img/portfolio/fullsize/2.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
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
                        <a href="img/portfolio/fullsize/3.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
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
                        <a href="img/portfolio/fullsize/4.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
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
                        <a href="img/portfolio/fullsize/5.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
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
                        <a href="img/portfolio/fullsize/6.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
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
                    <a href="https://github.com/SocolaDaiCa/Socola-Tool/archive/master.zip" class="btn btn-default btn-xl sr-button">Tải ngay!</a>
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
        <?php require_once 'Views/layout/js.php'; ?>
    </body>
</html>