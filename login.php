<div id="alert" style="display:none;"></div>
<form name="login" action="php/login_handler.php" method="post">
  <input type="text" name="eou" placeholder="Email or Username" pattern=".{4,}">
  <input type="password" name="password" placeholder="Password" pattern="^.{5,20}$">
  <input type="submit" value="Login">
</form>
<form id="activation-form" name="activation" action="php/login_handler.php" method="post" style="display: none;">
    <input type="text" name="activation_code" placeholder="Activation code" pattern="\d{4,5}">
    <input type="hidden" name="id">
    <input type="submit" value="Submit">
</form>

<script type="text/javascript">
  var loginForm = $('form[name=login]'),
    activationForm = $('form[name=activation]'),
    alert = $('#alert'),
    loginSubmit = $("form[name=login] input[type=submit]")[0],
    activationSubmit = $("form[name=activation] input[type=submit]")[0],
    password = $("input[name=password]"),
    eou = $("input[name=eou]"),
    ac = $("input[name=activation_code]")

	var checkLoginFields = () => loginSubmit.disabled = !(eou.val().length > 0 && password.val().length > 0)

	loginForm.submit(e=>{
		e.preventDefault()
		$.post("php/login_handler.php", loginForm.serialize(), res=>{
      alert.hide(400)
      setTimeout(()=>{
        alert.removeClass().text(res.message)
        if (res.success) {
          alert.addClass('success').show(400)
          setTimeout(()=>window.location.replace("/"), 2500)
        } else if (res.not_activated) {
          alert.addClass('note').show(400)
          loginForm.hide(400)
          activationForm.hide().delay(400).show(400)
          $('form[name=activation] input[name=id]').val(res.id)
        } else {
          alert.addClass('failure').show(400)
        }
      }, 400)

		})
	})


  activationForm.submit(e=>{
    e.preventDefault()
    $.post("php/login_handler.php", activationForm.serialize(), res=>{
      alert.hide(400)
      setTimeout(()=>{
        alert.removeClass().text(res.message)
        if (res.success) {
          alert.addClass('success').show(400)
          setTimeout(()=>window.location.replace("/"), 4000)
        } else {
          alert.addClass('failure').show(400)
        }
      }, 400)

    })
  })
</script>
