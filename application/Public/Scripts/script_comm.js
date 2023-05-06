document.getElementById('button-js').onclick = function () {
    let text = document.getElementById('text').value;
    sendComment(text)
}

function subComment(btn,comment_id,text) {

    btn.addEventListener('click', function (e) {
        if(!document.querySelector('[data-parent="'+comment_id+'"]')) {
            let comment_btn = document.createElement('button');
            let new_comment = document.createElement('textarea');
            new_comment.id = 'first_answear_'+comment_id;
            new_comment.style = 'width: 30%;display: block;margin-left:110px'
            comment_btn.innerHTML = 'Send';
            comment_btn.style = 'width: 100px;border-radius: 5px;font-size: 10px;margin-left:110px;margin-top:5px';
            comment_btn.className = 'sub-comment'
            comment_btn.dataset.parent = comment_id
            comment_btn.classList = 'btn btn-outline-success'
            comment_btn.type = 'button'

            btn.after(comment_btn);
            btn.after(new_comment);
            comment_btn.onclick = createSubComment
        } else {
            hideSubBlock(comment_id)
        }
    })
}


function hideSubBlock(comment_id) {
   if(document.getElementById('first_answear_'+comment_id))  document.getElementById('first_answear_'+comment_id).remove();
   if( document.querySelector('[data-parent="'+comment_id+'"]'))  document.querySelector('[data-parent="'+comment_id+'"]').remove();
}

function sendComment(text_comment,comment_id = false) {
    let formData = new FormData();
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "http://guestbook/main/main");

    if (text_comment) formData.append('text_comment', text_comment);
    if (comment_id) formData.append('comment_id', comment_id);

    xhttp.send(formData);
    xhttp.onload = function () {
        response = JSON.parse(this.responseText)
        if (response['status'] == 'success') {
            createComment(response)
            if(comment_id) {
                hideSubBlock(comment_id)
            } else {
                document.getElementById('text').value = ''
                document.getElementById('text').style = 'width: 30%;;height: 110px;';
            }
        } else {
            if (!comment_id) {
                document.getElementById('text').style = 'width: 30%;;height: 110px;border-color: red;border-width: medium;';
            } else {
                document.getElementById('first_answear_'+comment_id).style = 'width: 30%;border-color: red;border-width: medium;display:block;margin-left: 110px;';
            }
        }
    }   
}

function createSubComment(v = {}) {
    v.comment_id = this.dataset.parent
    v.text_comment = document.getElementById('first_answear_'+this.dataset.parent).value
    sendComment(v.text_comment,v.comment_id)
}

function createComment(v) {
    let main_container = document.createElement('ul');
    let container = document.createElement("li");
    let name = document.createElement("div");
    let container2 = document.createElement("div");
    let value = document.createElement("div");
    let value2 = document.createElement("div");
    let div_image = document.createElement("div");
    let btn = document.createElement('button');

    main_container.id = 'tree_comments_' + v.id;
    btn.classList = 'btn btn-success btn-sm'
    btn.style = 'margin-left: 40px;margin-top: 5px;'
    btn.type = 'button'
    btn.innerHTML = 'Ответить';

    let image = document.createElement('img');
    image.src = "/application/public/images/" + v['avatar_type'] + ".png";
    div_image.append(image);
    image.style = 'width: 50px;background-color: darkgray;border-radius: 20px;margin-right: 15px;';
    name.style = 'margin-right:5px;font-size: 20px;font-family: monospace;';
    v.text_comment.style = "font-family: monospace;font-size: 17px;";
    value.style = 'margin-right:5px;font-size: 20px;font-family: monospace;';
    container.style = "margin-left: 10px;text-align: left;align-items: center;background-color: grey;border-radius: 10px;padding: 9px;height: auto;width: 36%; margin-botom: 5px;display: flex;"
    let com2 = document.createElement("br");

    this.subComment(btn,v.id,text)
    
    value.append(v.username);
    value2.append(v.text_comment);

    container2.append(value);
    container2.append(value2);
    container.append(div_image);
    container.append(container2);
    container.append(value2);

    if (v.comment_id == null) {
        document.getElementById('comment_container').append(main_container);
        document.getElementById('tree_comments_' + v.id).append(container);
        document.getElementById('tree_comments_' + v.id).append(btn);
        document.getElementById('tree_comments_' + v.id).append(com2);
    } else {
        if ((document.getElementById('tree_comments_' + v.comment_id))) {
            document.getElementById('tree_comments_' + v.comment_id).append(main_container);
            container.style = "margin-top:10px; margin-left:40px;text-align: left;align-items: center;background-color: grey;border-radius: 10px;padding: 9px;height: auto;width: 36%; margin-botom: 5px;display: flex;"
            main_container.append(container, btn, com2)
        }
    }
}


window.onload = function () {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "http://guestbook/main/getComment");
    xhttp.send()

    xhttp.onload = function () {
        let data = JSON.parse(this.responseText);
        data.forEach(function (v) {
            this.createComment(v)
        })
    }
}

$('.avatar-item').on("click", function () {
    $.ajax({
        type: "POST",
        url: "http://guestbook/main/changeUserAvatar",
        async: false,
        data: {
            "id": this.id
        },
        success: function (text) {
            swal("Success!", "You avatar changed!", "success")
            .then(function(isConfirm) {
                window.location.reload() 
            });
          
        }
    });

})
