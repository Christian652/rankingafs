const btn = document.getElementById("btn-toggle");
const aside = document.getElementById("menu-lateral");

btn.addEventListener('click',function(){
	aside.classList.toggle('toggled');
});