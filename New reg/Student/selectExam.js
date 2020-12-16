function showExam() {
	let str = document.getElementById("examid").value;
	if (str == "") {
		document.getElementById("examtext").innerHTML = "";
		return;
	} else {
		var myRequest = new XMLHttpRequest();
		myRequest.open("GET", "selectExam.php?q=" + str, true);
		myRequest.send();
		myRequest.onload = function () {
			document.getElementById("examtext").innerHTML = this.responseText;
		}
	}

}