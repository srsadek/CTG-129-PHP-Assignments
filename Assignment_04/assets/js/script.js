

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})


let filetoUpload = document.getElementById("avatar_upload");

filetoUpload.onchange = function(e){
    let fileUrl = URL.createObjectURL(e.target.files[0]);
    //img-to-upload
    let imgPreview = document.getElementById("img-preview");
    imgPreview.src = fileUrl;
}


let matchCaptchaReload = document.getElementById("reload-math-captcha");

matchCaptchaReload.onclick = function (e) {
    let captchaImg = document.getElementById("math-captcha");
    captchaImg.src = 'captcha.php?' + Math.random();
}