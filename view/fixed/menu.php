<?php
    require_once("model/link/getMenuLinks.php");
?>
    
    <div class="container-fluid background stayHere">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="background right">
                        <div class="nav-wrapper">
                            <a href="#!" class="brand-logo uppercase title"><h1>E&#45;blog</h1></a>
                            <ul id="addBecomeFixed">

        <?php if(isset($_SESSION['user']) && $_SESSION['user']->role_id == 1): ?>
          
            <?php $forPreview = getMenuLinks("user"); ?>
                <?php foreach($forPreview as $one): ?>
                                <li class="link">
                                    <a href="<?= $one->href ?>">
                                        <i class="material-icons left"> <?=$one->icon ?> </i>
                                        <span class="disappear">
                                            <?=$one->name ?>
                                        </span>
                                    </a>
                                </li>
                <?php endforeach; ?>

          <?php elseif(isset($_SESSION['user']) && $_SESSION['user']->role_id == 2): ?>
              <?php $forPreview = getMenuLinks("admin"); ?>
                  <?php foreach($forPreview as $one): ?>
                                <li class="link">
                                    <a href="<?= $one->href ?>">
                                        <i class="material-icons left"> <?=$one->icon ?> </i>
                                        <span class="disappear">
                                            <?=$one->name ?>
                                        </span>
                                    </a>
                                </li>
                  <?php endforeach; ?>
        <?php else: ?>
              <?php $forPreview = getMenuLinks("unauthorised"); ?>
                  <?php foreach($forPreview as $one): ?>
                              <li class="link"><a class="waves-effect waves-light btn modal-trigger"  href="<?=$one->href?>"> <?= $one->name ?> </a></li>
                  <?php endforeach; ?>
        <?php endif; ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<!-- SIGN IN MODAL -->
 <div id="modalSignIn" class="modal">
    <p class="modal-close">&#10005;</p>
    <div class="modal-content center">
        <h2 class="formFont mb-4">Sign In</h2>
    <form action="model/user/signIn.php" method="post" autocomplete="off" onSubmit="return signIn();">
      <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <input type="text" id="usernameLogin" name="usernameLogin">
        <label for="usernameLogin">Username</label>
        <p class="errorP"></p>
      </div>
      <div class="input-field">
        <i class="material-icons prefix">lock</i>
        <input type="password" id="passwordLogin" name="passwordLogin">
        <label for="passwordLogin">Password</label>
        <p class="errorP" id="unsuccessSignIn"> <!-- //sessionCheckAndPreview('errorSignIn');--> </p>
      </div>
      <input type="submit" value="Sign In" class="btn btnSignIn mt-3" id="btnSignIn" name="btnSignIn"/>
    </form>
  </div>
</div>

<!-- SIGN UP MODAL -->
 <div id="modalSignUp" class="modal">
    <p class="modal-close">&#10005;</p>
    <div class="modal-content center">
        <h2 class="formFont mb-4">Sign Up</h2>
    <form id="formSignUp" autocomplete="off">
      <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <input type="text" id="username">
        <label for="username">Username</label>
       <p class="errorP"></p>
      </div>
      <div class="input-field">
        <i class="material-icons prefix">email</i>
        <input type="text" id="email">
        <label for="email">E-mail</label>
        <p class="errorP"></p>
      </div>
      <div class="input-field">
        <i class="material-icons prefix">lock</i>
        <input type="password" id="password">
        <label for="password">Password</label>
        <p class="errorP"></p>
      </div>
      <div class="input-field">
        <i class="material-icons prefix">lock</i>
        <input type="password" id="passwordConfirm">
        <label for="passwordConfirm">Confirm password</label>
        <p class="errorP"></p><p id="successSignUp"></p>
      </div>
      <input type="button" value="Sign Up" class="btn btnSignUp mt-2" id="btnSignUp" name="btnSignUp">
      
    </form>
  </div>
</div>