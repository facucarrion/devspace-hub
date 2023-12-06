<script lang="ts">
  export let id_project: string
  import { isEditor } from "@lib/projectUsers/isEditor";

  let is_editor = false
  
  $: {
    isEditor(localStorage.getItem('user_id') as string, id_project).then(
      res => {
        is_editor = res.isEditor
      }
    )
  }
</script>

{#if is_editor}
  <a href="http://localhost:3000/projects/{id_project}/edit" class="flex items-center  ml-2 bg-green-500 text-white text-xl px-2 py-1">Edit</a>
{/if}