<ul>
    <li>PHP: PHP 7.3</li>
    <li>DB: MySQL 8</li>
    <li>Server: Apache 2.4</li>
    <li>Cache: Redis 5.0</li>
    <li>Queues: RabbitMQ 3.9</li>
    <li>Using: php-amqplib, predis, phpunit, phpdotenv</li>
</ul>

<p>It was my first pet-project on PHP, and it was maded without OOP. While i was studying it, i was perfecting this project.</p>
<p>So i tried to apply all technologies i learned at this time like Redis, Rabbit and AJAX (+ bootstrap). And after a long time, i think, this project are done.</p>
<p>When i'm typing "done", i mean "it works well but also it needs be improved, but now i'm feeling that will be an extra perfectionism".</p>

<h2>Some tech features:</h2>
<p>Queues deamons are in /queues. Now you can't receive any emails because there isn't any mail services (but you still need to use SendRegistrationMail deamon). So that if you want to activate youre email after registration, you should use token from DB.</p>
<p>"Status" field in DB using "1" for simple user and "2" for administrator</p>
<p>Chat doesn't use WebSockets, it uses AJAX.</p>
<p>It's pure JS with no libraries. I wrote a linkchecker that checks any links and for example if one user send a link like "urljustlikemyhost.com/givemeyouremoneyorsmth" to another user, it wil redirect recipient to a special page with attention about link. It works with any link whose hosting doesn't equals to "window.location.host".</p>
<p>Of course no decoration, but I will fix it in a future (now i want to improve my backend skills).</p>
<p>As you can see, I used MySQL 8, but in docker-compose.yml I'm using 5.7. So because of this DB dump using only CREATE TABLE and INSERT commands.</p>

<h2>Run</h2>
<p>You can run this app via docker-compose up and try it on <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a>.</p>

Технический todo в порядке убывания важности:
Дописать тесты.
Оформить.
Прикрутить отправителя почты, чтобы письмо можно было посмотреть не в блокноте.
Поиск.