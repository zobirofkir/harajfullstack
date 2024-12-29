function copyToClipboard(url) {
    var input = document.createElement('input');
    input.value = url;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);

    alert("رابط تم نسخه!");
}


function toggleFavorite(element) {
    const heartIcon = element.querySelector('#heart-icon');

    element.classList.toggle('text-red-500');

    const isFavorited = element.classList.contains('text-red-500');

    localStorage.setItem('favoriteState', isFavorited ? 'true' : 'false');
}

window.onload = () => {
    const savedFavoriteState = localStorage.getItem('favoriteState');

    if (savedFavoriteState === 'true') {
        document.querySelector('.flex').classList.add('text-red-500');
    }
}
