  var usernameCheck = false,
    passwordCheck = false

  var submit = $("input[type=submit]")[0],
    alert = $("#alert")

  function checkUsernameAvailability() {
    var un = $("#username"),
      unCheck = $("#username-check")
    if (un.val().length > 3 && un.val().length < 16) {
      jQuery.ajax({
        url: "php/check_username_availability.php",
        data:'username='+un.val(),
        type: "POST",
        success:data=>{
          var msg = (data=="success" ? "Username available." : "Sorry, that username is taken."),
            notData = (data=="success" ? "failure" : "success")
          unCheck.text(msg).removeClass(notData).addClass(data).show(400)
          usernameCheck = true
          inputButton()
        },
        error:()=>{}
      });
    } else if ((un.val().length > 0 && un.val().length < 4) || un.val().length > 15) {
      unCheck.text("Username must be 4-15 characters.").removeClass("success").addClass("failure").show(400)
      usernameCheck = false;
      inputButton();
    } else {
      unCheck.hide(400)
    }
  }


  function checkPasswordMatch() {
    var password = $('#password').val(),
      confirmPassword = $('#confirm-password').val(),
      passwordMatch = $('#password-match')

    if ((4 < password.length && password.length < 21) || (4 < confirmPassword.length && confirmPassword.length < 21)) {
      if (password !== confirmPassword) {
        passwordMatch.removeClass().addClass('failure').text("Passwords do not match.").show(400)
        passwordCheck = false;
        inputButton();
      } else {
        passwordMatch.removeClass().addClass("success").text("Passwords match.").show(400)
        passwordCheck = true;
        inputButton();
      }
    } else if (password.length === 0 && confirmPassword.length === 0) {
      passwordMatch.hide()
    } else {
      passwordMatch.removeClass().addClass("failure").text("Password must be 5-20 characters.")
      passwordCheck = false;
      inputButton();
    }
  }

  const inputButton = () => submit.disabled = !(usernameCheck && passwordCheck)

  $('form[name=register]').submit(e=>{
    e.preventDefault()
    submit.disabled = true
    var formData = $('form[name=register]').serialize()
    $.post('php/register_handler.php', formData, res => {
      alert.hide(400)
      setTimeout(()=>{
        alert.removeClass().text(res.message)
        if (res.success) {
          alert.addClass("success").show(400)
          setTimeout(()=>window.location.replace("/"), 4000)
        } else {
          alert.addClass("failure").show(400)
        }
      }, 400)
    })
  })
