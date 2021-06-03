<div class="chat__main">
	<?php foreach ($messages as $message): ?>
	<div class="messages">
		<p class="message">
			<?= $message['date'] ?>
			<?php 
				if($message['login'] != $_SESSION['user']['login']):
					echo $message['login'];
				else: echo 'Я';
				endif;
			?>:
			<?= $message['message'] ?>
		</p>
	</div>
	<?php endforeach; ?>
</div>
<form method="POST">
	<input type="text" name="text">
	<input type="submit" name="submit">
</form>