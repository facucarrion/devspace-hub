<script>
export let display_name
export let username
</script>

<div class="flex flex-col flex-grow">
{#if display_name != null}
    <div class="text-2xl font-bold">{display_name}</div>
    <div class="text-gray-500">@{username}</div>
{:else}
    <div class="text-2xl font-bold">{username}</div>
{/if}
</div>