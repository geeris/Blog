<?php
    require("model/link/getFooterLinks.php");
?>
        
        <footer class="page-footer background pt-0">
            <div class="container">
                <div class="row pt-2 pb-3 d-flex align-items-center">
              
                    <div class="col-lg-6 col-md-12">
                        <h3 class="white-text change title uppercase underline center">Find us on</h3>
                        <ul class="m-0">

                        <?php $footerLinks = getFooterLinks("social"); ?>
                            <?php foreach($footerLinks as $one): ?>
                                      <li class="center"><a class="grey-text text-lighten-3" target="_blank" href="<?= $one->href ?>"> <?= $one->name ?> </a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-12 ">
                        <h3 class="white-text change center title underline uppercase">Useful links</h3>
                        <ul>

        <?php $footerLinks = getFooterLinks("additional"); ?>
            <?php foreach($footerLinks as $one): ?>
                <?php if($one->name == 'Author'): ?>
                      <li class="center"><a class="grey-text text-lighten-3 modal-trigger" href="<?= $one->href ?>"> <?= $one->name ?> </a></li>
                <?php else: ?>
                      <li class="center"><a class="grey-text text-lighten-3" target="_blank" href="<?= $one->href ?>"> <?= $one->name ?> </a></li>
                <?php endif; ?>
            <?php endforeach; ?>
                      </ul>
                  </div>

                </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
                <p class="center addColor"> Copyright <span class="copy">&copy;</span> Gabrijela Matović 2020 </p>
            </div>
          </div>
        </footer>
        
        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script src="assets/js/materialize.min.js"></script>
        <script src="assets/js/main.js" type="text/javascript"></script>
    </body>
</html>


<div id="author" class="modal d-flex flex-column justify-content-center">
    <h4 class="uppercase title center mb-3"> Author </h4>
    <div class="center"><img src="assets/images/author.jpg" id="author" alt="Author's picture" /> </div>
    <p class="center"> Gabrijela Matovic 21/18 </p>
    <p class="center"> geeris77@gmail.com </p>
    <a class="btn m-3" href="model/link/wordDownload.php"> Export as word file </a>
</div>