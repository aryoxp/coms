<header>
    <nav id="top-header-navigation">
        <ul>
            <li id="home-button">
                <a href="<?php echo $this->location(); ?>">
                <img src="<?php echo $this->asset("images/ic-home.png"); ?>" alt="Home" />
                </a>
            </li>
            <li id="welcome-tag"><p>Halo, <?php echo (@$user ? $user : "Guest"); ?>!</p></li>
            <li id="logout-button">
                <a href="<?php echo $this->location('auth/logoff'); ?>" rel="external">
                <img src="<?php echo $this->asset("images/ic-off.png"); ?>" alt="Logoff" />
                </a>            	
            </li>
        </ul>
    </nav>
</header>