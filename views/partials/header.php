
<!--==========================
Header Section
============================-->
<header id="header">
    <div class="container">
        <div id="logo">
            <a href="#hero"><img src="<?php $this->url('header-logo.png','img',true) ?>" alt="" title="" /></img></a>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="<?php $this->is_menu_active('home','menu-active') ?>"><a href="/">Home</a></li>
                <li class="<?php $this->is_menu_active('services','menu-active') ?>"><a href="/services">Service & Pricing</a></li>
                <li class="<?php $this->is_menu_active('contact','menu-active') ?>"><a href="/contact">Contact Us</a></li>
                <li class="<?php $this->is_menu_active('apartment','menu-active') ?>"><a href="/apartment">Apartment Communities</a></li>
                <li><a href="http://www.closettocleaners.com/sign-up">Sign Up</a></li>
            </ul>
        </nav>
        <!-- #nav-menu-container -->
    </div>
</header>
<!-- #header -->
