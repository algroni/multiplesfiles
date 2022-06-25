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
  <script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js"></script>
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
textarea {
  width: 730px;
  height: 150px;
}
.buttondownload { 
  font-size: 14px;
  font-weight: 100;
  line-height: 1;
  text-decoration: none;
  font-family: "Poppins", sans-serif;
  color: #ffffff;
  background-color: #64408E;
  display: table;
  margin: 0 auto;
  padding: 5px 6px;
  min-width: 158px;
  text-align: center;
  border-radius: 14px;
  margin-top: 1px;
  letter-spacing: 0.02em;
  border: 0;
  cursor: pointer;
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
          <img src="{{env('APP_NFT_URL')}}EziNFTS.png" alt="eziNFTs">
        </a>
      </div>
      
      <div class="header-btns col-sm-8 col-md-6">
        <a id="dash" name="dash" href="{{env('APP_NFT_URL')}}dashboard" title="My Collections">My Collections</a>
        <a href="{{env('APP_NFT_URL')}}account" title="Account">Account</a>
        <a href="{{env('APP_NFT_URL')}}" title="Close">Logout</a>
      </div>

    </div>
  </div>

</header>

<main class="site-content">

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
        <button class="btn btn-primary mt-5" onclick="web3Login();">Log in with MetaMask</button>
        </div>
    </div>
</div>

<div class="member-login" >

<!-- <h1>NFT Generator</a></h1>
-->
<div class="container mt-4">
<form method="post" action="{{ route('dashboard.create') }}" >
@csrf
  <div class="container mt-4">
    <!-- <h2>NFT {{ session()->get('id') }}</h2> -->
    <div class="member-login-header col col-md-9 col-lg-7 mx-auto">
      <h1><em>Welcome</em> Member {{$name}}</h1> 
    </div>
    <!-- <input class="formcontrol" onchange="updateValueInput()" type="number" value="1" min="1" max="10000" id="qua" name="qua" aria-label="Rarity">
-->

    <h2></h2>
    <h3>NFT Collections</h3> 

    <h3 class="form-label">Maximum NFT to Create</h3>
    <div>
      <input type="text" class="form-control" readonly="readonly" value="{{$maxnft}}" size="80" id="username" name="username" required >
    </div>

    <h3 class="form-label">Total NFT Created</h3>
    <div>
      <input type="text" class="form-control" readonly="readonly" value="{{$totcrea}}" size="80" id="email" name="email" required >
    </div>
    <br>

    <table class="table table-sm table-striped">
      @if($dashboards == null)
        <thead>
            <tr>
                <th>You don't have any NFT Collection</th>
            </tr>
        </thead>
        <tbody>

        </tbody>  
      @else
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Creation Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          @foreach($dashboards as $dashboard)
            <tr>
              <td>{{ $dashboard->collection_name }}</td>
              <td>{{ $dashboard->NFT_quantity }}</td>
              <td>{{ $dashboard->status }}</td>
              <td>{{ date('d-m-Y', strtotime($dashboard->created_at)) }}</td>
              @if($dashboard->status == 'Available')
                <td><button type="submit" class="buttondownload btn-sm btn btn-success" name="submit" value="{{ $dashboard->id_generator }}" >Download</button></td>
              @else
              <td></td>
              @endif
            </tr>
          @endforeach
        </tbody>
      @endif
    </table>

    @if(session()->has('errorqua'))
      <div class="container mt-4">
        <div class="alert alert-success container mt-4">
          {{ session()->get('errorqua') }}
        </div>
      </div>  
    @endif
    <div class="form-group container mt-4">  
      <button type="submit" class="btn btn-success" name="submit" value="Generate" >Generate a NFT Collection</button>
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
    async function web3Login() {
        //alert('web3');
        if (!window.ethereum) {
            alert('MetaMask not detected. Please install MetaMask first.');
            return;
        }
        //alert('web4');
        const provider = new ethers.providers.Web3Provider(window.ethereum);

        let response = await fetch('/web3-login-message');
        const message = await response.text();

        await provider.send("eth_requestAccounts", []);
        const address = await provider.getSigner().getAddress();
        const signature = await provider.getSigner().signMessage(message);
        //alert(address);
        //alert(signature);
        response = await fetch('/web3-login-verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'address': address,
                'signature': signature,
                '_token': '{{ csrf_token() }}'
            })
        });
        const data = await response.text();
        alert(data);
        console.log(data);
    }
</script>


</body>
</html>