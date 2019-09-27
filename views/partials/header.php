
<!--==========================
Header Section
============================-->
<header id="header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div id="logo">
              <a href="/"><img src="<?php $this->url('logo.png','img',true) ?>" alt="" title="OpenDoors Logo" /></a>
          </div>
      
          <nav id="nav-menu-container">
            <ul class="nav-menu">

              <li class="menu-has-children <?php $this->is_menu_active('open_data','',false) ?>"><a href="/open-data">Open Data</a>
                <ul>
                  <li <?php $this->is_menu_active('open_data','companies') ?>><a href="/open-data/companies">Companies</a></li>
                  <li <?php $this->is_menu_active('open_data','reports') ?>><a href="/open-data/reports">Annual Reports</a></li>
                </ul>
              </li>
              
              <li class="menu-has-children <?php $this->is_menu_active('paid_data','',false) ?>"><a href="/paid-data">Paid Data</a>
                <ul>
                  <li <?php $this->is_menu_active('paid_data','') ?>><a href="/paid-data">Financial Data</a></li>
                  <li <?php $this->is_menu_active('paid_data','') ?>><a href="/paid-data">Share Prices</a></li>
                  <li <?php $this->is_menu_active('paid_data','') ?>><a href="/paid-data">Ownership Structure</a></li>
                  <li <?php $this->is_menu_active('paid_data','') ?>><a href="/paid-data">CEO Compensation</a></li>
                  <li <?php $this->is_menu_active('paid_data','') ?>><a href="/paid-data">Directors Qualification</a></li>
                  <li <?php $this->is_menu_active('paid_data','') ?>><a href="/paid-data">Earning Announcements</a></li>
                  <li <?php $this->is_menu_active('paid_data','') ?>><a href="/paid-data">IPO</a></li>
                </ul>
              </li>

              <li class="menu-has-children <?php $this->is_menu_active('paid_help','', false) ?>"><a href="/paid-help">Paid Help</a>
                <ul>
                  <li <?php $this->is_menu_active('paid_help','') ?>><a href="#">Empirical Methods</a></li>
                  <li <?php $this->is_menu_active('paid_help','') ?>><a href="#">Completed Projects</a></li>
                  <li <?php $this->is_menu_active('paid_help','') ?>><a href="#">Empirical Finance Pricing</a></li>
                  <li <?php $this->is_menu_active('paid_help','') ?>><a href="#">Paid Data</a></li>
                  <li <?php $this->is_menu_active('paid_help','') ?>><a href="#">Stata Program</a></li>
                  <li <?php $this->is_menu_active('paid_help','') ?>><a href="#">FAQs</a></li>
                </ul>
              </li>

              <li class="menu-has-children <?php $this->is_menu_active('courses','', false) ?>"><a href="/courses">Courses</a>
                <ul>
                  <li <?php $this->is_menu_active('courses','') ?>><a href="#">Portfolio Management</a></li>
                  <li <?php $this->is_menu_active('courses','') ?>><a href="#">Financial Risk Management</a></li>
                  <li <?php $this->is_menu_active('courses','') ?>><a href="#">Financial Management</a></li>
                  <li <?php $this->is_menu_active('courses','') ?>><a href="#">Strategic Financial Management</a></li>
                  <li <?php $this->is_menu_active('courses','') ?>><a href="#">Financial Markets and Institutions</a></li>
                  <li <?php $this->is_menu_active('courses','') ?>><a href="#">Computer Applications for Finance</a></li>
                  <li <?php $this->is_menu_active('courses','') ?>><a href="#">Seminar in Finance</a></li>
                </ul>
              </li>

              <li class="menu-has-children <?php $this->is_menu_active('research','', false) ?>"><a href="/research">Research</a>
                <ul>
                  <li><a href="#">Research Topics</a></li>
                  <li><a href="#">Research Topic Selection</a></li>
                  <li><a href="#">Evaluation of MS Thesis</a></li>
                  <li><a href="#">Journals in Finance</a></li>
                </ul>
              </li>
              
              <li <?php $this->is_menu_active('contact','index') ?>><a href="/contact">Contact</a></li>
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
