<!DOCTYPE html>
<html lang="id" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <?php echo form_open("login/login_check") ?>
    <table align="center">
      <tr></tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <center>Login</center>
      <tr>
        <td>ID Pegawai</td>
        <td>
          <input type="text" name="id_pegawai" value="" placeholder="ID Pegawai" autofocus>
        </td>
      </tr>
      <tr>
        <td>Password</td>
        <td>
          <input type="password" name="password" value="" placeholder="Password">
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" name="submit" value="Log In" ></td>
      </tr>
    </table>
  </body>
</html>
