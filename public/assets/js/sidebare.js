const menuButton = document.getElementById('menuButton');
const closeButton = document.getElementById('closeButton');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

menuButton.addEventListener('click', () => {
  sidebar.classList.remove('sidebar-hidden');
  sidebar.classList.add('sidebar-open');
  overlay.classList.remove('hidden');
});

closeButton.addEventListener('click', () => {
  sidebar.classList.remove('sidebar-open');
  sidebar.classList.add('sidebar-hidden');
  overlay.classList.add('hidden');
});

overlay.addEventListener('click', () => {
  sidebar.classList.remove('sidebar-open');
  sidebar.classList.add('sidebar-hidden');
  overlay.classList.add('hidden');
});
