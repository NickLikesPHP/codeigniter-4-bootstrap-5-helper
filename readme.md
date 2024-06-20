## `bs_nav_dropdown`
    $dropdown_items = [
    	['type' => 'item', 'text' => '<i class="bi bi-person"></i> My Profile', 'href' => '/profile'],
    	['type' => 'item', 'text' => '<i class="bi bi-window-sidebar"></i> My Dashboard', 'href' => '/dashboard/setting'],
    	['type' => 'divider'],
    	['type' => 'item', 'text' => '<i class="bi bi-box-arrow-left"></i> Log Out', 'href' => '/logout'],
    ];
    echo bs_nav_dropdown('', 'Hello, {ASDF123}!', $dropdown_items);
## bs_nav_item
    echo bs_nav_item('dashboard', '<i class="bi bi-house"></i> Home');

