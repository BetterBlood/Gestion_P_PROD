<?php
/**
 * Authors : Julien Steiner Miranda
 * Date : 02.11.2020
 * Description : fonctions utilitaires
 */

function displayLoginSection()
{
    if(isset($_SESSION["isConnected"]))
    {
      echo '<form method="post">

              <label for="username">Connecté en tant que ' . $_SESSION["username"] . ' avec les droits de niveau ' . $_SESSION["isConnected"] . ' </label>

              <button type="submit" name="logout" class="btn btn-primary btn-sm"">Logout</button>
            </form>';
    }
    else
    {
      echo '<form method="post">

                <input type="text" class="form-control-sm" id="username" aria-describedby="userHelp" name="username" placeholder="Username">


                <input type="password" class="form-control-sm" id="password" name="password" placeholder="Password">

              <button type="submit" name="login" class="btn btn-primary btn-sm">Login</button>
            </form>';
    }
}

function login($pageName,$teachers,$students)
{
  foreach($teachers as $teacher)
  {
    if($_POST["username"] == $teacher["teaUserName"]) // && password_verify($_POST["password"], $user["usePassword"]))
    {
        $_SESSION["isConnected"] = 2;
        $_SESSION["username"] = $_POST["username"];
        header("location: " . $pageName);
    }
  }
  foreach($students as $student)
  {
    if($_POST["username"] == $student["stuUserName"]) // && password_verify($_POST["password"], $user["usePassword"]))
    {
        $_SESSION["isConnected"] = 1;
        $_SESSION["username"] = $_POST["username"];
        header("location: " . $pageName);
    }
  }
}

function logout($pageName)
{
    session_destroy();
    header("location: " . $pageName);
}
?>