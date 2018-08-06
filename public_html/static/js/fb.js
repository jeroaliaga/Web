  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    //console.log('statusChangeCallback');
    //console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if(response.status === 'connected'){
      console.log('Logged in and authenticated');
      setElements(true);
      testAPI();
    }
    else{
      console.log('Not authenticated');
      setElements(false);
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1281870161950178',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.1' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

     FB.getLoginStatus(function(response) {
      //statusChangeCallback(response);
    });

     //document.getElementById('logout').style.display = 'none';

  };
  

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome! jijiijijjij ');
    /*
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
    */
  }

  function setElements(isLoggedIn){

    if(isLoggedIn){
      //document.getElementById('logout').style.display = 'block';
      document.getElementById('fb-btn').style.display = 'none';
    }
    else{
      //document.getElementById('logout').style.display = 'none';
      document.getElementById('fb-btn').style.display = 'block';
    }

  }

  function logout(){

    FB.logout(function(){
      setElements(false);
    });
    
  }

  var fbbtn = document.getElementById('fb-btn');
  console.log(fbbtn);
  fbbtn.addEventListener('click', function() {
    //do the login
    FB.login(statusChangeCallback, {scope: 'email,public_profile', return_scopes: true});
  }, false);
