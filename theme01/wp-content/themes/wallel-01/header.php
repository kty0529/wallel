<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1.0">

		<!-- fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lemon&text=Wwallel&display=swap">
		<link rel="stylesheet" href="//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css">

		<?php wp_head(); ?>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-54114561-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-54114561-1');
		</script>

		<script>
			window.ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
		</script>

		<noscript>
			<style> #noscript { display: block !important; } </style>
			<?php
				// 만약 메인페이지가 아닌 곳에서 자바스크립트 사용을 허용하지 않았다면, 메인페이지로 날리기
				if ( ! is_front_page() ) { ?><meta http-equiv="refresh" content="0;url=<?php echo home_url(); ?>"><?php } ?>
		</noscript>
	</head>

	<body <?php body_class(); ?>>
		<?php browser_update_alert(); ?>

		<div id="wrap">
			<header id="header">
				<div class="container">
					<div class="row align-items-end">
						<div class="col-5">
							<div class="logo">
								<h1 class="title ff-lemon"><a href="<?php home_url(); ?>">Wallel</a></h1>
							</div>
						</div>
						<div class="col-7">
							<nav class="gnb">
								<h2 class="blind">메인 메뉴</h2>
								<ul>
									<li><a href="./archive.html">Blog</a></li>
									<li><a href="./project.html">Project</a></li>
									<li><a href="./portfolio.html">Portfolio</a></li>
									<li><a href="javascript:void(0);">Contact</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</header>
