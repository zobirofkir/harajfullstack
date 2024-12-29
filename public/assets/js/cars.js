function copyToClipboard(url) {
    var input = document.createElement('input');
    input.value = url;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);

    alert("رابط تم نسخه!");
}
