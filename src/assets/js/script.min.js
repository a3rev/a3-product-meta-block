
function isInViewport(el) {
  var top = el.offsetTop;
  var left = el.offsetLeft;
  var width = el.offsetWidth;
  var height = el.offsetHeight;

  while(el.offsetParent) {
    el = el.offsetParent;
    top += el.offsetTop;
    left += el.offsetLeft;
  }

  return (
    top < (window.pageYOffset + window.innerHeight) &&
    left < (window.pageXOffset + window.innerWidth) &&
    (top + height) > window.pageYOffset &&
    (left + width) > window.pageXOffset
  );
}

function _a3_SingleProductScroll() {
  var a3SidebarContainer = document.getElementById("single-product-sidebar");

  var bodyoffsetTop = document.documentElement.scrollTop || document.body.scrollTop;

  if( bodyoffsetTop > a3SidebarContainer.offsetTop + 100){
  	document.querySelector('.wccom-product-sticky-top-bar').classList.remove("hidden");
  }else{
  	document.querySelector('.wccom-product-sticky-top-bar').classList.add("hidden");
  }

  if( isInViewport(a3SidebarContainer) ) {
  	document.querySelector('.wccom-product-sticky-bottom-bar').classList.add("hidden");
  }else{
  	document.querySelector('.wccom-product-sticky-bottom-bar').classList.remove("hidden");
  }

}
window.addEventListener("load", _a3_SingleProductScroll);
window.addEventListener("scroll", _a3_SingleProductScroll);
