<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="../dealer/index.php">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <hr>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-backpack4-fill"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="../dealer/product_list.php">
                        <i class="bi bi-card-list"></i><span>Product List</span>
                    </a>
                </li>
                <li>
                    <a href="../dealer/add_product.php">
                        <i class="bi bi-plus"></i><span>Add Product</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link collapsed" href="../dealer/approved_retailer.php">
                <i class="bi bi-person-check-fill"></i><span>Approved Retailer</span>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link collapsed" href="../dealer/decline_retailer.php">
                <i class="bi bi-person-dash-fill"></i><span>Declined Retailer</span>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link collapsed" href="../dealer/requested_price.php">
                <i class="bi bi-person-plus-fill   "></i><span>Requested Price</span>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link " href="../dealer/order_pending.php">
                <i class="bi bi-patch-exclamation-fill"></i><span>Order Pending</span>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link " href="../dealer/order_completed.php">
                <i class="bi bi-bag-check-fill"></i><span>Order Completed</span>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link " href="../dealer/order_cancelled.php">
                <i class="bi bi-bag-check-fill"></i><span>Cancel Order</span>
            </a>
        </li>
    </ul>
</aside>
<script>
    $(document).ready(function() {
        $("ul.navbar-nav > li").click(function(e) {
            $("ul.navbar-nav > li").removeClass("active");
            $(this).addClass("active");
        });
    });
</script>