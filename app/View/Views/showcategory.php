Объявления:

<div>
<table id="table">
        <tr>
            <th><a href="/category/<?= $lots[0]['category_id'] ?>&sort=title">Название</a></th>
            <th><a href="/category/<?= $lots[0]['category_id'] ?>&sort=price">Цена</a></th>
            <th><a href="/category/<?= $lots[0]['category_id'] ?>&sort=city">Город</a></th>
            <th><a href="/category/<?= $lots[0]['category_id'] ?>&sort=add_time">Дата добавления</a></th>
        </tr>
        <?php foreach ($lots as $lot): ?>
        <tr id="table__rows">
            <td>
                <?php if ($lots_pictures['lot_id'] == $lot['id']): ?>
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/img/lots/<?= $lot['id'] ?>/<?= $lots_pictures['picture'] ?>" target="_blank"><img height=30% width=20% src="http://<?= $_SERVER['SERVER_NAME'] ?>/img/lots/<?= $lots_pictures['lot_id'] ?>/<?= $lots_pictures['picture'] ?>" alt="Картинки"></a><br>
                <?php endif; ?>
                <a href="/category/<?= $lot['category_id'] ?>/<?= $lot['id'] ?>" target="_blank"><?= $lot['title'] ?></a>
            </td>
            <td><?= $lot['price'] ?>₽</td>
            <td><?= $lot['city'] ?></td>
            <td><?= $lot['add_time'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<div>
    <?php if ($_GET['page'] != 1): ?><a href="/category/<?= $lot['category_id'] ?>?page=<?= ($_GET['page'] - 1)?>&<?php if($_GET['sort']) echo "sort={$_GET['sort']}" ?>">Назад</a><?php endif; ?>
    <?php if ($_GET['page'] < $page_lot_count): ?><a id="pagination__next" href="/category/<?= $lot['category_id'] ?>?page=<?= ($_GET['page'] + 1)?>&<?php if($_GET['sort']) echo "sort={$_GET['sort']}" ?>">Вперед</a>
    <a id="pagination__more" href="/category/<?= $lot['category_id'] ?>?page=<?= ($_GET['page'] + 1)?>&<?php if($_GET['sort']) echo "sort={$_GET['sort']}" ?>">Прогрузить еще</a>    
    <?php endif; ?>
</div>
<script>
    pagination__more.addEventListener('click', async (event) => {
        event.preventDefault();

        let response = await fetch(pagination__more.href, {
            method: 'GET',
            headers: {
                'Pagination-JSON': 1
            }
        });

        if (response.ok) {
            let json = await response.json();

            let title, price, city, add_time;

            for (row of json['lots']) {
                table_row = document.createElement('tr');
                table.append(table_row);

                title = document.createElement('td');
                title.innerHTML = `<a href="http://${window.location.host}/category/${row.category_id}/${row.id}" target="_blank">${row.title}</a>`;
                table_row.append(title);

                price = document.createElement('td');
                price.innerHTML = row.price;
                table_row.append(price);

                city = document.createElement('td');
                city.innerHTML = row.city;
                table_row.append(city);

                add_time = document.createElement('td');
                add_time.innerHTML = row.add_time;
                table_row.append(add_time);
            }

            let page = ++pagination__more.search.match(/\d/)[0];
            pagination__more.search = pagination__more.search.replace(/\d/, page);

            if (page > json['page_lot_count']) {
                pagination__more.remove();
            }
        }
    });
</script>