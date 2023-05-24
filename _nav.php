<?php 
session_start(); // Make sure to start the session

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}

echo '<nav class="navbar navbar-expand-lg" style="background-color: blue;">
    <img src="./assets/Asset 212.png" alt="logo" class="img-logo">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">';

if (!$loggedin) {
    echo '<li class="nav-item">
                <form action="/loginsystem/signup.php">
                    <button type="submit" class="btns1">JOIN NOW</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="/loginsystem/login.php">
                    <button type="submit" class="btns2">LOGIN</button>
                </form>
            </li>';
} else {
    echo '<li class="nav-item">
                <form action="/loginsystem/logout.php">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </li>';
}

echo '</ul>
    </div>
</nav>';
?>





<!-- <form class="form-inline my-2 my-lg-0">
  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form> -->
