// common
const scroll_to_top = document.querySelector('#top');
scroll_to_top.addEventListener('click', (e) => {
	e.preventDefault();
	document.body.scrollIntoView({behavior: 'smooth'});
});

// modal
const modal = {
	uid: '',
	html: {
		outer: {
			elm: '',
			evt: function() {
				modal.close();
			}
		},
		inner: {
			elm: '',
			evt: function(e) {
				e.stopPropagation();
			}
		},
		overlay: '',
	},
	open: function(target) {
		const t = this;

		// 데이터 정의
		t.uid = target;
		t.html.outer.elm = document.querySelector(`#${t.uid} .modal-outer`);
		t.html.inner.elm = document.querySelector(`#${t.uid} .modal-inner`);
		t.html.overlay = document.querySelector('#overlay');

		// 모달 + 배경 호출
		document.querySelector(`#${t.uid}`).classList.add('active');
		t.html.overlay.classList.add('active');

		// 닫기 이벤트 추가
		t.html.outer.elm.addEventListener('click', t.html.outer.evt);
		t.html.inner.elm.addEventListener('click', t.html.inner.evt);
	},
	close: function() {
		const t = this;

		// 모달 + 배경 제거
		document.querySelector('.modal').classList.remove('active');
		t.html.overlay.classList.remove('active');

		// 추가한 닫기 이벤트 제거
		t.html.outer.elm.removeEventListener('click', t.html.outer.evt);
	},
}
