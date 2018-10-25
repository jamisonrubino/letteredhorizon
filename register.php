<div id="alert" style="display: none;"></div>
<form name="register" action="php/register_handler.php" method="post">
  <input type="text" name="username" id="username" placeholder="Username" onblur="checkUsernameAvailability()">
    <span id="username-check" style="display: none;"></span> <!-- SHOULD BE INLINE WITH USERNAME FIELD-->

  <input type="password" name="password" id="password" placeholder="Password" onkeyup="checkPasswordMatch()">
  <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" onkeyup="checkPasswordMatch()">
    <span id="password-match" style="display:none;"></span> <!-- SHOULD BE BELOW CONFIRMPASSWORD -->

  <input type="email" name="email" placeholder="Email" required>
    <span class="note">Please enter a valid email for your confirmation code.</span>

  <input type="submit" value="Register" disabled="true">
</form>
<script type="text/javascript" src="js/register.js"></script>
