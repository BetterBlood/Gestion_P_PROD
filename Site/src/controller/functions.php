<?php
/** 
 * Auteurs : Julien Leresche, Jeremiah Steiner et Ricardo Delgado Miranda
 * Date : 02.12.2020
 * Description : Fonctions du site
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
    if($_POST["username"] == $teacher["teaUserName"] && password_verify($_POST["password"], $teacher["teaPassword"]))
    {
        $_SESSION["isConnected"] = 2;
        $_SESSION["idUser"] = $teacher["idTeacher"];
        $_SESSION["username"] = $_POST["username"];
        header("location: " . $pageName);
    }
  }
  foreach($students as $student)
  {
    if($_POST["username"] == $student["stuUserName"] && password_verify($_POST["password"], $student["stuPassword"]))
    {
        $_SESSION["isConnected"] = 1;
        $_SESSION["idUser"] = $student["idStudent"];
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

function makeFullName($firstname,$lastname)
{
  return $firstname . ' ' . $lastname;
}
?>