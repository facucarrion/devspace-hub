<script lang="ts">
  import { isEditor } from "@lib/projectUsers/isEditor";
  export let id_project: string

  let is_editor = false
  
  $: {
    isEditor(localStorage.getItem('user_id') as string, id_project).then(
      res => {
        is_editor = res.isEditor
        console.log(res)
      }
    )
  }
</script>

{#if is_editor}
  <a
    href={`http://localhost:3000/projects/${id_project}/add-tags`}
    class='flex items-center gap-2 px-4 text-xl text-white bg-blue-500 hover:bg-blue-600 ml-3'
  >Add Tags</a>
{/if}