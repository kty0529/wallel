// global
window.__ = {
  $html: document.documentElement,
  overlay: document.querySelector('#overlay'),
}

// overlay
__.overlay.addEventListener('click', (e) => {
  if (__.$html.classList.contains('offcanvas-active')) {
    __.$html.classList.remove('offcanvas-active')
  }

  __.$html.classList.remove('scroll-lock');
  __.overlay.classList.remove('active');
});

// offcasnvas
const toggleOffcanvasButton = document.querySelector('#toggle-offcanvas');
toggleOffcanvasButton.addEventListener('click', (e) => {
  e.preventDefault();

  __.overlay.classList.toggle('active');
  ['scroll-lock', 'offcanvas-active'].map(el => __.$html.classList.toggle(el));
});

// sidebar
/* const toggleSidebarButton = document.querySelector('#toggle-sidebar');
const sidebar = document.querySelector('#sidebar');

toggleSidebarButton.addEventListener('click', (e) => {
  e.preventDefault();
  sidebar.classList.toggle('active');
  wallel.overlay.classList.toggle('active');
  wallel.root.classList.toggle('scroll-lock');
}); */
