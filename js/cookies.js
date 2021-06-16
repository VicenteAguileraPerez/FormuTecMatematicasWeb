function setCookie(value) {
    var expires = "";

    var date = new Date();
    date.setTime(date.getTime() + (60 * 30 * 1000));//2
    expires = "; expires=" + date.toUTCString();

    console.log("sesion" + "=" + (JSON.stringify(value) || "") + expires + "; path=/");
    document.cookie = "sesion" + "=" + (JSON.stringify(value) || "") + expires + "; path=/";

}
function getCookie() {
    var nameEQ = "sesion=\"";
    var ca = document.cookie
    if (ca.length != 0) {
        return ca.substring(nameEQ.length, ca.length - 1);
    }
    else {
        return "";
    }
}
function clearCookie() {
    document.cookie = "sesion" + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';

}
