<div id="chat__main"></div>
<form method="POST">
	<input type="text" name="text" placeholder="Введите сообщение">
	<input type="submit" name="submit" value="Отправить сообщение">
</form>
<script type="text/javascript">
	async function refreshChat(chatName) {
		let response = await fetch('/chat/refresh/'+chatName);

		if (response.ok) {
			let text = await response.text();

			let chat = document.getElementById('chat__main');

			chat.innerHTML = text;
    }
}
let chat = '<?php echo $chat_name; ?>';

setInterval("refreshChat(chat)", 500);
</script>