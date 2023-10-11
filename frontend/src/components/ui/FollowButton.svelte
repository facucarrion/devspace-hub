<script>
  export let variant = 'md'

  const SIZES = {
    sm: 'px-2 py-1 text-xs',
    md: 'px-4 py-2 text-sm',
    lg: 'px-6 py-3 text-base',
    full: 'w-full py-1 text-base'
  }

  let following = false

  const follow = () => (following = true)
  const unfollow = () => (following = false)

  const handleClick = (event) => {
    event.preventDefault()
    following ? unfollow() : follow()
  }
</script>

<button class={`${SIZES[variant]} bg-white text-black font-bold rounded-full relative z-20 hover:bg-black hover:text-white`}
  on:click={handleClick}
>
  {#if following}
    Unfollow
  {:else}
    Follow
  {/if}
</button>