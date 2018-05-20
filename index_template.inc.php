<?php
/**
 * Template for OPAC
 *
 * Copyright (C) 2015 Arie Nugraha (dicarve@gmail.com)
 * Create by Eddy Subratha (eddy.subratha@slims.web.id)
 * Modified by Erwan Setyo Budi (erwans818@gmail.com)
 * Slims 8 (Akasia)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 */

// be sure that this file not accessed directly

if (!defined('INDEX_AUTH')) {
  die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
  die("can not access this file directly");
}

?>
<!--
==========================================================================
   ___  __    ____  __  __  ___      __    _  _    __    ___  ____    __
  / __)(  )  (_  _)(  \/  )/ __)    /__\  ( )/ )  /__\  / __)(_  _)  /__\
  \__ \ )(__  _)(_  )    ( \__ \   /(__)\  )  (  /(__)\ \__ \ _)(_  /(__)\
  (___/(____)(____)(_/\/\_)(___/  (__)(__)(_)\_)(__)(__)(___/(____)(__)(__)

==========================================================================
-->
<!DOCTYPE html>
<html lang="<?php echo substr($sysconf['default_lang'], 0, 2); ?>" xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">
<head>

<?php
// Meta Template
include "partials/meta.php";

?>

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php echo SWB; ?>template/splash/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php echo SWB; ?>template/splash/css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="<?php echo SWB; ?>template/splash/css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?php echo SWB; ?>template/splash/css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?php echo SWB; ?>template/splash/css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet"href="<?php echo SWB; ?>template/splash/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo SWB; ?>template/splash/css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link type="text/css" rel="stylesheet" media="all" href="<?php echo SWB; ?>template/splash/css/font-awesome.css"/>
	<link type="text/css" rel="stylesheet" media="all" href="<?php echo SWB; ?>template/splash/css/font-awesome.min.css"/>
	<link type="text/css" rel="stylesheet" media="all" href="<?php echo SWB; ?>template/splash/css/splash.style.css"/>

	<!-- Modernizr JS -->
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/respond.min.js"></script>
	<![endif]-->
</head>

<body itemscope="itemscope" itemtype="http://schema.org/WebPage">

<!--[if lt IE 9]>
<div class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</div>
<![endif]-->

<?php
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$startpoint = ($page - 1)*10;
// $startpoint = $page + 9;
// echo $page;
$cihuy = $dbs->query('SELECT b.biblio_id, b.title, ma.author_name 
FROM biblio AS b 
LEFT JOIN biblio_author AS ba ON b.biblio_id=ba.biblio_id
LEFT JOIN mst_author AS ma ON ba.author_id=ma.author_id ORDER by b.last_update DESC LIMIT '.$startpoint.',10');
$rowc = $dbs->query('SELECT COUNT(biblio_id) AS row FROM biblio');
$iuh = $rowc->fetch_row();
$aa = floor($iuh['0']/10)+1;
$rowcount = 0;
?>
<?php
// Content
?>
<?php if(isset($_GET['search']) || isset($_GET['p'])): ?>
<section  id="content" class="s-main-page" role="main">

  <!-- Search on Front Page
  ============================================= -->
  
  <div class="s-main-search">

    <?php
    if(isset($_GET['p'])) {
      switch ($_GET['p']) {
      case ''             : $page_title = __('Collections'); break;
      case 'show_detail'  : $page_title = __("Record Detail"); break;
      case 'member'       : $page_title = __("Member Area"); break;
      case 'member'       : $page_title = __("Member Area"); break;
      default             : $page_title; break; }
    } else {
      $page_title = __('Collections');
    }
    ?>
	
    <h1 class="s-main-judulpage animated fadeInUp delay1"><?php echo $page_title ?>&nbsp | &nbsp<?php echo $sysconf['library_name']; ?> </h1>

    <form action="index.php" method="get" autocomplete="off">
      <input type="text" id="keyword" class="s-search animated fadeInUp delay4" name="keywords" value="" lang="<?php echo $sysconf['default_lang']; ?>" role="search">
      <button type="submit" name="search" value="search" class="s-btn animated fadeInUp delay4"><?php echo __('Search'); ?></button>
	  
    </form>
	
    <a href="#" class="s-search-advances" width="800" height="500" title="<?php echo __('Advanced Search') ?>"><?php echo __('Advanced Search') ?></a>
	</br>
	<a href="index.php" class="s-homer1" width="800" height="500" title="<?php echo __('Home') ?>"><?php echo __('Home') ?></a>
	
	</br>
  </div>

  <!-- Main
  ============================================= -->
  <div class="s-main-content container">
    <div class="row">

      <!-- Show Result
      ============================================= -->
      <div class="col-lg-8 col-sm-9 col-xs-12 animated fadeInUp delay2">

        <?php
          // Generate Output
          // catch empty list
          if(strlen($main_content) == 7) {
            echo '<h2>' . __('No Result') . '</h2><hr/><p>' . __('Please try again') . '</p>';
          } else {
            echo $main_content;
          }

          // Somehow we need to hack the layout
          if(isset($_GET['search']) || (isset($_GET['p']) && $_GET['p'] != 'member')){
            echo '</div>';
          } else {
            if(isset($_SESSION['mid'])) {
              echo  '</div></div>';
            }
          }

        ?>

      <div class="col-lg-4 col-sm-3 col-xs-12 animated fadeInUp delay4">
        <?php if(isset($_GET['search'])) : ?>
        <h2><?php echo __('Search Result'); ?></h2>
        <hr>
        <?php echo $search_result_info; ?>
        <?php endif; ?>

        <br>

        <!-- If Member Logged
        ============================================= -->
        <h2><?php echo __('Information'); ?></h2>
        <hr/>
        <p><?php echo (utility::isMemberLogin()) ? $header_info : $info; ?></p>
        <br/>

        <!-- Show if clustering search is enabled
        ============================================= -->
        <?php
          if(isset($_GET['keywords']) && (!empty($_GET['keywords']))) :
            if (($sysconf['enable_search_clustering'])) : ?>
            <h2><?php echo __('Search Cluster'); ?></h2>

            <hr/>

            <div id="search-cluster">
              <div class="cluster-loading"><?php echo __('Generating search cluster...');  ?></div>
            </div>

            <script type="text/javascript">
              $('document').ready( function() {
                $.ajax({
                  url     : 'index.php?p=clustering&q=<?php echo urlencode($criteria); ?>',
                  type    : 'GET',
                  success : function(data, status, jqXHR) { $('#search-cluster').html(data); }
                });
              });
            </script>

            <?php endif; ?>
          <?php endif; ?>
      </div>
    </div>
  </div>

</section>

<?php else: ?>

<!-- Homepage
============================================= -->
<main id="content" class="s-main" role="main">

	<div class="gtco-loader"></div>
	<div id="page">
	<div class="page-inner">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
				<img class="animated flipInY delay7" src="<?php echo $sysconf['template']['dir']; ?>/splash/img/logo.png" alt="<?php echo $sysconf['library_name']; ?>" /></br>
					<div id="gtco-logo"><a href="index.php"><?php echo $sysconf['library_name']; ?><em>.</em></a></div>
					<div id="gtco-subname"><a href="index.php"><?php echo $sysconf['library_subname']; ?><em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="index.php"><?php echo __('Home'); ?></li>
						<li><a href="index.php?p=librarian"><?php echo __('Librarian'); ?></a></li>
						
						<li class="has-dropdown">
							<a href="#"><i class="ti-menu-alt"></i></a>
							<ul class="dropdown">
								<li><a href="index.php?p=news"><?php echo __('Library News'); ?></a></li>
								<li><a href="index.php?p=libinfo"><?php echo __('Library Information'); ?></a></li>
								<li><a href="index.php?p=slimsinfo"><?php echo __('About SLiMS'); ?></a></li>
								<li><a href="index.php?p=help"><?php echo __('Help on Search'); ?></a></li>
								<li><a href="index.php?p=member"><?php echo __('Member Area'); ?></a></li>
								</ul>
						</li>
						<li class="has-dropdown">
							<a href="#"><i class="ti-world"></i></a>
							<ul class="dropdown">
								<select name="select_lang" id="select_lang" title="Change language of this site" onchange="document.langSelect.submit();" class="custom-dropdown__select custom-dropdown__select--emerald">
								  <?php echo $language_select; ?>
								</select>
								</ul>
						</li>
						<li class="btn-cta"><a href="index.php?p=login"><span><?php echo __('Librarian LOGIN'); ?></span></a></li>
					</ul>
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover" role="banner" style="background-image: url(<?php echo SWB; ?>template/splash/img/img_4.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">
							<?php   
								$b = time();   $hour = date("g",$b); $m = date ("A", $b);  
								if ($m == "AM") 
								{ if ($hour == 12) { echo "Hai, Good Evening. "; } 
								elseif ($hour == 11) { echo "Hai, Good Afternoon. "; }
								elseif ($hour == 10) { echo "Hai, Good Morning."; }
								elseif ($hour == 9) { echo "Hai, Good Morning. " ; }
								elseif ($hour == 8) { echo "Hai, Good Morning. "; }
								elseif ($hour == 7) { echo "Hai, Happy Sunshine. "; }
								elseif ($hour == 6) { echo "Hai, Happy Sunshine. "; }
								elseif ($hour == 5) { echo "Hai, Good Morning. "; }
								elseif ($hour == 4) { echo "Hai, Good Morning. "; }
								elseif ($hour == 3) { echo "Hai, Good Morning. "; }
								elseif ($hour == 2) { echo "Hai, Good Morning. "; }
								elseif ($hour == 1) { echo "Hai, Good Morning. "; } }  
								
								elseif ($m == "PM") 
								{ if ($hour == 12) { echo "Hai, Good Afternoon. "; } 
								elseif ($hour == 11) { echo "Hai, Good Night., "; }
								elseif ($hour == 10) { echo "Hai, Good Night. "; }
								elseif ($hour == 9) { echo "Hai, Good Night. "; }
								elseif ($hour == 8) { echo "Hai, Good Night. "; }
								elseif ($hour == 7) { echo "Hai, Good Night. "; }
								elseif ($hour == 6) { echo "Hai, Happy Sunset. "; }
								elseif ($hour == 5) { echo "Hai, Good Evening. "; }
								elseif ($hour == 4) { echo "Hai, Good Evening. "; }
								elseif ($hour == 3) { echo "Hai, Good Evening. "; }
								elseif ($hour == 2) { echo "Hai, Good Afternoon. "; } 
								elseif ($hour == 1) { echo "Hai, Good Afternoon. "; } }   
							?>
							<?php if (utility::isMemberLogin()) {    echo '<a class="momentumname" href="index.php?p=member">'.$_SESSION['m_name'].'.</a>';   ?>
							<a class="momentumname"></a><?php } else {?><a class="momentumname"></a><?php } ?>
		
							</span>
							<h1>Read Books and Love Libraries.</h1>	
							<?php
						// Meta Template
						include "partials/footfront.php";
						?>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									<ul class="tab-menu">
										<li class="active gtco-first"><a href="#" data-tab="signup"><?php echo __('Simple Search') ?></a></li>
										<li class="gtco-second"><a href="#" data-tab="login"><?php echo __('Advanced Search') ?></a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<form action="index.php" method="get" autocomplete="off">
												<div class="row form-group">
													<div class="col-md-12">
														<p class="active gtco-second"><a><?php echo __('start it by typing one or more keywords for title, author or subject'); ?></a></p>
														<input type="text"  id="keyword" name="keywords" value="" lang="<?php echo $sysconf['default_lang']; ?>" aria-hidden="true" autocomplete="off" type="text" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<button type="submit" name="search" value="search" class="btn btn-primary"><?php echo __('Search'); ?></button></br>
														 <li><a><h6>Total <?php echo __('Collections'); ?> : <?php echo $iuh['0'];?></h6></a></li>
													</div>
												</div>
											</form>	
										</div>

										<div class="tab-content-inner" data-content="login">
											<form  id="keyword" name="keywords" value="" lang="<?php echo $sysconf['default_lang']; ?>" aria-hidden="true" autocomplete="off" type="text"action="index.php" method="get" autocomplete="off">
												<div class="row form-group">
													<div class="col-md-12">
														<p class="active gtco-second"><a><?php echo __('Title'); ?></a></p>
														<input type="text" name="title" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<p class="active gtco-second"><a><?php echo __('Author(s)'); ?></a></p>
														<input type="text" name="author" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<p class="active gtco-second"><a><?php echo __('Subject(s)'); ?></a></p>
														<input type="text" name="subject" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<p class="active gtco-second"><a><?php echo __('ISBN/ISSN'); ?></a></p>
														<input type="text" name="isbn" placeholder="<?php echo __('ISBN/ISSN'); ?>" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<p class="active gtco-second"><a><?php echo __('Collection Type'); ?></a></p>
														 <select name="colltype" class="form-control"><?php echo $colltype_list; ?></select>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<p class="active gtco-second"><a><?php echo __('Location'); ?></a></p>
														<select name="location" class="form-control"> <?php echo $location_list; ?></select>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<p class="active gtco-second"><a><?php echo __('GMD'); ?></a></p>
														<select name="gmd" class="form-control"><?php echo $gmd_list; ?></select>
													</div>
												</div>
												
												<div class="row form-group">
													<div class="col-md-12">
														<input type="hidden" name="searchtype" value="advance" />
																  <button type="submit" name="search" value="search" class="btn btn-primary"><?php echo __('Search'); ?></button>
													</div>
												</div>
											</form>	
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div id="gtco-products">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Our Gallery</h2>
					<p>See how wonderful our library. </p>
				</div>
			</div>
			<div class="row">
				<div class="owl-carousel owl-carousel-carousel">
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery01.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery02.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery03.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery04.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery05.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery06.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery07.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery08.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery09.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery10.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery11.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery12.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery13.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery14.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery15.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery16.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery17.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery18.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery19.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="item">
						<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/gallery20.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					
				</div>
			</div>
		</div>
	</div>
<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container"><h2><?php echo __('Browse By'); ?></h2>
			<div class="row row-p	b-md">
			
				<div class="col-md-4">
					<div class="gtco-widget">
						<h3><?php echo __('Collection Type'); ?></h3>
						<p>
						<?php
							$show2page = 5;
							$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
							$startpoint = ($page - 1)*$show2page;	
							//Get Coll type Data From Database for Menu
							$coll_type_q_array= $dbs->query('SELECT coll_type_name FROM mst_coll_type LIMIT '.$startpoint.','.$show2page.'');
							$row_q = $dbs->query('SELECT COUNT(coll_type_id) AS row FROM mst_coll_type');
							$row_f = $row_q->fetch_assoc();
							$i = 0;
							echo "<ul>";
							while ($coll_type_d = $coll_type_q_array->fetch_row()) {
								$coll_type_src = str_replace(' ', '+', $coll_type_d[0]);
								$link_coll_type ='./index.php?title=&search=search&author=&subject=&isbn=&colltype='.$coll_type_src.'&gmd=0&location=0';
								echo "<li><a href='".$link_coll_type."'>".$coll_type_d[0]."</a></li>";
								$i++;
							}
							echo "</ul>";
							
							if (($row_f['row'] > $show2page)) {
							  echo '<div class="biblioPaging-content">'.simbio_paging::paging($row_f['row'], $show2page, 5).'</div>';
							} else { }
							?>
						</p>
					</div>
				</div>

				<div class="col-md-4 col-md-push-1">
					<div class="gtco-widget">
						<h3><?php echo __('GMD'); ?></h3>
                        <ul class="gtco-footer-links">
									<?php
									$show2page = 5;
									$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
									$startpoint = ($page - 1)*$show2page;	
									//Get GMD Data From Database for Menu
									$gmd_q_array = $dbs->query('SELECT gmd_name FROM mst_gmd LIMIT '.$startpoint.','.$show2page.'');
									$row_q = $dbs->query('SELECT COUNT(gmd_id) AS row FROM mst_gmd');
									$row_f = $row_q->fetch_assoc();
									$i = 0;
									echo "<ul>";
									while ($gmd_d = $gmd_q_array->fetch_row()) {
										$gmd_src = str_replace(' ', '+', $gmd_d[0]);
										$link_gmd ='./index.php?title=&search=search&author=&subject=&isbn=&gmd='.$gmd_src.'&colltype=0&location=0';
										echo "<li><a href='".$link_gmd."'>".$gmd_d[0]."</a></li>";
										$i++;
									}
									echo "</ul>";
									
									if (($row_f['row'] > $show2page)) {
									  echo '<div class="biblioPaging-content2">'.simbio_paging::paging($row_f['row'], $show2page, 3).'</div>';
									} else { }
									?>
                        </ul>
					</div>
				</div>

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3><?php echo __('Other Resources'); ?></h3>
						<ul class="gtco-quick-contact">
							<li><a target="blank" href="http://www.perpustakaan.depkes.go.id/">E-Library Kemenkes</a></li>
								<li><a target="blank" href="http://e-resources.pnri.go.id/">E-Library Perpusnas</a></li>
								<li><a target="blank" href="http://onesearch.id/">IOS</a></li>
								<li><a target="blank" href="http://kin.perpusnas.go.id/">Katalog Induk Nasional</a></li>
								<li><a target="blank" href="http://digilib.undip.ac.id/">E-Journal EciVerse</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>
	<div id="gtco-subscribe">
		<div class="gtco-container">
		
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2><?php echo __('Librarian'); ?></h2>
					<p>Be the first to know about our library, contact our <?php echo __('Librarian'); ?>.</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form class="form-inline">
										<?php
											// Pustakawan
											include "partials/pustakawan.php"; ?>
					</form>
				</div>
			</div>
		</div>
	</div>
		<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Have You Seen our Works?</h2>
					<p>Lets see our recently works.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="<?php echo SWB; ?>template/splash/img/work01.jpg" class="fh5co-project-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/work01.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Call For Paper</h2>
							<p>On November 2, This event was attended by librarians, students and academics.</p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="<?php echo SWB; ?>template/splash/img/work02.jpg" class="fh5co-project-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/work02.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Reading Photography</h2>
							<p>We give participants a chance to take a pictures.</p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="<?php echo SWB; ?>template/splash/img/work03.jpg" class="fh5co-project-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/work03.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Constructive heading</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
						</div>
					</a>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="<?php echo SWB; ?>template/splash/img/work04.jpg" class="fh5co-project-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/work04.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Library Photography </h2>
							<p>Sympathetic with the striving and tolerant of the weak and strong.</p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="<?php echo SWB; ?>template/splash/img/work05.jpg" class="fh5co-project-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/work05.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Our Collage</h2>
							<p>On 17 November, we held a photo exhibition. We collect pictures from all the activities.</p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="<?php echo SWB; ?>template/splash/img/work06.jpg" class="fh5co-project-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="<?php echo $sysconf['template']['dir']; ?>/splash/img/work06.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Our Collage</h2>
							<p>We held a photo exhibition. We collect pictures from all the activities.</p>
						</div>
					</a>
				</div>

			</div>
		</div>
	</div>
	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
		<div class="map-wrapper" role="banner" style="background-image: url(<?php echo SWB; ?>template/splash/img/map.png)" >
                    </div>
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>About <span class="footer-logo"><?php echo $sysconf['library_name']; ?><span>.<span></span></h3>
						<p><a>
						Opening Hours
						<ul>Monday - Friday :08.00 AM - 20.00 PM</ul>
						<ul>Saturday : 08.00 AM - 17.00 PM</ul>
						</a>
						</p>
						<p><a>Jenderal Sudirman Road, Senayan, Jakarta, Indonesia - Postal Code : 10270 </a></p>
						</div>
				</div>

				<div class="col-md-4 col-md-push-1">
					<div class="gtco-widget">
						<h3>Links</h3>
						<ul class="gtco-footer-links">
							<li><a target="blank" href="http://onesearch.id/">IOS</a></li>
							<li><a target="blank" href="http://kin.perpusnas.go.id/">KIN</a></li>
							<li><a target="blank" href="http://www.freemedicaljournals.com/">E-Journal Medical</a></li>
							<li><a href="#">Terms of services</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>Get In Touch</h3>
						<ul class="gtco-quick-contact">
							<li><a href="#"><i class="icon-envelope"></i></a></li>
							<li><a href="#"><i class="icon-phone"></i> +6285 727 17 94 17</a></li>
							<li><a href="#"><i class="icon-mail2"></i> library@mail.com</a></li>
							<li><a href="#"><i class="icon-chat"></i> Live Chat</a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy;  <?php echo $sysconf['library_name']; ?>. All Rights Reserved.</small> 
						<small class="block">Modified by <a href="https://www.facebook.com/erwan.setyobudi" target="_blank">Erwan Setyo Budi</a></small>
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="index.php"><i class="icon-home"></i></a></li>
							<li><a target="_blank" rel="archives" href="http://www.facebook.com/groups/senayan.slims"><i class="icon-facebook"></i></a></li>
							<li><a target="_blank" rel="archives" href="http://www.twitter.com/#!/slims_official"><i class="icon-twitter"></i></a></li>
							<li><a target="_blank" rel="archives" href="http://www.youtube.com/user/senayanslims"><i class="icon-youtube"></i></a></li>
							<li><a target="_blank" rel="archives" href="http://www.github.com/slims"><i class="icon-github"></i></a></li>
							<li><a target="_blank" rel="archives" href="www.slims.web.id/"><i class="icon-globe"></i></a></li>
							<li><a target="_blank" rel="archives" href="index.php?rss=true" title="RSS" class="rss" ><i class="icon-rss"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	</div>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
<!-- jQuery -->
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="<?php echo $sysconf['template']['dir']; ?>/splash/js/main.js"></script>
 

</main>
<?php endif; ?>


<?php
// Advance Search
include "partials/advsearch.php";


// Chat Engine
include "partials/chat.php";

// Background
include "partials/bg.php";
?>

<script>
  <?php if(isset($_GET['search']) && (isset($_GET['keywords'])) && ($_GET['keywords'] != ''))   : ?>
  $('.biblioRecord .detail-list, .biblioRecord .title, .biblioRecord .abstract, .biblioRecord .controls').highlight(<?php echo $searched_words_js_array; ?>);
  <?php endif; ?>

  //Replace blank cover
  $('.book img').error(function(){
    var title = $(this).parent().attr('title').split(' ');
    $(this).parent().append('<div class="s-feature-title">' + title[0] + '<br/>' + title[1] + '<br/>... </div>');
    $(this).attr({
      src   : './template/splash/img/book.png',
      title : title + title[0] + ' ' + title[1]
    });
  });

  //Replace blank photo
  $('.librarian-image img').error(function(){
    $(this).attr('src','./template/splash/img/avatar.jpg');
  });

  //Feature list slider
  function mycarousel_initCallback(carousel)
  {
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
      carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
      carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
      carousel.stopAuto();
    }, function() {
      carousel.startAuto();
    });
  };

  jQuery('#topbook').jcarousel({
      auto: 5,
      wrap: 'last',
      initCallback: mycarousel_initCallback
  });

  $(window).scroll(function() {
    // console.log($(window).scrollTop());
    if ($(window).scrollTop() > 50) {
      $('.s-main-search').removeClass("animated fadeIn").addClass("animated fadeOut");
    } else {
      $('.s-main-search').removeClass("animated fadeOut").addClass("animated fadeIn");
    }
  });

  $('.s-search-advances').click(function() {
    $('#advance-search').animate({opacity : 1,}, 500, 'linear');
    $('#simply-search, .s-menu, #content').hide();
    $('.s-header').addClass('hide-header');
    $('.s-background').addClass('hide-background');
  });

  $('#hide-advance-search').click(function(){
    $('.s-header').toggleClass('hide-header');
    $('.s-background').toggleClass('hide-background');
    $('#advance-search').animate({opacity : 0,}, 500, 'linear', function(){
      $('#simply-search, .s-menu, #content').show();
    });
  });

</script>

</body>
</html>
