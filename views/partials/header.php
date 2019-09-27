
<!--==========================
Header Section
============================-->
<header id="header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div id="logo">
              <a href="<?= $this->url('') ?>"><img src="<?= $this->url('logo.png','img') ?>" alt="" title="OpenDoors Logo" /></a>
          </div>
      
          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="menu-has-children <?= $this->is_menu_active('open-data', true) ?>"><a href="<?= $this->url('open-data') ?>">Open Data</a>
                <ul>
                  <li <?= $this->is_menu_active('open-data/companies') ?>><a href="<?= $this->url('open-data/companies') ?>">Companies</a></li>
                  <li <?= $this->is_menu_active('open-data/reports') ?>><a href="<?= $this->url('open-data/reports') ?>">Annual Reports</a></li>
                </ul>
              </li>
              
              <li class="menu-has-children <?= $this->is_menu_active('paid-data',true) ?>"><a href="<?= $this->url('paid-data') ?>">Paid Data</a>
                <ul>
                  <li <?= $this->is_menu_active('paid-data') ?>><a href="<?= $this->url('paid-data') ?>">Financial Data</a></li>
                  <li <?= $this->is_menu_active('paid-data') ?>><a href="<?= $this->url('paid-data') ?>">Share Prices</a></li>
                  <li <?= $this->is_menu_active('paid-data') ?>><a href="<?= $this->url('paid-data') ?>">Ownership Structure</a></li>
                  <li <?= $this->is_menu_active('paid-data') ?>><a href="<?= $this->url('paid-data') ?>">CEO Compensation</a></li>
                  <li <?= $this->is_menu_active('paid-data') ?>><a href="<?= $this->url('paid-data') ?>">Directors Qualification</a></li>
                  <li <?= $this->is_menu_active('paid-data') ?>><a href="<?= $this->url('paid-data') ?>">Earning Announcements</a></li>
                  <li <?= $this->is_menu_active('paid-data') ?>><a href="<?= $this->url('paid-data') ?>">IPO</a></li>
                </ul>
              </li>

              <li class="menu-has-children <?= $this->is_menu_active('paid-help', true) ?>"><a href="/paid-help">Paid Help</a>
                <ul>
                  <li <?= $this->is_menu_active('paid-help') ?>><a href="#">Empirical Methods</a></li>
                  <li <?= $this->is_menu_active('paid-help') ?>><a href="#">Completed Projects</a></li>
                  <li <?= $this->is_menu_active('paid-help') ?>><a href="#">Empirical Finance Pricing</a></li>
                  <li <?= $this->is_menu_active('paid-help') ?>><a href="#">Paid Data</a></li>
                  <li <?= $this->is_menu_active('paid-help') ?>><a href="#">Stata Program</a></li>
                  <li <?= $this->is_menu_active('paid-help') ?>><a href="#">FAQs</a></li>
                </ul>
              </li>

              <li class="menu-has-children <?= $this->is_menu_active('courses', true) ?>"><a href="/courses">Courses</a>
                <ul>
                  <li <?= $this->is_menu_active('courses') ?>><a href="#">Portfolio Management</a></li>
                  <li <?= $this->is_menu_active('courses') ?>><a href="#">Financial Risk Management</a></li>
                  <li <?= $this->is_menu_active('courses') ?>><a href="#">Financial Management</a></li>
                  <li <?= $this->is_menu_active('courses') ?>><a href="#">Strategic Financial Management</a></li>
                  <li <?= $this->is_menu_active('courses') ?>><a href="#">Financial Markets and Institutions</a></li>
                  <li <?= $this->is_menu_active('courses') ?>><a href="#">Computer Applications for Finance</a></li>
                  <li <?= $this->is_menu_active('courses') ?>><a href="#">Seminar in Finance</a></li>
                </ul>
              </li>

              <li class="menu-has-children <?= $this->is_menu_active('research', true) ?>"><a href="<?= $this->url('research') ?>">Research</a>
                <ul>
                  <li><a href="#">Research Topics</a></li>
                  <li><a href="#">Research Topic Selection</a></li>
                  <li><a href="#">Evaluation of MS Thesis</a></li>
                  <li><a href="#">Journals in Finance</a></li>
                </ul>
              </li>
              
              <li <?= $this->is_menu_active('contact') ?>><a href="<?= $this->url('contact') ?>">Contact</a></li>
            </ul>
          </nav>

        <ul class="nav-menu user-btn">
          <li class="menu-has-children"><a href="#"><i class="fa fa-user-circle-o"></i></a>
            <ul>
              <li><a href="#">Data Entry Portal</a></li>
              <li><a href="#">Website Management</a></li>
            </ul>
          </li>
        </ul>

        <!-- #nav-menu-container -->
        <div class="searchbox">
          <form action="">
            <input type="text" placeholder="Search" name="q" id="">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>


        </div>
    </div>
    </div>
</header>
<!-- #header -->
