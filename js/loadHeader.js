$('#header').load('header.html');



result = $.ajax({
  async: true,
  type: "GET",
  url: "php/header.php",
  timeout:5000
});

result.always(function (msg) {
  document.getElementById("logintext").innerText=msg;
  if(msg.charAt(0) == 'L') {
    $('#navbarSupportedContent').innerHTML = "";
    $('#navbarSupportedContent').load('LoggedInNavbar.html');
  } else if (msg.charAt(0) == 'A') {
    $('#navbarSupportedContent').innerHTML = "";
    $('#navbarSupportedContent').load('AdminNavbar.html');
  }
});


