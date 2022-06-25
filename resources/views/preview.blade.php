<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>NFT Generator</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

  <link rel='stylesheet' type='text/css' media='screen' href='css/app.css'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
<style>
.invalid-feedback {
  display: block;
}
.formcontrol {
  width: 125px;
}
.formbutton {
  width: 125px;
}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
a[name='dash'] { 
  background-color: #fff;
  color: #64408E;
}
</style>
</head>
<body>

<header class="header">
  <div class="container">
    <div class="row d-flex flex-wrap align-items-center">
      <div class="logo col-sm-4 col-md-6">
        <a href="{{env('APP_NFT_URL')}}" title="eziNFTs">
          <img src="{{env('APP_NFT_URL')}}ezinfts-logo.svg" alt="eziNFTs">
        </a>
      </div>
      <div class="header-btns col-sm-8 col-md-6">
        <a id="dash" name="dash"  href="{{env('APP_NFT_URL')}}dashboard" title="My Collections">My Collections</a>
        <a href="{{env('APP_NFT_URL')}}register" title="Account">Account</a>
        <a href="{{env('APP_NFT_URL')}}" title="Close">Close Session</a>
      </div>
    </div>
  </div>
</header>

<main class="site-content">
<div class="member-login" >

<div class="member-login-header col col-md-9 col-lg-7 mx-auto">
  <h1><em>NFT</em> Generator</h1>
</div>

<!-- <h1>NFT Generator</a></h1>
-->
<div class="container mt-4">

@csrf
  <div class="container mt-4">

    <h3>NFT Images Preview: {{$prnb}}</h3>

    <div class="form-group container mt-4">
      <button type="submit" style="float: left;" onclick="window.location='{{ route('parameters.store') }}'" name="next" class="btn btn-success" value="Next">Generate NFT</button>
      <button type="submit" style="float: right;" onclick="window.location='{{ route('files.page') }}'" name="next" class="btn btn-success" value="Next">Redo</button>
    </div> 
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

  @for ($i = 0; $i < $prnb/10; $i++)
    <div>
      @for ($j = 1+$i*10; $j < 11+$i*10; $j++)
        <img id="myImg" style="float: left;" src="/NFT{{$id}}/output/preview/{{$j}}.png" height="120px" width="120px" alt="Preview Image"/>  
      
        @endfor
    </div>
  @endfor

  <!-- The Modal -->
  <div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
  </div>

<!--
<div class="form-group container mt-4">
  <button type="submit" onclick="window.location='{{ route('files.page') }}'" name="before" class="btn btn-success" style="float: right;" value="Before">Before</button>
</div>
-->

</div>
</div>

</div>
</main>

@for ($i = 0; $i < $prnb/10; $i++)
<br>
<br>
<br>
<br>
<br>
@endfor



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
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg1");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
/*img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}*/

document.addEventListener("click", (e) => {
  const elem = e.target;
  if (elem.id==="myImg") {
    modal.style.display = "block";
    modalImg.src = elem.dataset.biggerSrc || elem.src;
    captionText.innerHTML = elem.alt; 
  }
})

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>

</body>
</html>