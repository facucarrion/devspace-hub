<script lang="ts">
  export let id_user_page: string
  export let username: string

  const id_user = localStorage.getItem("user_id") as string

  const isSameUser = id_user == id_user_page
</script>

{#if isSameUser}
  <a href="http://localhost:3000/users/{username}/links" class="bg-green-500 text-white text-xl px-2 py-1">Edit</a>
{/if}