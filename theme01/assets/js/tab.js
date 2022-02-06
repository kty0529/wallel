function Tab(selector) {
	this.selector = selector;

	selector = document.querySelector(selector);
	const nav = selector.querySelectorAll('.tab-nav-item');
	const wrapper = selector.querySelector('.tab-wrapper');
	const item = wrapper.querySelectorAll('.tab-item');

	nav.forEach((elm, idx) => {
		const target = elm.getAttribute('href').replace('#', '');
		console.log(item[0]);

		if ( idx == 0 ) {
			elm.classList.add('tab-nav-item-active');
			item[0].classList.add('tab-item-active');
		}

		elm.addEventListener('click', (e) => {
			e.preventDefault();

			if ( ! elm.classList.contains('tab-nav-item-active') ) {
				selector.querySelector('.tab-nav-item-active').classList.remove('tab-nav-item-active');
				elm.classList.add('tab-nav-item-active');

				// show item
				wrapper.querySelector('.tab-item-active').classList.remove('tab-item-active');
				item[idx].classList.add('tab-item-active');
			}
		});
	});
}
