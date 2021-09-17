var submit = document.getElementById('submit');
		submit.addEventListener('click', addResultSubmit);
		var background = 0;
		var fullScreen = false;
        var pics;
        var pictures;

		function findsearch()
			{
				var request = new XMLHttpRequest();
				var search = $('#search')[0].value;
				var requestURL = 'ressource/searchFinding.php?search='+search;

				if(search.length > 2)
							{				
								request.open('GET', requestURL);
								request.reponseType = 'XML';
								request.send();
				
								request.onload = function(){
									$('#proposition').css('display', 'block');
									$('#proposition').html(request.response);
								} 
							}

				else
					{	
						$('#proposition').css('display', 'none');
					}
			}


		function addResultSubmit(event)
		{
			event.preventDefault()
			var search = $('#search')[0].value;
			var request = new XMLHttpRequest();
			var requestURL = 'ressource/searchByTown.php?search='+search;

			request.open('GET', requestURL);
			request.reponseType = 'XML';
			request.send();

			request.onload = function(){
				$('#content').html(request.response);
			}
			
		}

		function addResult(a)
		{
			var request = new XMLHttpRequest();
			var requestURL = 'ressource/searchByTown.php?search='+a;

			request.open('GET', requestURL);
			request.reponseType = 'XML';
			request.send();

			request.onload = function(){
				$('#content').html(request.response);
				$('#search')[0].value = a;
				$('#proposition').css('display', 'none');
			}
		}

		function addMore(a)
		{
			var request = new XMLHttpRequest();
			var requestURL = 'ressource/more.php?bien='+a;

			request.open('GET', requestURL);
			request.reponseType= 'XML';
			request.send();

			addPic(a);

			request.onload = function(){
				$('#content').html(request.response);
				$('#content').css('width', '80%');
				$('#content').css('justify-content', 'center');
				$('#content').css('display', 'flex');
				$('#content').css('flex-direction', 'column');
				$('.more').css('padding', 'unset');
				$('.more').css('flex-direction', 'column');
				$('.more').css('width', '100%');
				$('.more').css('height', 'auto');
				$('#img').css('width', '100%');
				$('#img').css('background-position', 'center');
				$('#img').css('background-repeat', 'no-repeat');
				
			function smoot()
				{
					var element = $('#content');

					document.querySelector('div#img').scrollIntoView({block: "start", behavior: "smooth"});
				}

				smoot();
			}

		}
		
		function deleted(a)
		{
			var request = new XMLHttpRequest(); 
			var requestURL = 'delete.php?id='+a;

			request.open('POST', requestURL);
			request.send();

			request.onload = function(){
				$('body').html(request.response);
			}
		}
        
        function addMoreConseiller(a)
        {
            var request = new XMLHttpRequest();
            var requestURL = 'moreConseiller.php?bien='+a;

            request.open('GET', requestURL);
            request.reponseType = 'XML';
            request.send();

            addPicConseiller(a);

            request.onload = function(){
                $('#content').html(request.response);
				$('#content').css('width', '100%');
				$('#content').css('justify-content', 'center');
				$('#content').css('display', 'flex');
				$('#content').css('flex-direction', 'column');
				$('#content').css('align-items', 'center');
				$('.more').css('padding', 'unset');
				$('.more').css('flex-direction', 'column');
				$('.more').css('width', '60%');
				$('.more').css('height', 'auto');
				$('more').css('margin', 'auto');
				$('#img').css('width', '100%');
				$('#img').css('background-position', 'center');
				$('#img').css('background-repeat', 'no-repeat');
            }
        }

		function suivant()
			{
				
				if(background < pics.length - 2)
					{	
						background++;
					}

				else
					{ 
						background = 0;
                    }
                    
                if(typeof pictures == 'undefined')
	                {
	                    $('#img').css('background-image', 'url('+pics[background]+')');
	                }

                else
	                {
	                    $('#img').css('background-image', 'url('+pictures[background]+')'); 
	                }
				
				return background;
            }
            
        

		function precedent()
		{
			if(background > 0)
				{	
					background--;
				}

			else if(background == 0)
				{	
					background = pics.length - 2;
				}

            if(typeof pictures == 'undefined')
                {
                    $('#img').css('background-image', 'url('+pics[background]+')');
                }

            else
                {
                    $('#img').css('background-image', 'url('+pictures[background]+')'); 
                }

			return background;
		}

		function addPic(a)
		{
			var picRequest = new XMLHttpRequest();
			var picRequestURL = 'ressource/picture.php?bien='+a;

			picRequest.open('GET', picRequestURL);
			picRequest.reponseType = 'XML';
			picRequest.send();

			picRequest.onload = function(){
				pics = picRequest.response;
				pics = pics.split(';');
				return pics;
			}

        }
        
        function addPicConseiller(a)
        {
            var picRequest = new XMLHttpRequest();
            var picRequestURL = 'picture.php?bien='+a;
            var i = 0;
            pictures = [];

            picRequest.open('GET', picRequestURL);
            picRequest.reponseType = 'XML';
            picRequest.send();

            picRequest.onload = function(){
                pics = picRequest.response;
                pics = pics.split(';');
                pics.forEach(pic =>{
                    pictures[i] = '../'+pic;
                    i++;
                });
                return pictures;
            }
        }

		function fullScreenMode()
		{
			if(fullScreen == false)
				{
					$('#img').css('position', 'fixed');
					$('#img').css('top', '0px');
					$('#img').css('left', '0px');
					$('#img').css('width', '-webkit-fill-available');
					$('#img').css('height', '-webkit-fill-available');
					$('#img').css('background-size', 'contain');
					$('#img').css('z-index', '1100');
					fullScreen = true;
					return fullScreen;
				}

			else
				{	
					$('#img').css('position', 'unset');
					$('#img').css('top', 'unset');
					$('#img').css('left', 'unset');
					$('#img').css('width', '100%');
					$('#img').css('height', '500px');
					$('#img').css('background-size', 'cover');
					fullScreen = false;
					return fullScreen;
				}
	
		}