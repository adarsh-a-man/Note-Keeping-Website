//ajax call for the sign up form

$("#signupform").submit(function (event) {
  // prevent default php processing
  event.preventDefault();
  var datatopost = $(this).serializeArray();
  // console.log(datatopost);
  $.ajax({
    url: "signup.php",
    type: "POST",
    data: datatopost,
    success: function (data) {
      if (data == "failed") {
        $("#signupmessage").html(data);
      }
    },
    error: function () {
      $("#signupmessage").html(
        "<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>"
      );
    },
  });
});
// ajax call for the log in form
$("#loginform").submit(function (event) {
  // prevent default php processing
  event.preventDefault();
  var datatopost = $(this).serializeArray();
  console.log(datatopost);
  $.ajax({
    url: "login.php",
    type: "POST",
    data: datatopost,
    success: function (datareturned) {
      // if (data != "gotcha") {
      //   //   // window.open("mainpage.php", "_self");
      //   window.location = "mainpage.php";
      //   // window.location = "mainpage.php";
      //   // window.location.assign("mainpage.php");
      // } else {
      //   // $("#loginmessage").html(data);
      //   alert("I dont know");
      // }
      if (datareturned) {
        if (datareturned != "success") window.location = "mainpage.php";
        else {
          window.location = "mainpage.php";
        }
      }
    },
    error: function () {
      $("#signupmessage").html(
        "<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>"
      );
    },
  });
});

$("#forgotpasswordform").submit(function (event) {
  // prevent default php processing
  event.preventDefault();
  var datatopost = $(this).serializeArray();
  // console.log(datatopost);
  $.ajax({
    url: "forgot-password.php",
    type: "POST",
    data: datatopost,
    success: function (data) {
      if (data) {
        $("#forgotpasswordmessage").html(data);
      }
    },
    error: function () {
      $("#signupmessage").html(
        "<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>"
      );
    },
  });
});
