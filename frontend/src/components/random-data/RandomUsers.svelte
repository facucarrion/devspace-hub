<script lang="ts">
  import { getRandomUsers } from '@lib/users/getRandomUsers'
  import FollowButton from '@comp/ui/FollowButton.svelte'

  const usersPromise = getRandomUsers(5, localStorage.getItem('user_id') as string).then(res => res)
</script>

<section class="flex w-full justify-between items-center h-48">
  {#await usersPromise then users}
    {#each users as user}
      <a
        href={`/users/${user.username}`}
        class="h-full relative min-w-[150px] rounded-md flex flex-col items-center justify-between p-2 backdrop-blur-md bg-[#14141466]"
      >
        <img
          src={user.avatar || 'http://localhost:8080/img/placeholders/avatar.jpg'}
          alt={user.username}
          class="h-20 rounded-full"
        />
        <h3 class="text-lg text-white font-bold text-opacity-70">{user.username}</h3>
        <FollowButton variant="full" />
      </a>
    {/each}
  {/await}
</section>
