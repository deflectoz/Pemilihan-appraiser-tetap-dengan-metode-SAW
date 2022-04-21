<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/bootstrap4/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/bootstrap4/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/bootstrap4/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?= base_url() ?>assets/bootstrap4/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?= base_url() ?>assets/bootstrap4/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		<?php echo $this->page->generateTitle(); ?>
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<!-- CSS Files -->
	<?php
        $this->page->generateCss();
    ?>
	<style>
		/* .table-borderless>tbody>tr>td,
		.table-borderless>tbody>tr>th,
		.table-borderless>tfoot>tr>td,
		.table-borderless>tfoot>tr>th {
			border: none;
		} */

    .main-panel{
      position: relative;
  height: auto;
  min-height: 100% !important;
    }

		@media print {
			.noPrint {
				display: none;
			}
		}
	</style>
</head>

<body class="">

	<div class="wrapper ">
		<div class="sidebar" data-color="white" data-active-color="info">
			<div class="logo text-center">
				<a href="<?= base_url('welcome') ?>" class="simple-text logo-normal">
					SPK|SAW - Appraiser
				</a>
			</div>
			<div class="sidebar-wrapper">
				<ul class="nav">
					<li <?php if( $this->uri->segment(1) == 'welcome'){
            ?> class="active" <?php
        }?>>
						<a href="<?php echo site_url('welcome');?>"><i class="nc-icon nc-bank"></i> Beranda</a>
					</li>
					<li <?php if( $this->uri->segment(1) == 'kriteria'){
            ?> class="active" <?php
        }?>><a href="<?php echo site_url('kriteria');?>"><i class="nc-icon nc-check-2"></i> Kriteria</a>
					</li>
					<li <?php if( $this->uri->segment(1) == 'calon'){
            ?> class="active" <?php
        }?>><a href="<?php echo site_url('calon');?>"><i class="nc-icon nc-badge"></i> Nama Calon</a>
					</li>
					<li <?php if( $this->uri->segment(1) == 'rangking'){
            ?> class="active" <?php
        }?>><a href="<?php echo site_url('rangking');?>"><i class="nc-icon nc-single-copy-04"></i> Rangking</a>
					</li>
					<li><a href="<?php echo site_url('login/logout');?>"><i class="nc-icon nc-button-power"></i> Logout</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<!-- Navbar -->
			<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
				<div class="container-fluid">
					<div class="navbar-wrapper">
						<div class="navbar-toggle">
							<button type="button" class="navbar-toggler">
								<span class="navbar-toggler-bar bar1"></span>
								<span class="navbar-toggler-bar bar2"></span>
								<span class="navbar-toggler-bar bar3"></span>
							</button>
						</div>
						<a class="navbar-brand" href="javascript:;"><?php echo $this->page->generateTitleCon(); ?></a>
					</div>
					<div class="collapse navbar-collapse justify-content-end" id="navigation">
					</div>
				</div>
			</nav>
			<!-- End Navbar -->
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<?php $this->load->view($view,$data);?>
					</div>
				</div>
			</div>
			<footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by MF
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

	<?php
    $this->page->generateJs();
    ?>

	<script>
		var base_url = "<?php echo site_url();?>";
	</script>
</body>

</html>
