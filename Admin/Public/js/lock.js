var Lock = function () {

    return {
        //main function to initiate the module
        init: function () {

             $.backstretch([
		        "../theme/Theme1/image/bg/1.jpg",
		        "../theme/Theme1/image/bg/2.jpg",
		        "../theme/Theme1/image/bg/3.jpg",
		        "../theme/Theme1/image/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		      });
        }

    };

}();