(function ($) {

	"use strict";

	var fullHeight = function () {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function () {
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

})(jQuery);




const body = document.body;
const darkModeSwitch = document.getElementById('darkModeSwitch');
// JavaScript to toggle dark/light mode
let navTheme = document.getElementById('navbar');

document.addEventListener('DOMContentLoaded', function () {
	// Retrieve the theme value from local storage
	let theme = localStorage.getItem('theme');


	// Set the data-bs-theme attribute based on the theme value
	if (theme === 'dark') {
		document.documentElement.setAttribute('data-bs-theme', 'dark');
		navTheme.classList.add('bg-dark')

	} else {
		// Default to 'light' if the theme is not set or if it's not 'dark'
		document.documentElement.setAttribute('data-bs-theme', 'light');
		navTheme.classList.add('bg-light')
	}

	document.getElementById('turn-back').addEventListener('click', () => {
		window.history.back();
	})


});



darkModeSwitch.addEventListener('click', function (e) {
	e.preventDefault();
	
	let theme = localStorage.getItem('theme');

	if (theme === 'light') {
		localStorage.setItem('theme', 'dark')
		document.documentElement.setAttribute('data-bs-theme', 'dark');
		navTheme.classList.remove('bg-light');
		navTheme.classList.add('bg-dark');
	}
	else {
		localStorage.setItem('theme', 'light')
		document.documentElement.setAttribute('data-bs-theme', 'light');
		navTheme.classList.remove('bg-dark');
		navTheme.classList.add('bg-light');
	}
});

