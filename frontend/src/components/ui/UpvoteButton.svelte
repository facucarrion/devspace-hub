<script lang="ts">
  import { isUpvoted } from '@lib/upvotes/isUpvoted'
  import { upvote } from '@lib/upvotes/upvote'

  export let id_project: string
  export let upvotes: string

  let upvoted: 'upvoted' | 'noUpvoted' = 'noUpvoted'

  const states = {
    upvoted: {
      button: '👇🏻',
      function: async (event: MouseEvent) => {
        if (!localStorage.getItem('user_id')) {
          event.preventDefault()

          if (confirm('Quieres loggearte para hacer esto?')) {
            location.href = 'http://localhost:3000/auth'
          }

          return
        }
        const newUpvotes = await upvote(
          id_project,
          localStorage.getItem('user_id') as string
        )
        upvoted = 'noUpvoted'
        upvotes = newUpvotes.upvotes
      }
    },
    noUpvoted: {
      button: '👆🏻',
      function: async (event: MouseEvent) => {
        if (!localStorage.getItem('user_id')) {
          event.preventDefault()

          if (confirm('Quieres loggearte para hacer esto?')) {
            location.href = 'http://localhost:3000/auth'
          }

          return
        }
        const newUpvotes = await upvote(
          id_project,
          localStorage.getItem('user_id') as string
        )
        upvoted = 'upvoted'
        upvotes = newUpvotes.upvotes
      }
    }
  }

  $: {
    const upvotedPromise = isUpvoted(
      id_project,
      localStorage.getItem('user_id') as string
    ).then(res => {
      upvoted = res.isUpvoted ? 'upvoted' : 'noUpvoted'
    })
  }
</script>

<span class="flex items-center [&>*]:text-2xl">
  <p>{upvotes}</p>
  <button on:click={states[upvoted]?.function}>
    {states[upvoted]?.button}
  </button>
</span>
