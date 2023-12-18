<script lang='ts'>
  import { logOut } from "@lib/auth/logOut"

  let logged = true

  if(!localStorage.getItem('user_id')) {
    logged = false
  }
</script>

{#if logged}
  <button
    class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2"
    on:click={logOut}
  >
    Log Out
  </button>
{:else}
  <a
    class='px-2 py-1 font-bold text-white bg-green-500 rounded-sm'
    href='http://localhost:3000/auth'
  >
    Log In
  </a>
{/if}