<script lang="ts">
  import {deleteProject} from '@lib/projects/deleteProject'

  export let id_creator: string
  export let id_project: string

  const handleButton = async (event: MouseEvent) => {
    event.preventDefault()

    const response = await deleteProject(id_project)

    if (response?.ok) {
      location.href = 'http://localhost:3000/'
    }
  }

  const isDeletable = id_creator == localStorage.getItem('user_id') as string
</script>

{#if isDeletable}
  <button on:click={handleButton} class="px-2 py-2 text-xl bg-red-600">
    Delete
  </button>
{/if}