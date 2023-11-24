<script lang="ts">
  export let id_creator: string
  export let id_project: string

  const isAdmin = id_creator == localStorage.getItem('user_id')
</script>

{#if isAdmin}
  <a
    href={`http://localhost:3000/new-project/add-collaborators/${id_project}`}
    class='flex items-center gap-2 px-4 text-white bg-blue-500 hover:bg-blue-600 ml-3'
  >Add collaborators</a>
{/if}