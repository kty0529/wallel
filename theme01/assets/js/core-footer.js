const scroll_to_top = document.querySelector('#top');
scroll_to_top.addEventListener('click', (e) => {
	e.preventDefault();
	document.body.scrollIntoView({behavior: 'smooth'});
});
