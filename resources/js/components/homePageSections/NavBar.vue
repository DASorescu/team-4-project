<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-main ">
            <div class="px-5 d-flex justify-content-between w-100">
                <!-- left side of navbar -->
                <div>
                    <a href="/"
                        class="d-flex align-items-center justify-content-between no-underline">
                        <img src="../../../../public/img/site-logo.png" alt="logo" class="img-fluid nav-image logo">
                        <h3 class="text-white px-2">BDoctors</h3>
                    </a>

                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto align-items-center">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/login">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>
<script>
export default {
    name: 'NavBar',
}
</script>
