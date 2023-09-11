<script lang='ts'>
  import { logOut } from "@lib/auth/logOut"
</script>

<button on:click={logOut} class="px-2 py-1 flex border-2 border-black">
  Log Out
</button>