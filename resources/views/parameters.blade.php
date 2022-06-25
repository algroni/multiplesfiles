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
  width: 106px;
}
.formbutton {
  width: 125px;
}
textarea {
  width: 730px;
  height: 150px;
}
a[name='dash'] { 
  background-color: #fff;
  color: #64408E;
}
</style>
</head>
<body onload="updateValueInput()">

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


<div class="container mt-4">

<div class="member-login-header col col-md-9 col-lg-7 mx-auto">
  <h1><em>NFT</em> Generation</h1>
</div>

<!-- <h2>NFT Generation</a></h2>
-->

<form method="post" action="{{ route('parameters.run') }}" >
@csrf
  <div class="container mt-4">

    <h3>NFTs you can create</h3>
    <div>
      <input type="text" class="form-control" readonly="readonly" value="{{$quantotal - $membertotal}}" id="tot" name="tot" >
    </div>  


    <!-- <h2>NFT {{ session()->get('id') }}</h2> -->
    <h3>NFT Images Quantity </h3>
    <!-- <input class="formcontrol" onchange="updateValueInput()" type="number" value="1" min="1" max="10000" id="qua" name="qua" aria-label="Rarity">
-->

    <select id="qua" name="qua" onchange="updateValueInput()">

    @if ($gnnb==100 || $quantotal - $membertotal < 300)  
      <option value="20">20</option>
      <option value="100">100</option>
      <option value="300" title="Contact to our team to access" disabled>300</option>
      <option value="500" title="Contact to our team to access" disabled>500</option>
      <option value="1000" title="Contact to our team to access" disabled>1000</option>
      <option value="3000" title="Contact to our team to access" disabled>3000</option>
      <option value="5000" title="Contact to our team to access" disabled>5000</option>
      <option value="10000" title="Contact to our team to access" disabled>10000</option>   
    @else  
      @if ($gnnb==300 || $quantotal - $membertotal < 500)  
        <option value="20">20</option>
        <option value="100">100</option>
        <option value="300" >300</option>
        <option value="500" title="Contact to our team to access" disabled>500</option>
        <option value="1000" title="Contact to our team to access" disabled>1000</option>
        <option value="3000" title="Contact to our team to access" disabled>3000</option>
        <option value="5000" title="Contact to our team to access" disabled>5000</option>
        <option value="10000" title="Contact to our team to access" disabled>10000</option>               
      @else  
        @if ($gnnb==500 || $quantotal - $membertotal < 1000)  
          <option value="100">100</option>
          <option value="300" >300</option>
          <option value="500" >500</option>
          <option value="1000" title="Contact to our team to access" disabled>1000</option>
          <option value="3000" title="Contact to our team to access" disabled>3000</option>
          <option value="5000" title="Contact to our team to access" disabled>5000</option>
          <option value="10000" title="Contact to our team to access" disabled>10000</option>                
        @else  
          @if ($gnnb==1000 || $quantotal - $membertotal < 3000)
            <option value="100">100</option>
            <option value="300" >300</option>
            <option value="500" >500</option>
            <option value="1000" >1000</option>
            <option value="3000" title="Contact to our team to access" disabled>3000</option>
            <option value="5000" title="Contact to our team to access" disabled>5000</option>
            <option value="10000" title="Contact to our team to access" disabled>10000</option>               
          @else
            <option value="100">100</option>
            <option value="300" >300</option>
            <option value="500" >500</option>
            <option value="1000" >1000</option>
            <option value="3000" >3000</option>
            <option value="5000" title="Contact to our team to access" disabled>5000</option>
            <option value="10000" title="Contact to our team to access" disabled>10000</option>            
          @endif
        @endif                      
      @endif            
    @endif      

    </select>

    <h2></h2>

    <h3>NFT Collection Name</h3>
    <div>
      <input type="text" class="form-control" value="" size="80" id="cname" name="cname" >
    </div>

    <h3>Created by</h3>
    <div>
      <input type="text" class="form-control" value="" size="80" id="created" name="created" >
    </div>

    <h3>About the Collection</h3>
    <div>
      <textarea value="" class="form-control" id="about" name="about" ></textarea>
    </div>
    
    <h3>How many NFTs Created</h3>
    <div>
      <input type="text" class="form-control" readonly="readonly" value="" id="quant" name="quant" >
    </div>  

    <br>
    <br>
    <h3>NFT Parameter</h3>

  @for ($i = 0; $i < $quapa; $i++)
    @if (empty($databack[$i]))
      <h2></h2>
    @else
      @foreach ($databack[$i] as $got)
        @if ($got == reset($databack[$i])) 
          <br>
          <h3>{{$got->trait}}</h3>
        @endif
      @endforeach
    @endif

    <div>
      @foreach ($databack[$i] as $got)
        <img src="{{$got->path}}{{$got->name}}" style="float: left;" height="110px" width="110px" alt="Images"/>
        
      @endforeach
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
      @if (empty($databack[$i]))
        <h4></h4>
      @else
        <h4>Fit Rarity Percentage (%)</h4>
      @endif

    <div>
      @foreach ($databack[$i] as $got)
        <input class="formcontrol" onchange="getValueInput(this.name);" type="number" min="0" max="100" value="{{$got->rarity}}" id="{{$got->id}}" name="{{$got->id}}" placeholder="Rarity" aria-label="Rarity">
      @endforeach
    </div>  


      @if (empty($databack[$i]))
        <h4></h4>
      @else
        <h4>Parameter Quantity</h4>
      @endif


    <div>
      @foreach ($databack[$i] as $got)
        <input class="formcontrol" readonly="readonly" type="text" value="" id="{{$got->id.'qua'}}" name="{{$got->id.'qua'}}" placeholder="Quantity" aria-label="Quantity">
      @endforeach
    </div>

    @if(session()->has('errorbackper'.$i))
    <div class="container mt-4">
      <div class="alert alert-success container mt-4">
          {{ session()->get('errorbackper'.$i) }}
      </div>
    </div>  
    @endif 

  @endfor

    <div class="form-group container mt-4">  
      <button type="submit" class="btn btn-success" name="generate" value="Generate" >Generate</button>
    </div>
</form>
<!--
<div class="form-group container mt-4">
  <button type="submit" onclick="window.location='{{ route('files.page') }}'" name="before" class="btn btn-success" style="float: right;" value="Before">Before</button>
</div>
-->
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

<script> 
      function updateValueInput(){
        //alert(name+'qua');
        let id = '';
        let v1 = 0;
        let v2 = 0;
        let v3 = 0;
        let quant = document.getElementById('qua').value;
        let tota = document.getElementById('tot').value;
        
        //if (tota >= quant){
        document.getElementById('quant').value = quant;

        @for ($i = 0; $i < $quapa; $i++)
          @foreach ($databack[$i] as $got)
            id = {{$got->id}}+'qua';
            v1 = document.getElementById({{$got->id}}).value;
            v2 = document.getElementById('qua').value;
            v3 = v1*v2/100;
            document.getElementById(id).value = v3; 
          @endforeach
        @endfor
        //}else{
        //  alert('You can create maximun '+tota+' NFTS');
        //}
                 
      }
      function getValueInput(name){
        //alert(name+'qua');
        let id = name+'qua';
        let v1 = 0;
        let v2 = 0;
        let v3 = 0;
        v1 = document.getElementById(name).value;
        v2 = document.getElementById('qua').value;
        v3 = v1*v2/100;
        document.getElementById(id).value = v3; 

      }
      
    </script> 

</body>
</html>