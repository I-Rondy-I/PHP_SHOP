<nav class="navbar navbar-inverse navabar-fixed-top">
               <div class="container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a href="../index.php" class="navbar-brand">Sklep Gier</a>
                   </div>
                   
                   <div class="collapse navbar-collapse" id="myNavbar">
                       <ul class="nav navbar-nav navbar-right">
                           <?php
                           if(isset($_SESSION['logged_user'])){
                           ?>
                           <li><a href="../template-shop/cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Koszyk</a></li>
                           <li><a href="../settings.php"><span class="glyphicon glyphicon-cog"></span> Ustaw Hasło</a></li>
                           <li><a href="../logOut.php"><span class="glyphicon glyphicon-log-out"></span> Wyjść</a></li>
                           <?php
                           }else{
                            ?>
                           <li><a href="../template-register/signUp.php"><span class="glyphicon glyphicon-user"></span> Rejestracja</a></li>
                           <li><a href="../template-login/signIn.php"><span class="glyphicon glyphicon-log-in"></span> Logowanie</a></li>
                           <?php
                           }
                           ?>
                           
                       </ul>
                   </div>
               </div>
</nav>