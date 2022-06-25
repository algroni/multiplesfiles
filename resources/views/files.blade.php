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

.modal {

    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}



.loader {
  margin: auto;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;

}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

a[name='dash'] { 
  background-color: #fff;
  color: #64408E;
}

</style>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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
        <a href="{{env('APP_NFT_URL')}}account" title="Account">Account</a>
        <a href="{{env('APP_NFT_URL')}}" title="Close">Close Session</a>
      </div>
    </div>
  </div>
</header>

<main class="site-content">

<div class="modal"><!-- Place at bottom of page --></div>

<div class="member-login" >

<div class="member-login-header col col-md-9 col-lg-7 mx-auto">
  <h1><em>NFT</em> Generator</h1>
</div>

<!-- <h1 class="container mt-4">NFT Generators</a></h1> 
-->

@if(session()->has('success'))
  <div class="container mt-4">
    <div class="alert alert-success container mt-4">
      {{ session()->get('success') }}
    </div>
    <div>
      <button type="submit" style="float: left;" onclick="window.location='{{ route('parameters.store') }}'" name="next" class="btn btn-success" value="Next">Generate NFT</button>
      <button type="submit" style="float: right;" onclick="preview()" name="next" class="btn btn-success" value="Next">Preview NFT </button>
    </div>  
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div id="loading"></div>
  </div>  
@else
  @if (count($errors)>0)  
    <div class="container mt-4">
      <div class="alert alert-success container mt-4">
        Please review the fields form
      </div>
    </div>  
  @endif
@endif


@if(!session()->has('success'))
  <div class="container mt-4">
  <h3 >NFT Parameters: </h3>
  

    @if ($paramn == 0)
      <form method="post" action="{{ route('files.store') }}"  >
        @csrf

        <h3>Voucher Code</h3>
        <div>
          <input type="text" class="form-control" value="" size="80" id="voucher" name="voucher" required >
        </div>

        @if ($msgvouchers == 'The voucher code is not correct')  
          <div class="container mt-4">
            <div class="alert alert-success container mt-4">
              The voucher code is not correct
            </div>
          </div>  
        @endif

        <div class="form-group container mt-4">  
          <button type="submit" class="btn btn-success" name="validate" value="Validate" >Validate</button>
        </div>
      </form>
    @else
        <form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data" onsubmit="return validate()" >
          @csrf
          
          <select id="quapa" name="quapa" >
            <option>--Select--</option>

            @for ($i = 4; $i <= $paramn; $i++)
              <option value="{{$i}}">{{$i}}</option>
            @endfor
            @for ($j = $paramn+1; $j <= 15; $j++)
              <option value="{{$j}}" title="Contact to our team to access" disabled>{{$j}}</option>
            @endfor

          </select>
          <br>
          <br>
          <div id="nftFields"></div>
          <div id="inputArea"></div>

        </form> 
    @endif
  </div>
@endif


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

<script> 

  $("#quapa").change(function () {
    //$("#inputArea").innerHTML('');
    $("#inputArea").remove(); 
    $("#nftFields").append('<div id="inputArea"></div>');
    var numInputs = $(this).val();
    $("#inputArea").append('<h3>Upload Images</h3>');
    for (var i = 1; i <= numInputs; i++)
      $("#inputArea").append('<h4>Parameter '+i+'</h4><input class="form-control" type="text" id="par'+i+'"'
            +' name="par'+i+'" placeholder="Parameter Name" aria-label="Parameter Name" required><div class="form-group">'
            +'<input type="file" class="form-control" id="parameter'+i+'" name="parameter'+i+'[]" multiple class="form-control" min="4" data-max="10" onchange="checkFileUploadExt(this.id);" required accept="image/*" ></div>');

    $("#inputArea").append('<div class="form-group"><button type="submit" name="save" class="btn btn-success" value="Save" >Upload Images</button></div>');
      
  });

  var error = "";
  var error1 = "";
  var error2 = "";
  sessionStorage.setItem("errors",error);

  function checkFileUploadExt(name) {
    var control = document.getElementById(name);
    var filelength = control.files.length;
    if (filelength < 4) {
      error1 = "Please make sure your put at least 4 images ";
      //sessionStorage.setItem("errors",error);
      //alert(error1);
    }else{
      if (filelength > 10) { 
        error2 = "Please make sure your put maximun 10 images";
        //sessionStorage.setItem("errors",error);
        //alert(error2);
        //console.error(error);
      }else{
        error1 = "";
        error2 = "";
      }
    }
    error = error1 + error2;
    sessionStorage.setItem("errors",error);

  }
  function validate(){
    var erro1="";
    var erro2="";
    var erro ="";

    for (var i=1; i<=document.getElementById("quapa").value; i++){
      var control = document.getElementById("parameter"+i);
      var filelength = control.files.length;
      if (filelength < 4) {
        erro1 = "Please make sure your put at least 4 images \r\n";

      }else{
        if (filelength > 10) { 
          erro2 = "Please make sure your put maximun 10 images";

        }
      }      
    }
    erro = erro1+erro2;

    if (erro!=""){
      alert(erro);
      return false;
    }

  }

  function preview(){
    alert('Loading the preview images... Please wait');
    $("#loading").append('<div class="loader"></div>');
    document.location.href = '{{ route('preview.page') }}';
  }

  $body = $("body");

  $(document).on({
      ajaxStart: function() { $body.addClass("loading");    },
      ajaxStop: function() { $body.removeClass("loading"); }    
  });

</script> 

</body>
</html>