function handleMsg(msg) {
  switch (msg.charAt(0)) {
    case '4':
      alert(msg.substr(4));
      $('#maincontainer').innerHTML = "";
      $('#maincontainer').load('NewSeller.html');
      break;
    case '2':
      alert(msg.substr(4));
      window.location.replace("yourlistings.html");
      break;
    case '3':
    case '5':
      alert(msg.substr(4));
      break;
    case '6':
      alert("something unexpected happened");
      break;
  }

}



$('#NewListingButton').click(function() {
  let result = $.ajax({
    async: true,
    type: "POST",
    url: "php/newlisting.php",
    timeout:5000,
    data: {
      productName: $('#pname').val(),
      manufacturer: $('#manu').val(),
      price: $('#price').val(),
      stock: $('#stock').val(),
      imageLink: $('#image').val(),
      description: $('#desc').val()
    }
  });

  result.always(handleMsg);
});
