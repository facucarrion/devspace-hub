<script lang="ts">
  import { getUser } from '@lib/users/getUser'

  const userPromise = getUser(localStorage.getItem('user_id') ?? '').then(res => {
    console.log(res)
    return res
  })
</script>

{#await userPromise then user}
<picture
  id="avatarButton"
  data-dropdown-toggle="userDropdown"
  data-dropdown-placement="bottom-start"
  class="w-10 h-10 rounded-full cursor-pointer flex items-center justify-center overflow-hidden"
>
  <img
    class="h-full"
    alt={user.username}
    src={user.avatar}
  />
</picture>

<div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
      <div>{user.display_name}</div>
      <div class="font-medium truncate">{user.email}</div>
    </div>
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
      </li>
    </ul>
    <div class="py-1">
      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
    </div>
</div>
{/await}