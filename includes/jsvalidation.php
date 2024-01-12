
//first name validation
function validateFname() {
    document.getElementById("fNameErrLogo1").style.display = "none";
    document.getElementById("fNameErrLogo2").style.display = "none";
    document.getElementById("fNameCrrLogo").style.display = "none";

    let fnameElement = document.getElementById("fname");

    let fnameValue = fnameElement.value.trim();

    if (!/^[A-Za-z\s]*$/g.test(fnameValue)) {
      fnameElement.style.border = "1px solid red";

      document.getElementById("fNameErrLogo1").style.display = "block";

      $("#fNameErrLogo1").tooltip({
        show: {
          effect: "slideDown",
          delay: 250,
        },
        open: function (event, ui) {
          ui.tooltip({ top: ui.tooltip.position().top + 10 });
        },
      });
    } else if (fnameValue == "") {
      fnameElement.style.border = "1px solid lightgrey";
    } else if (fnameValue.length < 3 || fnameValue.length > 22) {
      fnameElement.style.border = "1px solid red";

      document.getElementById("fNameErrLogo2").style.display = "block";
      $("#fNameErrLogo2").tooltip({
        show: {
          effect: "slideDown",
          delay: 250,
        },
        open: function (event, ui) {
          ui.tooltip({ top: ui.tooltip.position().top + 10 });
        },
      });
    } else {
      fnameElement.style.border = "1px solid green";

      document.getElementById("fNameCrrLogo").style.display = "block";
    }
  }


  // email validation
  function validateEmail() {
    document.getElementById("emailErrLogo").style.display = "none";
    document.getElementById("emailCrrLogo").style.display = "none";
    const emailInput = document.getElementById("emailId");

    var email = emailInput.value.trim();

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(email)) {
      document.getElementById("emailCrrLogo").style.display = "block";
      emailInput.style.border = "1px solid green";
    } else if (email == "") {
      emailInput.style.border = "1px solid lightgrey";
    } else {
      emailInput.style.border = "1px solid red";

      document.getElementById("emailErrLogo").style.display = "block";

      $("#emailErrLogo").tooltip({
        show: {
          effect: "slideDown",
          delay: 250,
        },
        open: function (event, ui) {
          ui.tooltip({ top: ui.tooltip.position().top + 10 });
        },
      });
    }
  }


  // password validation 
  function validatePass() {
    document.getElementById("passNErrLogo").style.display = "none";
    document.getElementById("passNCrrLogo").style.display = "none";

    let passEle = document.getElementById("passwordF");

    let passValue = passEle.value.trim();
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,15}$/;

    if (regex.test(passValue)) {
      passEle.style.border = "1px solid green";

      document.getElementById("passNCrrLogo").style.display = "block";
    } else if (passValue == "") {
      passEle.style.border = "1px solid lightgrey";
    } else {
      passEle.style.border = "1px solid red";

      document.getElementById("passNErrLogo").style.display = "block";

      $("#passNErrLogo").tooltip({
        show: {
          effect: "slideDown",
          delay: 250,
        },
        open: function (event, ui) {
          ui.tooltip({ top: ui.tooltip.position().top + 10 });
        },
      });
    }
  }


  //confirm password validation
  function validatePassC() {
    document.getElementById("passCErrLogo").style.display = "none";
    document.getElementById("passCCrrLogo").style.display = "none";

    let passEle = document.getElementById("passwordC");

    let cpassValue = passEle.value.trim();
    let passValue = document.getElementById("passwordF").value.trim();

    if (cpassValue == "") {
      passEle.style.border = "1px solid lightgrey";

      document.getElementById("passCErrLogo").style.display = "none";
      document.getElementById("passCCrrLogo").style.display = "none";
    } else if (cpassValue == passValue) {
      passEle.style.border = "1px solid green";

      document.getElementById("passCCrrLogo").style.display = "block";
    } else {
      passEle.style.border = "1px solid red";

      document.getElementById("passCErrLogo").style.display = "block";

      $("#passCErrLogo").tooltip({
        show: {
          effect: "slideDown",
          delay: 250,
        },
        open: function (event, ui) {
          ui.tooltip({ top: ui.tooltip.position().top + 10 });
        },
      });
    }
  }


  // phone number validation
  function validatePhone() {
    document.getElementById("phoneErrLogo").style.display = "none";
    document.getElementById("phoneCrrLogo").style.display = "none";
    let phoneElement = document.getElementById("phoneNumber");

    let phoneValue = phoneElement.value.trim();

    if (phoneValue.length == 0) {
      phoneElement.style.border = "1px solid lightgrey";

      return false;
    }

    if (phoneValue.length == 10) {
      phoneElement.style.border = "1px solid green";
      document.getElementById("phoneCrrLogo").style.display = "block";
    } else {
      phoneElement.style.border = "1px solid red";

      document.getElementById("phoneErrLogo").style.display = "block";

      $("#phoneErrLogo").tooltip({
        show: {
          effect: "slideDown",
          delay: 250,
        },
        open: function (event, ui) {
          ui.tooltip({ top: ui.tooltip.position().top + 10 });
        },
      });
    }
    let cleanedInput = phoneValue.replace(/\D/g, "");
    phoneElement.value = cleanedInput;

    // Apply the phone number mask
    // let maskedInput =
    //   "(" +
    //   cleanedInput.slice(0, 3) +
    //   ") " +
    //   cleanedInput.slice(3, 6) +
    //   "-" +
    //   cleanedInput.slice(6, 10);

    // // Update the input value with the masked version
    // if (phoneValue > 9) {
    //   phoneElement.value = maskedInput;
    //   return false;
    // }
  }

  function togglePassword() {
            var passwordInput = document.getElementById("passwordF");

            // Toggle the type attribute of the password input
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

