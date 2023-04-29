
document.getElementById('button-js').onclick = function () {
    let formData = new FormData();
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        console.log(this.responseText);
        let response = JSON.parse(this.responseText);

        if (response['status'] == 'success') {
            let container = document.createElement("div");
            let name = document.createElement("div");
            let value = document.createElement("div");
            let div_image = document.createElement("div");
            let image = document.createElement('img');

            image.src = "/application/public/images/"+response['avatar_type']+".png";
            div_image.append(image);
            image.style = 'width: 50px;background-color: darkgray;border-radius: 20px;margin-right: 15px;';
            name.style = 'margin-right:5px;font-size: 20px;font-family: monospace;';
            text.style = "font-family: monospace;font-size: 17px;";
            value.style = '';
            let comment = document.createElement("div");
            container.style = " text-align: left;align-items: center;background-color: grey;border-radius: 10px;padding: 9px;height: auto;width: 36%; margin-botom: 5px;display: flex;"
            let com2 = document.createElement("br");

            name.append(response['username']);
            comment.append(text);

            value.append(name);
            value.append(comment);

            container.append(div_image);
            container.append(value);

    
            document.getElementById('comment_container').append(container);
            document.getElementById('comment_container').append(com2);

        } else {
            console.log('err')
            document.getElementById('user').style = "width: 20%;border-color:red;border-width: medium";
            document.getElementById('text').style = 'width: 475px;height: 110px;border-color: red;border-width: medium;';
        }
    }

    xhttp.open("POST", "http://guestbook/main/main");

    let text = document.getElementById('text').value;

    formData.append('text_comment', text);

    xhttp.send(formData);
}

window.onload = function () {
    let formData = new FormData();
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {

        console.log(this.responseText);
        let data = JSON.parse(this.responseText);
   
        console.log(data);
        data.forEach(function (v) {

         
            
            let container = document.createElement("div");
            let container2 = document.createElement("div");
            let value = document.createElement("div");
            let value2 = document.createElement("div");
            let div_image = document.createElement("div");

            let name = document.createElement("div");
            let image = document.createElement('img');

            image.src = "/application/public/images/"+v['avatar_type']+".png";
            div_image.append(image);
            image.style = 'width: 50px;background-color: darkgray;border-radius: 20px;margin-right: 15px;';
            name.style = 'margin-right:5px;font-size: 20px;font-family: monospace;';
            v.text_comment.style = "font-family: monospace;font-size: 17px;";
            value.style = 'margin-right:5px;font-size: 20px;font-family: monospace;';
            let comment = document.createElement("div");
            container.style = "text-align: left;align-items: center;background-color: grey;border-radius: 10px;padding: 9px;height: auto;width: 36%; margin-botom: 5px;display: flex;"
            let com2 = document.createElement("br");

            value.append(v.username);
            value2.append(v.text_comment);

            container2.append(value);
            container2.append(value2);

            container.append(div_image);
            container.append(container2);


            document.getElementById('comment_container').append(container);
            document.getElementById('comment_container').append(com2);

        })
    }
    xhttp.open("POST", "http://guestbook/main/getComment");
    xhttp.send();
}


    $('.avatar-item').on( "click", function() {
        $.ajax({ 
            type: "POST",   
            url: "http://guestbook/main/changeUserAvatar",   
            async: false,
            data: {
                "id": this.id
            },
            success : function(text)
            {
                swal("Success!", "You avatar changed!", "success");
                console.log(text)
                response = text;
            }
    });

})



