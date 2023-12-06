<script lang="ts">
  import { getUser } from '@lib/users/getUser'

  let logged = true

  if (!localStorage.getItem('user_id')) {
    logged = false
  }

  const userPromise = getUser(localStorage.getItem('user_id') ?? '').then(
    res => {
      return res
    }
  )
</script>

{#if logged}
  {#await userPromise then user}
    <a href={`/users/${user.username}`}>
      <picture
        id="avatarButton"
        data-dropdown-toggle="userDropdown"
        data-dropdown-placement="bottom-start"
        class="w-10 h-10 rounded-full cursor-pointer flex items-center justify-center overflow-hidden"
      >
        <img
          class="h-full"
          alt={user.username}
          src={user.avatar ??
            'http://localhost:8080/img/placeholders/avatar.jpg'}
        />
      </picture>
    </a>
  {/await}
{/if}
