$(document).ready(function() {
		$("#registerModel").click(function() {
			$("#RegisterModal").modal('show');
			$("#exampleModal").modal('hide');
		});
		
		$("#loginModel").click(function() {
			$("#RegisterModal").modal('hide');
			$("#exampleModal").modal('show');
		});

		$("#forgotModel").click(function() {
			$("#exampleModal").modal('hide');
			$("#forgotPasswordModal").modal('show');
		});
		
		$("#changeModel").click(function() {
			$("#exampleModal").modal('hide');
			$("#changePasswordModal").modal('show');
		});
		$(window).on('load',function() {
			var forgot = getUrlVars()["forgot"];
			var active = getUrlVars()["isActive"];
			var loginError = getUrlVars()["error"];
			var success = getUrlVars()["success"];
			if(forgot) {
				$('#changePasswordModal').modal('show');
			}
			else if(active) {
				$('#exampleModal').modal('show');
			}
			else if(loginError == 'login#') {
				$('#exampleModal').modal('show');
			}
			else if(loginError == 'registeral') {
				$('#exampleModal').modal('show');
			}
			else if(loginError == 'forgot#') {
				$('#forgotPasswordModal').modal('show');
			}
			else if(success == 'password#') {
				$('#changePasswordModal').modal('show');
			}
			else if(loginError == 'passwordnot') {
				$('#changePasswordModal').modal('show');
			}
			else if(success == 'fmailsent#') {
				$('#forgotPasswordModal').modal('show');
			}
			else if(success == 'activation') {
				$('#exampleModal').modal('show');
			}
		});

	});
	
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
