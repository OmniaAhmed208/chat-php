let form = document.querySelector('.typing')
let inputField = form.querySelector('.inputField');
let sendBtn = form.querySelector('button');
let chatBox = document.querySelector('.chat-box');

form.onsubmit = (e)=>{
    e.preventDefault();
}

sendBtn.onclick = (e)=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/insert-chat.php"); // to insert chat messages
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; // to prevent message sent twice
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/getChat.php");
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData); // send form data to php
}, 500);