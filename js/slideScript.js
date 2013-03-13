$(document).ready(function(){

	var imgArr = new Array( // relative paths of images
		'img/1.png',
		'img/2.png',
		'img/3.png',
		'img/4.png'
	);

	var preloadArr = new Array();
	var i;

	/* preload images */
	for(i=0; i < imgArr.length; i++){
		preloadArr[i] = new Image();
		preloadArr[i].src = imgArr[i];
	}

	var currImg = 1;
	var intID = setInterval(changeImg, 6000);

	/* image rotator */
	function changeImg(){
		$('.main').animate({opacity: 0}, 1000, function(){
			$(this).css('background','url(' + preloadArr[currImg++%preloadArr.length].src +') no-repeat top right');
		}).animate({opacity: 1}, 1000);
	}

});