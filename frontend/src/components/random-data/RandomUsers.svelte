<script lang="ts">
  import { getRandomUsers } from '@lib/users/getRandomUsers'
  import FollowButton from '@comp/ui/FollowButton.svelte'

  const usersPromise = getRandomUsers(
    5,
    localStorage.getItem('user_id') as string
  ).then(res => res)
</script>

<section class="flex w-full justify-between items-center h-48 mb-6">
  {#await usersPromise then users}
    {#each users as user}
      <div
        class="h-full relative min-w-[150px] rounded-md flex flex-col items-center justify-between p-2 backdrop-blur-md bg-[#14141466]"
      >
        <picture class="h-20 w-20 rounded-full flex justify-center overflow-hidden">
          <img
            src={user.avatar || 'http://localhost:8080/img/placeholders/avatar.jpg'}
            alt={user.username}
            class="h-full"
          />
        </picture>

        <a href={`/users/${user.username}`}>
          <h3 class="text-lg text-white font-bold text-opacity-70">
            {user.username}
          </h3>
        </a>
        <FollowButton id_user={user.id_user} variant="full" />
      </div>
    {/each}
  {/await}
</section>
