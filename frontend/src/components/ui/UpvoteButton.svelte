<script lang="ts">

import { isUpvoted } from "@lib/upvotes/isUpvoted"
import { upvote } from "@lib/upvotes/upvote"

export let id_project: string
export let upvotes: string

let upvoted: 'upvoted' | 'noUpvoted' = 'upvoted'


const states = {
  upvoted: {
    button: "👇🏻",
    function: async () => {
      const newUpvotes = await upvote(id_project, localStorage.getItem('user_id') as string)
      upvoted = "noUpvoted"
      upvotes = newUpvotes.upvotes
    }
  },
  noUpvoted: {
    button: "👆🏻",
    function: async () => {
      const newUpvotes = await upvote(id_project, localStorage.getItem('user_id') as string)
      upvoted = "upvoted"
      upvotes = newUpvotes.upvotes
    }
  }
}


$: {
  const upvotedPromise = isUpvoted(
    id_project,
    localStorage.getItem('user_id') as string
  ).then(res => {
    upvoted = res.isUpvoted ? "upvoted" : "noUpvoted"
  })
}

</script>


<span class="flex items-center [&>*]:text-2xl">
  <p>{upvotes}</p>
  <button on:click={states[upvoted]?.function}>
    {states[upvoted]?.button}
  </button>
</span>