<html>
<head>
	<meta charset="UTF-8">
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
	<meta name="viewport" content="initial-scale=1">
	<title>NFT Generator</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
	<link rel='stylesheet' type='text/css' media='screen' href='css/app.css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
	<link rel='stylesheet' type='text/css' media='screen' href='css/bootstrap.min.css'>

</head>

<style>
    [data-timed-style='fade']{display:none}[data-timed-style='scale']{display:none}

a[name='btnlog'] { 
  background-color: #fff;
  color: #64408E;
}

a[name='bec'] { 
  background-color: #fff;
  color: #64408E;
}

small[name='gen'] { 
	font-size: 28px; 
}

a[name='join'] { 
  background-color: #64408E;
  color: #fff;
}

</style>

<body>
	<div class="site-wrapper">
		<header class="header">
			<div class="container">
				<div class="row d-flex flex-wrap align-items-center">
					<div class="logo col-sm-4 col-md-6">
						<a href="{{env('APP_NFT_URL')}}" title="eziNFTs">
							<img src="{{env('APP_NFT_URL')}}ezinfts-logo.svg" alt="eziNFTs">
						</a>
					</div>
					<div class="header-btns col-sm-8 col-md-6">
						<a id="btnlog" name="btnlog"  href="{{env('APP_NFT_URL')}}login" title="Member Login">Member Login</a>
						<a href="{{env('APP_NFT_URL')}}register" title="Register Voucher">Register User</a>
					</div>
				</div>
			</div>
		</header>
		<main class="site-content">
			<div class="hero">
				<div class="container">
					<div class="row align-items-center">
						<div class="hero-content col-md-6">
							<small name="gen" id="gen" class="small-head">Generate Your Own</small>
							<h1>NFT Collection</h1>
							<small class="small-head">and Join the Metaverse.</small>
							<a href="https://piptle.store/register" name="bec" title="Become a Member from $88" class="btn">Become a Member from $88</a>
						</div>
						<div class="hero-image col-md-6">
							<div id="carouselHero" class="carousel slide" data-bs-ride="carousel">
								<div class="carousel-indicators">
									<button type="button" data-bs-target="#carouselHero" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
									<button type="button" data-bs-target="#carouselHero" data-bs-slide-to="1" aria-label="Slide 2"></button>
									<button type="button" data-bs-target="#carouselHero" data-bs-slide-to="2" aria-label="Slide 3"></button>
								</div>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img src="{{env('APP_NFT_URL')}}hero-carousel-1.jpg" class="d-block w-100" alt="hero-carousel-1">
									</div>
									<div class="carousel-item active">
										<img src="{{env('APP_NFT_URL')}}hero-carousel-1.jpg" class="d-block w-100" alt="hero-carousel-1">
									</div>
									<div class="carousel-item">
										<img src="{{env('APP_NFT_URL')}}hero-carousel-1.jpg" class="d-block w-100" alt="hero-carousel-1">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="about-sec">
				<div class="container">
					<div class="row">
						<div class="about-sec-text col-sm-6">
							<h2 class="sec-title"><em>what's</em> an NFT? <small class="small-head">Non-Fungible Token</small></h2>
							<p><strong>NFTs</strong> are certificates that attest to the authenticity, uniqueness and ownership of a digital asset (such as an image, a video, a song, etc...)</p>
							<p>So they can not be replaced with other goods of the same kind (as it is for the money, which is interchangeable)</p>
							<p>The most obvious example of this is with paintings and works of art: they are also unique and 100% original.</p>
							
						</div>
						<div class="about-sec-image col-sm-6">
							<img src="{{env('APP_NFT_URL')}}about-sec.jpg" alt="what's an NFT?">
						</div>
					</div>
				</div>
			</div>
			<div class="join-sec">
				<div class="container">
					<div class="row align-items-center">
						<div class="join-sec-text col-8">
							<p>In short, today on the Net everything you create can be sold in the form of NFT, and everyone can create their own</p>
							<h2><em>digital</em> fortune</h2>
						</div>
						<div class="join-sec-btn col-4">
							<a name="join" href="https://piptle.store/register" title="Join with US" class="btn">Join with US</a>
						</div>
					</div>
				</div>
			</div>
			<div class="details-sec">
				<div class="container">
					<div class="row">
						<div class="details-col col-sm-6">
							<p>Until now, however, <em>there was no system to easily create 100% unique and original NFT collections,</em> in fact, if you wanted to generate one from scratch <em>you would have to pay thousands of dollars a team of developers</em>...which could lead to unpleasant surprises...</p>
						</div>
						<div class="details-col col-sm-6">
							<p>A solution was needed to allow everyone (including beginners) to create their own NFT collection in <em>a simple, autonomous and economical way.</em></p>
						</div>
						<div class="details-col col-sm-6">
							<p>NFT Generators was born from the idea of creating your own NFT collection in complete autonomy and to be <em>able to resell them on various online marketplaces.</em></p>
						</div>
						<div class="details-col col-sm-6">
							<p><em>It is a Fast, Smart and easy to use app.</em> It is suitable for beginners but also for experts, as it is able to create breathtaking combinations of various types.</p>
						</div>
					</div>
					<div class="row details-features">
						<div class="col-sm-10 col-md-8 mx-auto">
							<h3>You no longer have to pay thousands to a team of designers and developers to create your own NFT collections!</h3>
						</div>
						<div class="details-features-list d-flex flex-wrap justify-content-center">
							<div class="details-features-item col-sm-4">
								<figure class="details-features-icon"><img src="{{env('APP_NFT_URL')}}icon-features-fast.svg" alt="Simple, fast and economical"></figure>
								<h4>Simple, fast and economical</h4>
							</div>
							<div class="details-features-item col-sm-4">
								<figure class="details-features-icon"><img src="{{env('APP_NFT_URL')}}icon-features-design.svg" alt="Suitable for all design styles"></figure>
								<h4>Suitable for all design styles</h4>
							</div>
							<div class="details-features-item col-sm-4">
								<figure class="details-features-icon"><img src="{{env('APP_NFT_URL')}}icon-features-no-coding.svg" alt="No programming skills required"></figure>
								<h4>No programming skills required</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="work-sec">
				<div class="container">
					<div class="row">
						<div class="work-sec-title col-md-10 text-center mx-auto">
							<h2 class="sec-title"><em>How does</em> it work? <small class="small-head">The generation process is very fast and is divided into 4 simple steps:</small></h2>
						</div>
					</div>
					<div class="work-steps">
						<div class="row work-steps-item align-items-center">
							<div class="work-steps-image col-md-6">
								<img src="{{env('APP_NFT_URL')}}Param.JPG" alt="Setup your parameters">
							</div>
							<div class="work-steps-desc col-md-6">
								<h3>Setup your parameters</h3>
								<p>You will be asked to create your parameters (quantity and name) for each layer that our nft will have (all the elements for example background, mouth, body etc...)</p>
							</div>
						</div>
						<div class="row work-steps-item align-items-center">
							<div class="work-steps-image col-md-6">
								<img src="{{env('APP_NFT_URL')}}Preview.JPG" alt="Preview Your NFT">
							</div>
							<div class="work-steps-desc col-md-6">
								<h3>Preview Your NFT</h3>
								<p>Once created the parameters you can preview your NFT</p>
							</div>
						</div>
						<div class="row work-steps-item align-items-center">
							<div class="work-steps-image col-md-6">
								<img src="{{env('APP_NFT_URL')}}Rari.JPG" alt="Metadata and Rarity Settings">
							</div>
							<div class="work-steps-desc col-md-6">
								<h3>Metadata and Rarity Settings</h3>
								<p>Once created the parameters you can enter the settings of the rarity for each trait (you can decide if a trait is rarer than another)</p>
							</div>
						</div>
						<div class="row work-steps-item align-items-center">
							<div class="work-steps-image col-md-6">
								<img src="{{env('APP_NFT_URL')}}Colle.JPG" alt="Enjoy the collection!">
							</div>
							<div class="work-steps-desc col-md-6">
								<h3>Enjoy the collection!</h3>
								<p>The generation process will take time depending on the size of the collection</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="footer-info col-md-5 col-lg-5">
						<a href="{{env('APP_NFT_URL')}}" title="eziNFTs" class="footer-logo">
							<img src="{{env('APP_NFT_URL')}}ezinfts-logo.svg" alt="eziNFTs">
						</a>
						<p></p>
						<ul class="social">
							<li>
								<a href="#" title="instagram" target="_blank">
									<svg xmlns="http://www.w3.org/2000/svg" width="27.5" height="27.5" viewBox="0 0 27.5 27.5"><g transform="translate(0.417 0.417)"><path d="M6-.75H20A6.758,6.758,0,0,1,26.75,6V20A6.758,6.758,0,0,1,20,26.75H6A6.758,6.758,0,0,1-.75,20V6A6.758,6.758,0,0,1,6-.75Zm14,26A5.256,5.256,0,0,0,25.25,20V6A5.256,5.256,0,0,0,20,.75H6A5.256,5.256,0,0,0,.75,6V20A5.256,5.256,0,0,0,6,25.25Z" transform="translate(0.333 0.334)" fill="#b4aebb"/><path d="M4-.75A4.75,4.75,0,1,1-.75,4,4.755,4.755,0,0,1,4-.75Zm0,8A3.25,3.25,0,1,0,.75,4,3.254,3.254,0,0,0,4,7.25Z" transform="translate(9.333 9.334)" fill="#b4aebb"/><circle cx="0.952" cy="0.952" r="0.952" transform="translate(20.119 4.473)" fill="#b4aebb"/></g></svg>
								</a>
							</li>
							<li>
								<a href="#" title="linkedin" target="_blank">
									<svg xmlns="http://www.w3.org/2000/svg" width="27.5" height="27.5" viewBox="0 0 27.5 27.5"><g transform="translate(0.75 0.75)"><path d="M6-.75H20A6.758,6.758,0,0,1,26.75,6V20A6.758,6.758,0,0,1,20,26.75H6A6.758,6.758,0,0,1-.75,20V6A6.758,6.758,0,0,1,6-.75Zm14,26A5.256,5.256,0,0,0,25.25,20V6A5.256,5.256,0,0,0,20,.75H6A5.256,5.256,0,0,0,.75,6V20A5.256,5.256,0,0,0,6,25.25Z" fill="#b4aebb"/><path d="M0,9.25A.75.75,0,0,1-.75,8.5V0A.75.75,0,0,1,0-.75.75.75,0,0,1,.75,0V8.5A.75.75,0,0,1,0,9.25Z" transform="translate(6.809 11.428)" fill="#b4aebb"/><path d="M18.88,20.14a.75.75,0,0,1-.75-.75V15.14a3.5,3.5,0,0,0-7,0v4.25a.75.75,0,1,1-1.5,0V15.14a5,5,0,0,1,10,0v4.25A.75.75,0,0,1,18.88,20.14Z" transform="translate(0.325 0.537)" fill="#b4aebb"/><path d="M0,.906A.75.75,0,0,1-.75.156V0A.75.75,0,0,1,0-.75.75.75,0,0,1,.75,0V.156A.75.75,0,0,1,0,.906Z" transform="translate(6.809 7.022)" fill="#b4aebb"/></g></svg>
								</a>
							</li>
							<li>
								<a href="#" title="facebook" target="_blank">
									<svg xmlns="http://www.w3.org/2000/svg" width="27.5" height="27.67" viewBox="0 0 27.5 27.67"><g transform="translate(-2.583 -2.583)"><path d="M6-.75H20A6.758,6.758,0,0,1,26.75,6V20A6.758,6.758,0,0,1,20,26.75H6A6.758,6.758,0,0,1-.75,20V6A6.758,6.758,0,0,1,6-.75Zm14,26A5.256,5.256,0,0,0,25.25,20V6A5.256,5.256,0,0,0,20,.75H6A5.256,5.256,0,0,0,.75,6V20A5.256,5.256,0,0,0,6,25.25Z" transform="translate(3.333 3.334)" fill="#b4aebb"/><path d="M12,28.381a.75.75,0,0,1-.75-.75V12.816A6.676,6.676,0,0,1,17.926,6.14a.75.75,0,0,1,0,1.5,5.176,5.176,0,0,0-5.176,5.176V27.631A.75.75,0,0,1,12,28.381Z" transform="translate(4.333 1.873)" fill="#b4aebb"/><path d="M8.889.75H0A.75.75,0,0,1-.75,0,.75.75,0,0,1,0-.75H8.889a.75.75,0,0,1,.75.75A.75.75,0,0,1,8.889.75Z" transform="translate(11.933 17.815)" fill="#b4aebb"/></g></svg>
								</a>
							</li>
						</ul>
					</div>
					<div class="footer-nav col-sm-6 col-md-3 offset-md-1 offset-lg-2">
						<h4>Company</h4>
						<ul class="secondary-nav">
							<li><a href="#" title="About us">About us</a></li>
							<li><a href="#" title="Blog">Blog</a></li>
							<li><a href="#" title="Contact">Contact</a></li>
							<li><a href="#" title="Terms of Use">Terms of Use</a></li>
							<li><a href="#" title="Privacy Policy">Privacy Policy</a></li>
						</ul>
					</div>
					<div class="footer-nav col-sm-6 col-md-3 col-lg-2">
						<h4>Support</h4>
						<ul class="secondary-nav">
							<li><a href="#" title="FAQs">FAQs</a></li>
							<li><a href="#" title="Help Center">Help Center</a></li>
							<li><a href="#" title="Give as Feedback">Give as Feedback</a></li>
						</ul>
					</div>
					<div class="footer-copyright">
						<p>© 2021 - 2022 eziNFTs</p>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<script src='js/app.js'></script>
</body>
</html>