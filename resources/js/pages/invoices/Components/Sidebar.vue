<template>
    <aside
      class="fixed top-0 left-0 h-full w-[2cm] bg-white dark:bg-gray-900 flex flex-col justify-between items-center py-6 shadow-lg"
      :style="{ borderTopRightRadius: '25px', borderBottomRightRadius: '25px' }"
    >
      <!-- Top: Logo -->
      <div class="bg-gray-800 p-2 rounded-xl">
        <img
          src="/assets/logo.svg"
          alt="Logo"
          class="w-10 h-10 mx-auto rounded-lg object-cover"
        />
      </div>
  
      <!-- Bottom: Divider, Icon, User -->
      <div class="flex flex-col items-center w-full">
        <div class="mb-4 w-full flex flex-col items-center">
          <div class="h-1em"></div>
          <img
            src="/assets/icon-sun.svg"
            alt="Sidebar Icon"
            class="w-6 h-6"
          />
        </div>
        <hr class="w-2/3 border-gray-300 dark:border-gray-700 my-4" />
        <img
          src="/assets/image-avatar.jpg"
          alt="User"
          class="w-12 h-12 rounded-full object-cover border-2 border-gray-300 dark:border-gray-700"
        />
      </div>
    </aside>
  </template>