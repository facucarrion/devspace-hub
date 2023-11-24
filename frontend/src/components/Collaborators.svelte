<script lang="ts">
  import { searchUsers } from '@lib/users/searchUsers'
  import type { User } from '../types/User'
  import CollaboratorButton from './ui/CollaboratorButton.svelte'
  import type { Project } from '../types/Project'

  export let collaborators: User[]
  export let project: Project

  let searchValue: string
  let users: User[] = []

  $: {
    searchUsers(searchValue).then((res) => {
      users = res.filter(
        (user: User) =>
          !collaborators.find(
            (collaborator) => collaborator.id_user === user.id_user
          ) && user.id_user !== project.creator_id
      )
    })
  }


</script>

<section class="w-1/2 h-full p-2 flex flex-col gap-2">
  <input
    type="text"
    bind:value={searchValue}
    class="bg-transparent w-full border-b-2 text-xl focus:outline-none"
    placeholder="Buscar usuarios"
  />

  {#each users as user}
  <div
    class="relative min-w-[150px] rounded-md flex items-center justify-between p-2 backdrop-blur-md bg-[#14141466]"
  >
    <picture
      class="h-20 w-20 rounded-full flex justify-center overflow-hidden"
    >
      <img
        src={user.avatar ||
          'http://localhost:8080/img/placeholders/avatar.jpg'}
        alt={user.username}
        class="h-full"
      />
    </picture>

    <a href={`/users/${user.username}`}>
      <h3 class="text-lg text-white font-bold text-opacity-70">
        {user.username}
      </h3>
    </a>

    <CollaboratorButton id_user={user.id_user} id_project={project.id_project} />
  </div>
{/each}
</section>
<section class="w-1/2 h-full p-2 flex flex-col gap-2">
  {#each collaborators as user}
    <div
      class="relative min-w-[150px] rounded-md flex items-center justify-between p-2 backdrop-blur-md bg-[#14141466]"
    >
      <picture
        class="h-20 w-20 rounded-full flex justify-center overflow-hidden"
      >
        <img
          src={user.avatar ||
            'http://localhost:8080/img/placeholders/avatar.jpg'}
          alt={user.username}
          class="h-full"
        />
      </picture>

      <a href={`/users/${user.username}`}>
        <h3 class="text-lg text-white font-bold text-opacity-70">
          {user.username}
        </h3>
      </a>

      <CollaboratorButton id_user={user.id_user} id_project={project.id_project} />
    </div>
  {/each}
</section>
