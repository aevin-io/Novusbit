
		<div id="fb-root"></div>
		<script type="text/javascript">

		$('.fb-auth').click( function() {
				
					updateButton();
					return false;
				});
		function updateButton(response) {
			   FB.login(function (response) {
			            
						if (response.authResponse) {
							var accessToken = response.authResponse.accessToken;
					
							document.location.href = "<?=$base_url?>";
							
						} else {}
						
					}, {
						scope: 'email,user_about_me,publish_actions,publish_stream'
					});

		
		}
		
				
		window.fbAsyncInit = function () {
		
			FB.init({
				appId: '135925676477012',
				status: true,
				cookie: true,
				xfbml: true,
				oauth: true
			});

		
		


			
		};
		(function () {
			var e = document.createElement('script');
			e.src = document.location.protocol + '//connect.facebook.net/de_DE/all.js';
			e.async = true;
			document.getElementById('fb-root').appendChild(e);
		}());

		function login() {
			document.location.href = "<?=$base_url?>";
		}

		function logout() {
			document.location.href = "<?=$fbLogoutURL?>";
		}
	
		</script>

<div id="user-info"></div>
