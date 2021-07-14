const navslide= ()=>{
	const burger = document.getElementsByClassName('burger');
	const nav = document.getElementsByClassName('nav-links');
	burger[0].addEventListener('click',()=>{
	nav[0].classList.toggle('nav-active');
	});
}
navslide();