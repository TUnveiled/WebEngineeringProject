if(!$('#header').hasClass('loaded')) {
  $('#header').load('header.html');
  $('#header').addClass('loaded');
}

result = $.ajax({
  async: true,
  type: "GET",
  url: "php/header.php",
  timeout:5000
});

result.always(function (msg) {
  console.log("handleMsg is running: " + msg);
  document.getElementById("logintext").innerText=msg;
  if(msg.charAt(0) == 'L') {
    $('#navbarSupportedContent').innerHTML = "";
    $('#navbarSupportedContent').load('LoggedInNavbar.html');
  }
});


