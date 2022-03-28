<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
  <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
      <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
        <div class="d-flex align-items-center">
          <div class="avatar-lg me-4">
            <img :src="'https://ui-avatars.com/api/?name=' + $page.props.auth.user.name" class="card-img-top rounded-circle border-white"
              alt="Bonnie Green">
          </div>

          <div class="d-block">
            <h2 class="h5 mb-3">Hi, {{ $page.props.auth.user.name }}</h2>
            <Link
                :href="route('logout')"
                method="post"
                as="button"
                class="btn btn-secondary btn-sm d-inline-flex align-items-center"
            >
              <i class="fas fa-arrow-right-from-bracket px-2"></i>

              Keluar
            </Link>
          </div>
        </div>

        <div class="collapse-close d-md-none">
          <a href="#sidebarMenu" data-bs-toggle="collapse"
              data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"
              aria-label="Toggle navigation">
              <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        </div>
      </div>

      <ul class="nav flex-column pt-3 pt-md-0">
        <li class="nav-item">
          <Link href="/" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
              <i class="fas fa-map-location-dot text-secondary" style="font-size:2rem"></i>
            </span>
            <span class="mt-1 ms-1 sidebar-text">{{ $page.props.app.name }}</span>
          </Link>
        </li>

        <li class="nav-item" :class="route().current('dashboard.index') ? 'active' : ''" >
          <Link :href="route('dashboard.index')" class="nav-link">
            <i class="fas fa-chart-pie pe-3"></i>

            <span class="sidebar-text">Dashboard</span>
          </Link>
        </li>
      </ul>
    </div>
  </nav>
</template>