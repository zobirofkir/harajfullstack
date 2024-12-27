function toggleDropdown(id) {
    const dropdown = document.getElementById(id);

    if (dropdown.classList.contains('max-h-0')) {
        dropdown.classList.remove('max-h-0');
        dropdown.classList.add('max-h-screen');
    } else {
        dropdown.classList.remove('max-h-screen');
        dropdown.classList.add('max-h-0');
    }
}
