<script lang="ts">
  export let links: any[]
  export let id_user
</script>

<section class="">
  <form
    on:submit={() => console.log('aia')}
    class="flex justify-between items-center gap-4"
  >
    <input
      type="text"
      required
      class="text-lg bg-transparent border-b-2 flex flex-grow focus:outline-none"
    >
    <button type="submit">Add</button>
  </form>

  <ul>
    {#each links as link}
      <li>
        <a href={link.link} target="_blank">{link.link}</a>
        <button type="button">Edit</button>
        <button type="button">Delete</button>
      </li>
    {/each}
  </ul>
</section>