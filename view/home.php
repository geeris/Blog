<?php if(isset($_SESSION['blogMade'])): ?> 
            <script> alert("<?= $_SESSION["blogMade"] ?>"); </script>
        <?php unset($_SESSION["blogMade"]); ?>
<?php endif; ?>


<div class="container">
    <div class="row mt-2">
        <div class="col-lg-3 col-sm-12 mt-4">
            <select class="sortList">
                <option class="first" value="0" disabled selected>Sort blogs</option>
                <option value="1">Show popular</option>
                <option value="2">Show newest first</option>
                <option value="3"> Show oldest first</option>
            </select>
            <ul class="d-flex flex-column blogType mt-4" id="forTags">
                <!-- JS -->
            </ul>
        </div>
            
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="postBlog mt-4">
                        <form action="model/blog/makeBlog.php" enctype="multipart/form-data" method="post" id="addBlog" onSubmit="return addBlog();">
                            <div class="input-field">
                                <i class="material-icons prefix">subject</i>
                                <input type="text" id="blogTitle" name="blogTitle">
                                <label for="blogTitle">Insert title</label>
                                <p class="center errorP"> </p>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">edit</i>
                                <textarea id="blogText" name="blogText" class="materialize-textarea"></textarea>
                                <label for="blogText">Insert text</label>
                                <p class="center errorP"> </p>
                            </div>
                            <div class="d-flex flex-row justify-content-around">
                                <!-- <a href="#modalGetBlogTags" id="tagOffer" class="add modal-trigger"> Add blog tags <i class="material-icons addImage">add_circle</i></a> -->
                                    <div class="d-flex justify-content-between flex-wrap mb-3" id="getTagOffer">
                                         
                                    </div>
                                
                            </div>
                            <div class="d-flex justify-content-around">
                                
                                <input type="submit" value="Post blog" class="btn btnPostBlog mt-3" name="btnPostBlog">
                                <div class="image-upload mt-3">
                                    <label for="file-input" class="add center">
                                        <span class="disappear350">Add image</span><i class="material-icons addImage">collections</i>
                                    </label>
                                    <input id="file-input" name="blogFile" type="file" />
                                </div>
                            </div>
                            <p class="errorP center mt-3" id="allErrors"> 
                                <?php if(isset($_SESSION['errors']))
                                {
                                    $errors = $_SESSION["errors"];
                                    foreach($errors as $one){
                                        echo $one;
                                    }
                                }
                                ?>
                             </p>
                        </form>   
                    </div>            
                </div>
            </div>

            <div class="row changewidth mb-5">
                <div class="col-12 d-flex flex-wrap justify-content-between deleteP" id="blogsPreview">
                    

                        <!-- <div class="blog mt-4">
                        <div class="userShortcut d-flex align-items-center mb-1">
                            <img src="assets/images/header.jpg" />
                            <a href="#"> mile123 </a>
                        </div>
                        <p class="date mb-1"> 27.07.2020. 03:03h </p>
                        <img src="assets/images/header.jpg" class="contentImage" />
                        <div class="types d-flex flex-wrap">
                            <span> #food </span>
                            <span> #bure </span>
                            <span> #travelling </span>
                        </div>
                            <h2> Naslov bloga i najnovije vesti ovog meseca</h2>
                            <p class="content"> Cao </p>
                        <div class="comments">
                            <a href="#"> read 10 comments forthis blog </a>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div>
