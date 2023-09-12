<script lang="ts">
interface FollowCount {
  followers: number
  followings: number
}

export let counts: FollowCount
</script>

<div class="flex items-center gap-4">
  <span class="flex flex-col items-center justify-between h-full">
    <strong class="text-2xl">{counts.followers}</strong>
    <p>Followers</p>
  </span>
  <span class="flex flex-col items-center justify-between h-full">
    <strong class="text-2xl">{counts.followings}</strong>
    <p>Followings</p>
  </span>
</div>