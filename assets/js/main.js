window.onload=function(){
    
}

$(document).ready(function(){
    previewTags();
    $('.modal').modal();
    $('.dropdown-trigger').dropdown();

    $('select').formSelect();

    $("#styleButtonChooseBlogTags").click(function(){
        $('.modal').modal('close');
    });

    $("#btnSignUp").click(signUp);
   
    previewBlogs();

    $('body').on('click', 'a#delete', function(e){ 
        e.preventDefault();

        let id = $(this).parent().parent().parent().data("id");

        $.ajax({
            url: "model/blog/deleteBlog.php",
            method: "post",
            data: {
                "id": id,
                "btnDeleteBlog": true
            },
            success: function (data) {
                console.log(data);
                // if (data.response) {
                M.toast({ html: data, displayLength: 3000 });
                previewBlogs();
                //     $('.modal').modal('close');
                //     // $("#successSignUp").html(data.message);
                // }
            },
            error: function (status) {
                console.log(status);
            }
        });
    });

   /************************************************* A D M I N     P A G E  **********************************************/
    getVisitedFiles();
});

var successSignUp;
function signUp(){
    successSignUp = 0;

    let username = $("#username").val();
    let email = $("#email").val();
    let password = $("#password").val();
    let passwordConfirm = $("#passwordConfirm").val();

    let regUsername = /^[a-zA-Z0-9]{6,30}$/;
    let regEmail = /^[a-z]+[a-z0-9\?\+\_\.\-]*@[a-z]{2,10}(\.[a-z]{2,4})+$/;
    let regPassword = /^.{8,40}$/;

    checkInput(username, regUsername, 'username', 'Username must have at least 6 characters and start with a letter');
    checkInput(email, regEmail, 'email', 'Wrong format of an e-mail address');
    checkInput(password, regPassword, 'password', 'Password must have at least 8 characters');

    if (password != passwordConfirm) {
        $("#passwordConfirm").next().next().html('Passwords are not matched');
        successSignUp++;
    }
    else {
        $("#passwordConfirm").next().next().html('');
    }

    if (!successSignUp) {
        $.ajax({
            url : "model/user/signUp.php",
            method : "post",
            data : {
                "username" : username,
                "email" : email,
                "password" : password,
                "passwordConfirm" : passwordConfirm,
                "btnSignUp" : true
            },
            success : function(data){
                    // console.log(data);
                if(data.response)
                {  
                    M.toast({ html: data.message, displayLength: 3000});
                    $('.modal').modal('close');
                    // $("#successSignUp").html(data.message);
                }

                deleteInputData("username");
                deleteInputData("email");
                deleteInputData("password");
                deleteInputData("passwordConfirm");
            },
            error: function (status){
                console.log(status);
            }
        });
    }
}

var successSignIn;
function signIn() {
     successSignIn = 0;

    let username = $("#usernameLogin").val();
    let password = $("#passwordLogin").val();

    let regUsername = /^[a-zA-Z0-9]{6,30}$/;
    let regPassword = /^.{8,40}$/;

    checkInput(username, regUsername, 'usernameLogin', 'Username must have at least 6 characters and start with a letter');
    checkInput(password, regPassword, 'passwordLogin', 'Password must have at least 8 characters');

    if (!successSignIn){
        return true;
    }
    else{
        return false;
    }
}

function checkInput(field, criteria, id, message) {
    if (!criteria.test(field)) {
        $("#" + id).next().next().html(message);
        successSignUp++;
        successSignIn++;
    }
    else {
        $("#" + id).next().next().html('');
    }
}

function deleteInputData(id) {
    $("#" + id).val('');
}

function previewTags(){
    $.ajax({
        url: "model/blog/getBlogTags.php",
        method: "post",
        data: {
            "getTagsRequest": true
        },
        success: function (data) {
            let html = '';
            i=0;
            html3 = '';
            html4='';
            html = `<p class="smallMessage"> Choose blog tags </p>`;
            for (let one of data) {
                html += `<p class="itslabel">
                    <label>
                        <input type="checkbox" name="chooseTags[]" value= ${one.tag_id} />
                        <span>${one.title}</span>
                    </label> </p>`;
                html3 += `<p class="radios">
                    <label>
                        <input type="checkbox" name="tags[]" value= ${one.tag_id} />
                        <span>${one.title}</span>
                    </label> </p>`;

                html4 += `<p class="radios">
                    <label>
                        <input type="radio" name="t[]" value= ${one.tag_id} />
                        <span>${one.title}</span>
                    </label> </p>`;
            }
            
            html += `<p class="errorP center" id="checkOne"> </p>`;
            $("#getTagOffer").html(html);


            let html2 = '';
            for (let one of data) {
                html2 += `<li> <a href="#" class="d-flex "> ${one.title} <span>(2)</span> </a> </li>`;
            }

            html3 += `<input type="button" value="Delete tag" class="btn btnPostBlog mt-0" name="btnPostBlog" />`;
            html4 += `<div class="input-field">
                        <i class="material-icons prefix">subject</i>
                        <input type="text" id="blogTitle" name="blogTitle">
                        <label for="blogTitle">Edit tag</label>
                        <p class="center errorP"> </p>
                    </div>`;
            html4 += `<input type="button" value="Edit tag" class="btn btnPostBlog mt-0" name="btnPostBlog" />`;
            $("#forTags").html(html2);
            $("#admindelete").html(html3);
            $("#adminedit").html(html4);
        },
        error: function (status) {
            console.log(status);
        }
    });
}

var successAddBlog;
    function addBlog(){
    successAddBlog = 0;
    

    let title = $("#blogTitle").val();
    let text = $("#blogText").val();
    let picture = document.getElementById("file-input").files[0];

    console.log(picture);

    if(!/^.{1,}$/.test(title))
    {
        $("#blogTitle").next().next().html("Write something");
        successAddBlog++;
    }
    else{
        $("#blogTitle").next().next().html("");
    }

    if (!/^.{1,}$/.test(text)) {
        $("#blogText").next().next().html("Write something");
        successAddBlog++;
    }
    else {
        $("#blogText").next().next().html("");
    }

    let selected = [];
    $('input:checked').each(function (){
        selected.push($(this).attr('value'));
    });
    
    if(selected.length == 0)
    {
        $("#checkOne").html("Choose at least one tag");
        successAddBlog++;
    }
    else{
        $("#checkOne").html("");
    }

    if(picture == undefined){
        $("#allErrors").html("Insert an jpg/jpeg image");
        successAddBlog++;
    }
    
    if(successAddBlog == 0)
        return true;
    else
    return false;

}

function previewBlogs(){
    $.ajax({
        url: "model/blog/getBlogs.php",
        method: "post",
        data: {
            "getAllBlogs": true
        },
        success: function (data) {
            html = '';

            for(let one of data.blogs)
            {
                console.log(one);

                html+=`<div class="blog mt-4" data-id="${one.blog_id}">
                    
                    <div class="userShortcut d-flex align-items-center justify-content-between mb-1">
                        <div class="d-flex align-items-center">`;

                        let username = one.username;
                        let first = username.split("")[0].toUpperCase();

                        html+=`<span class="firstLetter"> ${first} </span>
                            <a href="#"> ${one.username} </a>
                        </div>`;

                if(one.logged == one.whoPosted)
                    html +=`<div><a href="#" id="delete"><i class="material-icons editicons">delete</i></a></div>`;
                html+=`
                    </div>
                    <p class="date mb-1"> ${one.date}h </p>
                    <div class="slika"><img src="${one.image}" alt="${one.title}" class="contentImage" /></div> <div class="types d-flex flex-wrap">`;

                for(let tag of one.tags)
                {
                    html+=`<span data-tag_id="${tag.tag_id}"> ${tag.title} </span>`;
                }
                    
                html+=`
                    </div>
                    <h2> ${one.title}</h2>
                    <p class="content"> ${one.text} </p>
                    
                </div>`;
            }

            $("#blogsPreview").html(html);
        },
        error: function (status) {
            console.log(status);
        }
    });
}

function getVisitedFiles(){
    $.ajax({
        url: "model/admin/getVisitedPages.php",
        method: "post",
        data: {
            "visitedPages": true
        },
        success: function (data) {
            html='';
            console.log(data);
                
            html +=` <table class="mt-4 mb-5">
                        <thead>
                            <tr>
                                <th class="uppercase title ths">Page name</th>
                                <th class="uppercase title ths">Number of visits</th>
                                <th class="uppercase title ths">Average access</th>
                            </tr>
                        </thead>
                        <tbody>`;

                for(i=0; i<data.pages.length; i++)
                {
                    html+=`<tr>`;
                    html += `<td> ${data.pages[i]} </td>`;
                    html += `<td> ${data.number[i]} </td>`;
                    let result = data.number[i] / data.total * 100;
                    
                    html += `<td> ${result}% </td>`;
                    html += `</tr>`;
                }
            html +=`</tbody>
                        </table>`;

            $("#visited").html(html);
        },
        error: function (status) {
            console.log(status);
        }
    });
}