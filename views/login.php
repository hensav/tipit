<!DOCTYPE html>
<html>
<head>
    <title>tipit dirty</title>
</head>
<body>


<div class="login">

    <form method="POST" class="login form">
        <input placeholder="your e-mail" name="loginEmail" value="" class="form__field">
        <input type="text" name="phone" value="" class="form__field field--optional">
        <input type="password" placeholder="verification code" name="auth" class="form__field">
        <input type="submit" value="login" class="form__button">
    </form>

</div>

optional modifier'id

<div class="signup">
    <form method="POST" class="signup form">
        <input type="text" name="role" value="" class="form__field">
        <input type="text" name="phone" value="" class="form__field field--optional">
        <input type="email"  name="signupEmail" value="" class="form__field">
        <input type="text" name="firstname" value="" class="form__field field--optional">
        <input type="text" name="lastname" value="" class="form__field field--optional">
        <input type="password" placeholder="verification code" name="auth" class="form__field">
        <input type="submit" value="register" class="form__button">
    </form>
</div>

</body>
</html>