<div id="chat__main"></div>
<form method="POST" id="form">
	<input type="text" name="text" id="text" placeholder="Введите сообщение" required>
	<input type="submit" name="submit" value="Отправить сообщение">
</form>
<script type="text/javascript">
async function refreshChat(chatName) {
	let response = await fetch('/chat/refresh/'+chatName);

	if (response.ok) {
		let json = await response.json();

		let chat = document.getElementById('chat__main');

		let text = '';
		
		for (let i = 0; i < json.length; i++) {
			text += `<p id="message"><a href=\"/users/${json[i]['user_id']}\">${json[i]['login']}</a>: ${json[i]['message']}</p>`;
		}

		chat.innerHTML = text;
	}
}

let chat = '<?php echo $chat_name; ?>';

form.onsubmit = async (e) => {
    e.preventDefault();

    let response = await fetch('/chat/sendmessage/'+chat, {
      method: 'POST',
      body: new FormData(form)
    });

	document.getElementById('text').value='';
};

setInterval("refreshChat(chat)", 500);
</script>