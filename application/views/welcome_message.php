<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/message.css">
	<script src="<?php echo base_url()?>public/js/message.js"></script>
	<script src="<?php echo base_url()?>public/js/jquery.min.js"></script>
	<script src="<?php echo base_url()?>public/websocket/fancywebsocket.js"></script>
	<script>
		var Server;

		Server = new FancyWebSocket('ws://127.0.0.1:9300');

		//tangkap apakah ada action dr client manapun
		Server.bind('message', function( payload ) {
		    switch (payload) {
		        case 'tobingmsg':
		           dhtmlx.message({
						'text': "From other at "+new Date().toLocaleString(),
						'expire': -1
					});
		           break;
		        case 'tobingerror':
		           dhtmlx.message({
						'text': "From other at "+new Date().toLocaleString(),
						'expire': -1,
						'type' : 'error',
					});
					break;   
		    }
		});
		 
		Server.connect();


		//kirim pesan tobingmsg
		function send() {
			//munculkan pesan buat diri sendiri
			dhtmlx.message({
				'text': "From you at "+new Date().toLocaleString(),
				'expire': -1
			});

			//sampaikan ke server bahwa telah terjadi action
			Server.send( 'message', 'tobingmsg' );
		}

		//kirim pesan tobingerror
		function senderror() {
			//munculkan pesan buat diri sendiri
			dhtmlx.message({
				'text': "From you at "+new Date().toLocaleString(),
				'expire': -1,
				'type' : 'error'
			});

			//sampaikan ke server bahwa telah terjadi action
			Server.send( 'message', 'tobingerror' );
		}
	</script>
</head>
<body>
	<button id="send" onclick="send()">Send</button>
	<button id="error" onclick="senderror()">Send Error</button>

</body>
</html>


<?php
/*

$autoload['helper'] = array('url');

$config['base_url'] = 'http://localhost/ci-websocket/';

*/



?>