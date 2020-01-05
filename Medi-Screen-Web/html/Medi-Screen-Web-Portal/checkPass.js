				function passCheck() {
					var pass = document.getElementById("password").value;
					var confirmPass = document.getElementById("confirm_password").value;
					var ok = true;
					if (pass != confirmPass) {
						document.getElementById("password").style.border = "1px solid #E34234";
						document.getElementById("confirm_password").style.border = "1px solid #E34234";
						ok = false;
					}
					else {
						document.getElementById("password").style.border = "none";
						document.getElementById("confirm_password").style.border = "none";
					}
					return ok;
				}