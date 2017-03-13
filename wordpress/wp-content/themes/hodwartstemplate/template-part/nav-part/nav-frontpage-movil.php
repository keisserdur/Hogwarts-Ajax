<div class="nav-principal-movil">
    <p>MENU</p>
</div>
<div class="menu-section">
    
    <div class="menu-toggle">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
    </div>
    <nav>
        <ul role="navigation" class="hidden">
            <li class="logo">MENU</li>
            <li><a href="<?php echo get_settings('home'); ?>">Home</a></li>
            <li><a href="<?php echo get_page_link(get_page_by_title('Blog')->ID);?>">Blog</a></li>
            <li><a href="<?php echo get_page_link(get_page_by_title('Activities')->ID);?>">Activities</a></li>
        </ul>
    </nav>
</div>
