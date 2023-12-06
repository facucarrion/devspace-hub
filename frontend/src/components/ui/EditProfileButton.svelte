<script lang="ts">
  export let userInPageId: string = "0"
  const ownUserId = window.localStorage.getItem('user_id') ?? 0
  let isOwn = userInPageId === ownUserId
</script>
  
{#if isOwn}
  <a 
    class="p-2 rounded-full bg-white text-black font-bold text-sm"
    href="/profile"
  >
    ✏️
  </a>
{/if}