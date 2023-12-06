<script lang="ts">
  import { deleteUserLink } from "@lib/userLinks/deleteUserLink"
  import { newUserLink } from "@lib/userLinks/newUserLink";

  export let links: any[]
  export let id_user: string

  const handleSubmit = async (event: SubmitEvent) => {
    const form = event.target as HTMLFormElement

    event.preventDefault()

    const response = await newUserLink(
      form.link.value,
      id_user
    )

    if(!response.status) {
      location.reload()
    }
  }

  const handleDelete = async (id_link: string, event: MouseEvent) => {
    event.preventDefault()

    const response = await deleteUserLink(id_link)

    if(!response.status) {
      location.reload()
    }
  }
</script>

<form
  on:submit={handleSubmit}
  class="flex justify-between items-center gap-4"
>
  <input
    name="link"
    type="url"
    required
    class="text-lg bg-transparent border-b-2 flex flex-grow focus:outline-none"
    placeholder="Add a link"
  >
  <button type="submit" class="bg-green-500 text-white rounded-full px-2 py-1">Add</button>
</form>

<ul class="flex flex-col flex-grow gap-2">
  {#each links as link}
    <li class="w-full flex gap-2">
      <p class="text-xl flex flex-grow">{link.link}</p>
      <a class="bg-white rounded-full px-2 py-1" href={link.link}>🔗</a>
      <button class="bg-red-500 text-white rounded-full px-2 py-1" type="button" on:click={(event) => handleDelete(link.id_user_link, event)}>Delete</button>
    </li>
  {/each}
</ul>