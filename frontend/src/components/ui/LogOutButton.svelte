<script lang='ts'>
  import { logOut } from "@lib/auth/logOut"
</script>

<button on:click={logOut} class="px-2 py-1 flex bg-red-500 font-bold rounded-sm">
  Log Out
</button>