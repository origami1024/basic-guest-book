(function(){
	function printMsgs(x) {
		let tmp = document.createElement("p");
		let node = document.createTextNode(x['msg']);
		tmp.appendChild(node);
		chatPanel.appendChild(tmp);
	}
	//msgs.forEach(printMsgs);
	let cIndex = 0;
	function send(e){
			let tmp = msgInp.value;
			$.ajax({
			type: 'GET',
		  url: 'msgAdd.php',
		  contentType: 'application/json',
		  data : { 'name' : 'noname', 'text' : tmp , 'mail': 'NOMAIL' },
		  //data : 'alfred',
		  success: function(data) {
		    $('.result').html(data);
		  }
		});
		msgInp.value = '';
	}
	subm.addEventListener("click", send);
	msgInp.addEventListener("keydown", function(e){
	   	if(e.keyCode == 13) send()
	});

	$.ajax({
		type: 'GET',
	  url: 'msgFresh.php',
	  contentType: 'application/json',
	  data : { 'cIndex' : cIndex},
	  //data : 'alfred',
	  success: function(data) {
	  	//console.log('atsucc raw: ' + data);
	  	parsedData = JSON.parse(data);
	  	$('#chatPanel').append(parsedData['lines']);
	  	cIndex = parsedData['cIndex'];
	  	//console.log('at success:' + cIndex + ':' + parsedData['cIndex']);
	    //$('.result').html(data);
	  }
	});

	setInterval(function() {
		$.ajax({
			type: 'GET',
		  url: 'msgFresh.php',
		  contentType: 'application/json',
		  data : { 'cIndex' : cIndex},
		  //data : 'alfred',
		  success: function(data) {
		  	//console.log('atsucc raw: ' + data);
		  	parsedData = JSON.parse(data);
		  	if (parsedData['lines']!='') {
		  		$('#chatPanel').append(parsedData['lines']);
		  		let objDiv = document.getElementById("chatPanel");
					objDiv.scrollTop = objDiv.scrollHeight;
				}
				cIndex = parsedData['cIndex'];
		  	//console.log('at success:' + cIndex + ':' + parsedData['cIndex']);
		    //$('.result').html(data);
		  }
		});
  }, 1000); 
})()