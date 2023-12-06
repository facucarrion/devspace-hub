<script lang="ts">
  import { getRandomUsers } from '@lib/users/getRandomUsers'

  const usersPromise = getRandomUsers(
    5,
    localStorage.getItem('user_id') as string ?? "0"
  ).then(res => res)
</script>

<section class="flex w-full justify-between items-center h-44 mb-6">
  {#await usersPromise then users}
    {#each users as user}
      <a
        href={`/users/${user.username}`}
        class="h-full relative w-[150px] rounded-md flex flex-col items-center justify-between p-2 backdrop-blur-md bg-[#14141466]"
      >
        <div class="flex flex-col items-center justify-around w-full h-full">
          <picture
            class="h-20 w-20 rounded-full flex justify-center overflow-hidden"
          >
            <img
              src={user.avatar || 'http://localhost:8080/img/placeholders/avatar.jpg'}
              alt={user.username}
              class="h-full"
            />
          </picture>

          <h3 class="text-lg text-white font-bold text-opacity-70 text-center">
            {user.username}
          </h3>
        </div>
      </a>
    {/each}
  {/await}
</section>
