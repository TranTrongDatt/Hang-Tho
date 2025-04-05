document.getElementById('search-input').addEventListener('input', function () {
    const query = this.value;

    if (query.length > 0) {
        fetch(`/hangtho/app/search.php?q=${query}`)
            .then(response => response.json())
            .then(data => {
                const resultsContainer = document.getElementById('search-results');
                resultsContainer.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'search-result-item';
                        div.innerHTML = `
                            <strong>${item.product_name}</strong>
                            <br>
                            <small>Danh mục: ${item.category_name || 'Không rõ'}</small>
                        `;
                        div.addEventListener('click', () => {
                            window.location.href = `/hangtho/Product/detail?id=${item.id}`;
                        });
                        resultsContainer.appendChild(div);
                    });
                    resultsContainer.style.display = 'block';
                } else {
                    resultsContainer.style.display = 'none';
                }
            });
    } else {
        document.getElementById('search-results').style.display = 'none';
    }
});