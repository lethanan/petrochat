// Get new messages
function getMessages(){
	
}

// Message Submit
function sendMessage(){
	
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

