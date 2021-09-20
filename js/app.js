var btnShow=document.getElementById('search-toggle');
var detail=document.getElementById('site-search');
btnShow.onclick=function(){
    if(detail.style.display=="none"){
        detail.style.display="block"
    }else{
        detail.style.display="none";
    }
}
function backTotop() {
	var scrollpos = window.scrollY;
	var backBtn = document.getElementById('back-top');
	
		window.addEventListener('scroll', function () {
			scrollpos = window.scrollY;
			if (scrollpos >= 500) {
				backBtn.classList.add("back-top-show");
			} else {
				backBtn.classList.remove("back-top-show");
			}
		});

		backBtn.addEventListener('click', () => window.scrollTo({
			top: 0,
			behavior: 'smooth',
		}));
}
backTotop();