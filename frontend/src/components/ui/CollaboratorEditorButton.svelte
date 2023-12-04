<script lang="ts">
  import { collabEditor } from '@lib/projectUsers/collabEditor';
  import { isEditor } from '@lib/projectUsers/isEditor'

  export let id_user: string
  export let id_project: string

  let checked = false

  $: {
    isEditor(id_user, id_project).then(
      res => {
        checked = res.isEditor
        console.log(res)
      }
    )
  }

  const handleChange = async (event: Event) => {
    event.preventDefault()

    const response = await collabEditor(id_project, id_user)

    location.reload()
  }
</script>

<input 
  type="checkbox"
  checked={checked}
  on:change={handleChange}
/>