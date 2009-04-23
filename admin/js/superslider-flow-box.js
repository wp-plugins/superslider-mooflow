<script language="javascript" type="text/javascript">
	function insertAtCursor(myField, myValue) {
		//IE support
		if (document.selection) {
			myField.focus();
			sel = document.selection.createRange();
			sel.text = myValue;
		}
		//MOZILLA/NETSCAPE support
		else if (myField.selectionStart || myField.selectionStart == '0') {
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			myField.value = myField.value.substring(0, startPos)
			+ myValue
			+ myField.value.substring(endPos, myField.value.length);
		} else {
			myField.value += myValue;
		}
	}
	function addflow() {
		var flow_code = '[mooflow ';
		
		var f = document.getElementById('id'); 
		if (f.value != "") {
			flow_code = flow_code+'id="'+f.value+'" ';
			}
		var f = document.getElementById('num'); 
		if (f.value != "") {
			flow_code = flow_code+'numPosts="'+f.value+'" ';
			}
		/*var f = document.getElementById('cat'); 
		if (f.value != "") {
			flow_code = flow_code+'catId="'+f.value+'" ';
			}*/
			
		var f = document.getElementById('reflection'); 
		if (f.value != "") {
			flow_code = flow_code+'reflection="'+f.value+'" ';
			}
		var f = document.getElementById('heightRatio'); 
		if (f.value != "") {
			flow_code = flow_code+'heightRatio="'+f.value+'" ';
			}
		var f = document.getElementById('offsetY'); 
		if (f.value != "") {
			flow_code = flow_code+'offsetY="'+f.value+'" ';
			}
		var f = document.getElementById('startIndex'); 
		if (f.value != "") {
			flow_code = flow_code+'startIndex="'+f.value+'" ';
			}
		var f = document.getElementById('interval'); 
		if (f.value != "") {
			flow_code = flow_code+'interval="'+f.value+'" ';
			}
		var f = document.getElementById('factor'); 
		if (f.value != "") {
			flow_code = flow_code+'factor="'+f.value+'" ';
			}
		var f = document.getElementById('bgColor'); 
		if (f.value != "") {
			flow_code = flow_code+'bgColor="'+f.value+'" ';
			}
		
		var f = document.getElementById('useAutoPlay'); 
		if (f.checked) {
			flow_code = flow_code+'useAutoPlay="true" ';
			}
		var f = document.getElementById('useViewer'); 
		if (f.checked) {
			flow_code = flow_code+'useViewer="true" ';
			}
		var f = document.getElementById('useCaption'); 
		if (f.checked) {
			flow_code = flow_code+'useCaption="true" ';
			}
		var f = document.getElementById('useResize'); 
		if (f.checked) {
			flow_code = flow_code+'useResize="true" ';
			}
		var f = document.getElementById('useSlider'); 
		if (f.checked) {
			flow_code = flow_code+'useSlider="true" ';
			}
		var f = document.getElementById('useWindowResize'); 
		if (f.checked) {
			flow_code = flow_code+'useWindowResize="true" ';
			}
		var f = document.getElementById('useMouseWheel'); 
		if (f.checked) {
			flow_code = flow_code+'useMouseWheel="true" ';
			}
		var f = document.getElementById('useKeyInput'); 
		if (f.checked) {
			flow_code = flow_code+'useKeyInput="true" ';
			}
		var f = document.getElementById('addSlim'); 
		if (f.checked) {
			flow_code = flow_code+'addSlim="true" ';
			}
		var f = document.getElementById('linked'); 
		if (f.value != "") {
			flow_code = flow_code+'linked="'+f.value+'" ';
			}
	/*	var f = document.getElementById('addJson'); 
		if (f.checked) {
			flow_code = flow_code+'addJson="true" ';
			}
		var f = document.getElementById('addAjax'); 
		if (f.checked) {
			flow_code = flow_code+'addAjax="true" ';
			}*/
		
				flow_code = flow_code+']';
				var destination1 = document.getElementById('content');
				
				if (destination1) {
				// calling the function
				    insertAtCursor(destination1, flow_code);
				}
				/*var destination2 = content_ifr.tinymce;
				var destination2 = window.frames[0].document.getelementbyid('tinymce')
				if (destination2) {
					destination2.value += flow_code;
					 alert(document.frames("content_ifr").document.getelementbyid('tinymce').value);
					}*/
			
}

</script>