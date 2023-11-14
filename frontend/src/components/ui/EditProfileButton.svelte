<script lang="ts">
export let userInPageId: string = "0"
const ownUserId = window.localStorage.getItem('user_id') ?? 0

let isOwn = userInPageId === ownUserId
</script>

{#if isOwn}
<a id="button" class="" href="/profile">
  Edit Profile
</a>
{/if}