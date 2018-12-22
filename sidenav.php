<style media="screen">
    .sidebar-header {
        position: relative;
    }
    .sidebar-header > img {
        width: 100%;
        height: 100px;
        object-fit: cover
    }
    .sidebar-userinfo {
        position: absolute;
        bottom: 5px;
        width: 100%;
        height: 100%;

        background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.8) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.8) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    }
    .sidebar-userinfo img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        margin-left: 10px;
        margin-bottom: 10px

    }
    .sidebar-userinfo h5 {
        color: white;
        font-weight: bolder;
        margin-left: 70px;
        margin-bottom: 26px;
    }
    .sidebar-userinfo * {
        position: absolute;
        bottom: 0;
        vertical-align: bottom;
    }
</style>
<ul id="slide-out" class="sidenav sidenav-fixed">
    <div class="sidebar-header">
        <img src="assets/images/side-background.jpeg" alt="side-background.jpeg">
        <div class="sidebar-userinfo">
            <img src="<?php echo isset($user['profile_picture']) ? $user['profile_picture'] : 'assets/images/blank-profile-picture.png' ?>" alt="">
            <h5> <?php echo $user['first_name'] ?> </h5>
        </div>
    </div>
    <li class="<?php echo is_home() ? 'active' : '' ?>"><a href="<?php echo ROOT ?>">Overview</a></li>
    <li class="<?php echo basename($_SERVER['REQUEST_URI']) == 'Customers' ? 'active' : '' ?>"><a href="Customers">Customers</a></li>
    <li class="<?php echo basename($_SERVER['REQUEST_URI']) == 'Rooms' ? 'active' : '' ?>"><a href="Rooms">Rooms</a></li>
    <li class="<?php echo basename($_SERVER['REQUEST_URI']) == 'Reservations' ? 'active' : '' ?>"><a href="Reservations">Reservations</a></li>
    <li class="<?php echo basename($_SERVER['REQUEST_URI']) == 'Pricing' ? 'active' : '' ?>"><a href="Pricing">Pricing</a></li>
</ul>
<div class="dashboard-navigator z-depth-1">
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
</div>

<main>
