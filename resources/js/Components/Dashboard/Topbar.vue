<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
  <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
      <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
        <div class="d-flex align-items-center">
          <!-- <form class="navbar-search form-inline" id="navbar-search-main">
            <div class="input-group input-group-merge search-bar">
                <span class="input-group-text" id="topbar-addon">
                  <i class="fas fa-search px-1"></i>
                </span>

                <input
                  type="text"
                  class="form-control"
                  id="topbarInputIconLeft"
                  placeholder="Search"
                  aria-label="Search"
                  aria-describedby="topbar-addon"
                >
            </div>
          </form> -->
        </div>

        <ul class="navbar-nav align-items-center">
          <li class="nav-item dropdown ms-lg-3">
            <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="media d-flex align-items-center">
                <img class="avatar rounded-circle" :alt="'Foto ' + $page.props.auth.user.name" :src="$page.props.auth.avatar" >

                <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                  <span class="mb-0 font-small fw-bold text-gray-900">{{ $page.props.auth.user.name }}</span>
                </div>
              </div>
            </a>

            <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
              <Link class="dropdown-item d-flex align-items-center" :href="route('profil.index')">
                <i class="fas fa-user-circle px-2"></i>

                Profil
              </Link>

              <div role="separator" class="dropdown-divider my-1"></div>

              <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  class="dropdown-item d-flex align-items-center"
              >
                <i class="fas fa-arrow-right-from-bracket px-2 text-danger"></i>

                Keluar
              </Link>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>