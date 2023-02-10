// Get new messages
function getMessages(){
	
}

// Message Submit
function sendMessage(){	
	// data
	const contentField = document.getElementById('content');
	const content = encodeURI(contentField.value);	
	const userid = encodeURI(document.getElementById('userid').value);
	const serverid = encodeURI(document.getElementById('serverid').value);
	// request
	const request = new XMLHttpRequest();
	request.onreadystatechange = () => {
		console.log(request.responseText)
	};
	request.open("POST", "stuff/createMessage.php", true);
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send("userid="+userid+'&serverid='+serverid+'&content='+content);
	
	// clear field
	contentField.value = '';
	return false;
}

// User Dropdown
function switchUser(){
	const option = document.getElementById('user').value;
	if(option=='create'){ // show create new user form
		document.getElementById('newUserForm').classList.remove('hidden');
	}
	else if(option=='logout'){ // redirect to home
		window.location.href = "index.php";
	}
	else{ // switch to selected user
		document.getElementById('userid').value = option;
		document.getElementById('newUserForm').classList.add('hidden');
	}
}

