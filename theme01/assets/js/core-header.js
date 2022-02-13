// tab
function Tab(selector) {
	this.selector = selector;

	let container = this.selector;
	container = document.querySelector(container);

	const nav = container.querySelectorAll('.tab-nav-item');
	const wrapper = container.querySelector('.tab-wrapper');
	const item = wrapper.querySelectorAll('.tab-item');

	nav.forEach((elm, idx) => {
		if ( idx == 0 ) {
			elm.classList.add('tab-nav-item-active');
			item[0].classList.add('tab-item-active');
		}

		elm.addEventListener('click', (e) => {
			e.preventDefault();

			if ( ! elm.classList.contains('tab-nav-item-active') ) {
				container.querySelector('.tab-nav-item-active').classList.remove('tab-nav-item-active');
				elm.classList.add('tab-nav-item-active');

				// show item
				wrapper.querySelector('.tab-item-active').classList.remove('tab-item-active');
				item[idx].classList.add('tab-item-active');
			}
		});
	});
}

// indexes
function Indexes(elements, target) {
	this.elements = elements;
	this.target = target;

	const getElements = this.elements;
	const setTarget = this.target;

	document.querySelectorAll(getElements).forEach((elm, idx) => {
		idx = idx + 1;
		elm.setAttribute('id', `heading-${idx}`);
		const heading = elm.tagName;
		const target = document.querySelector(setTarget);
		const txt = elm.textContent;

		target.insertAdjacentHTML('beforeend', `<li class="heading-${heading.toLowerCase()}"><a href="#heading-${idx}">${txt}</a></li>`);
	});
}
