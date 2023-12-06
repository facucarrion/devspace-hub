<script lang="ts">
  import { collab } from '@lib/projectUsers/collab'
  import { isCollaborator } from '@lib/projectUsers/isCollaborator'

  export let id_user: string
  export let id_project: string

  let collaborating: 'collaborating' | 'notCollaborating' = 'notCollaborating'

  const states = {
    collaborating: {
      text: 'Remove',
      function: async () => {
        await collab(
          id_user,
          id_project
        )
        collaborating = 'notCollaborating'
        window.location.reload()
      }
    },
    notCollaborating: {
      text: 'Add',
      function: async () => {
        await collab(
          id_user,
          id_project
        )
        collaborating = 'collaborating'
        window.location.reload()
      }
    }
  }

  $: {
    isCollaborator(id_user, id_project).then(
      res => {
        collaborating = res.isCollaborator
          ? 'collaborating'
          : 'notCollaborating'
      }
    )
  }
</script>

<button 
  on:click={states[collaborating].function}
>
  {states[collaborating].text}
</button>
