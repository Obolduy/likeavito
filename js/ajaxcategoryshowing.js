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