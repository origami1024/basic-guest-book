(function(){
	$('#myModal').on('shown.bs.modal', function () {
  	$('#msgInp').trigger('focus')
	})
	let cIndex = 0;
	function send(e){
		e.preventDefault();
		let txt = msgInp.value;
		let nam = nameInp.value;
		let mai = mailInp.value;
		if (mai == "") {mai = "no mail";}
		$.ajax({
			type: 'GET',
		  url: 'msgAdd.php',
		  //contentType: 'application/json',
		  data : { 'name' : nam, 'text' : txt , 'mail': mai },
		  success: function(data) {
		  	//console.log('wots this');
		    //$('.result').html(data);
		  }
		});
		msgInp.value = '';

		let $elem = $('#loader');
		$elem.show();
		$({deg: 0}).animate({deg: 180}, {
        duration: 500,
        step: function(now) {
          // in the step-callback (that is fired each step of the animation),
          // you can use the `now` paramter which contains the current
          // animation-position (`0` up to `angle`)
          $elem.css({
            transform: 'rotate(' + now + 'deg)'
          });
        }
    });
		setTimeout(function(){
			$('#myModal').modal('hide');
			$('#loader').hide();
		}, 300);
	}
	theForm.addEventListener("submit", send);
	function upd() {
		$.ajax({
			type: 'GET',
		  url: 'msgFresh.php',
		  contentType: 'application/json',
		  data : { 'cIndex' : cIndex},
		  success: function(data) {
		  	//console.log('atsucc raw: ' + data);
		  	let doScroll = false;
		  	let objDiv = document.getElementById("chatPanel");
		  	if (objDiv.scrollTop == (objDiv.scrollHeight - objDiv.clientHeight)) {
		  		doScroll = true;
		  	};
		  	data = data.replace(/(?:\r\n|\r|\n)/g, '<br>');
		  	parsedData = JSON.parse(data);
		  	if (parsedData['lines']!='') {
		  		$('#chatPanel').append(parsedData['lines']);
		  		if (doScroll) {
						objDiv.scrollTop = objDiv.scrollHeight;
					};
				}
				cIndex = parsedData['cIndex'];
		  }
		});
	};

	upd();
	function timerGo() {
		setTimeout(function() {
			upd();
			//testing the double request bug
			//$("#footer").append("timer.call:" + Date.now() + "<br>");
			timerGo();
  	}, 1000);
	};
	/*setTimeout(function() {
		upd();
		$("#footer").append("timer.call:" + Date.now() + "<br>");
  }, 1000);*/
  timerGo();
})()