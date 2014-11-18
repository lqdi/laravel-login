{{-- Created by anderson.mota on 13/11/2014. --}}
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>
		<div>
			To reset your password, complete this form: {{ route('authenticate.recover', array($token)) }}.<br/>
			This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.
		</div>
	</body>
</html>