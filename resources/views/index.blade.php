<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vascomm</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white text-dark" style="height: 70px;">
        <table class="nav-table" width="100%">
            <tr>
                <td>
                    <a class="navbar-brand" href="/">
                        <img src="logo.png" alt="logo vascomm" height="27px" width="168px">
                    </a>
                </td>
                <td align="center">
                    <form class="nav-search input-group" role="search">
                        <input class="nav-input-search" type="search" placeholder="Cari parfum kesukaanmu" aria-label="Search">
                        <span class="input-group-text">
                            <img src="image/search-icon.png" alt="search icon">
                        </span>
                    </form>
                </td>
                <td>
                    <div class="nav-button">
                        <a href="/admin/login">
                            <button class="nav-login">MASUK</button>
                        </a>
                        <a href="/admin/register">
                            <button class="nav-register">DAFTAR</button>
                        </a>
                    </div>
                </td>
            </tr>
        </table>
    </nav>

    <div class="content">

        <!-- CAROUSEL -->
        <div class="carousel">
            <center>
                <img src="image/carousel.png" alt="banner" width="100%" height="auto">
            </center>
        </div>

        <!-- PRODUCT -->
        <div class="products">
            <div class="available">
                <h3>Produk Tersedia</h3>
                <div class="list">
                    <div class="row" id="productList">
                        <!-- Product List -->
                        <!-- Product List -->
                        <!-- Product List -->
                        <!-- Product List -->
                        <!-- Product List -->
                    </div>
                </div>

                <center>
                    <button id="loadMore">Lihat lebih banyak</button>
                </center>

            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="footer mt-5" id="footer">
        <div class="row">

            <div class="col-lg-4 col-md-6 main-colomn">
                <img class="logo" src="logo.png" alt="logo vascomm">
                <p class="description mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo in vestibulum, sed dapibus tristique nullam.</p>
                <a href="#" target="__blank"><img class="socmed" src="image/facebook.png" alt="facebook"></a>
                <a href="#" target="__blank"><img class="socmed" src="image/twitter.png" alt="twitter"></a>
                <a href="#" target="__blank"><img class="socmed" src="image/instagram.png" alt="medium"></a>
            </div>

            <div class="col-lg-2 col-md-6">
                <h4 class="widget-title white">Layanan</h4>
                <ul>
                    <li><a href="#">BANTUAN</a></li>
                    <li><a href="#">TANYA JAWAB</a></li>
                    <li><a href="#">HUBUNGI KAMI</a></li>
                    <li><a href="#">CARA BERJUALAN</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h4 class="widget-title white">Tentang Kami</h4>
                <ul>
                    <li><a href="#">ABOUT US</a></li>
                    <li><a href="#">KARIR</a></li>
                    <li><a href="#">BLOG</a></li>
                    <li><a href="#">KEBIJAKAN PRIVASI</a></li>
                    <li><a href="#">SYARAT DAN KETENTUAN</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h4 class="widget-title white">Mitra</h4>
                <ul>
                    <li><a href="#">SUPPLIER</a></li>
                </ul>
            </div>

        </div>
    </footer>

    <!-- jquery -->
    <script>
        function loadProducts(skip, take, search) {
            $.ajax({
                url: '/api/products',
                type: 'GET',
                data: {
                    skip: skip,
                    take: take,
                    search: search
                },
                dataType: 'json',
                success: function(response) {
                    if (response.code === 200) {
                        displayProducts(response.data.products);
                    } else {
                        console.error('Gagal memuat produk:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                }
            });
        }

        function displayProducts(products) {
            var productList = $('#productList');

            $.each(products, function(index, product) {
                var productCard = $('<div class="col-md-2 productcard">');
                var card = $('<div class="card">');

                card.append('<center><img src="' + product.image + '" class="card-img-top" alt="product"></center>');
                card.append('<div class="card-body"><h5 class="card-title">' + product.name + '</h5><p class="card-text">IDR ' + product.price + '</p></div>');

                productCard.append(card);
                productList.append(productCard);
            });
        }

        var skip = 0;
        var take = 10;

        $('#loadMore').on('click', function() {
            skip += take;
            loadProducts(skip, take, '');
        });

        loadProducts(skip, take, '');
    </script>

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>