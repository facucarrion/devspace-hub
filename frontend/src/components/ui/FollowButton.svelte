<script lang="ts">
  import { follow } from '@lib/follows/follow'
  import { isFollowing } from '@lib/follows/isFollowing'
  import { follows, updateFollowCounts } from '../../store/follow.store'

  export let variant: 'sm' | 'md' | 'lg' | 'full' = 'md'
  export let id_user: string

  const SIZES = {
    sm: 'px-2 py-1 text-xs',
    md: 'px-4 py-2 text-sm',
    lg: 'px-6 py-3 text-base',
    full: 'w-full py-1 text-base'
  }

  const states = {
    following: {
      text: 'Unfollow',
      color: 'bg-red-500',
      function: async (event: MouseEvent) => {
        if (!localStorage.getItem('user_id')) {
          event.preventDefault()

          if (confirm('Quieres loggearte para hacer esto?')) {
            location.href = 'http://localhost:3000/auth'
          }

          return
        }        

        const newFollowers = await follow(
          id_user,
          localStorage.getItem('user_id') as string
        )
        updateFollowCounts({
          followers: newFollowers.followers,
          followings: $follows.followings
        })
        following = 'notFollowing'
      }
    },
    notFollowing: {
      text: 'Follow',
      color: 'bg-blue-500',
      function: async (event: MouseEvent) => {
        if (!localStorage.getItem('user_id')) {
          event.preventDefault()

          if (confirm('Quieres loggearte para hacer esto?')) {
            location.href = 'http://localhost:3000/auth'
          }

          return
        }

        const newFollowers = await follow(
          id_user,
          localStorage.getItem('user_id') as string
        )
        updateFollowCounts({
          followers: newFollowers.followers,
          followings: $follows.followings
        })
        following = 'following'
      }
    }
  }

  let following: 'following' | 'notFollowing' = 'notFollowing'

  $: {
    isFollowing(id_user, localStorage.getItem('user_id') as string).then(
      res => {
        following = res.isFollow ? 'following' : 'notFollowing'
      }
    )
  }

  const isMe = localStorage.getItem('user_id') == id_user
</script>

{#if !isMe}
  <button
    class={`${SIZES[variant]} z-2 bg-white text-black font-bold rounded-full relative z-20 hover:bg-black hover:text-white`}
    on:click={states[following]?.function}
  >
    {states[following]?.text}
  </button>
{/if}
