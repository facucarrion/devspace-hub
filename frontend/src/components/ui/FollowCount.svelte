<script lang="ts">
import { follows } from "../../store/follow.store";

interface FollowCount {
  followers: number
  followings: number
}

export let counts: FollowCount

$: {
  follows.set(counts)
}
</script>

<div class="flex items-center gap-4">
  <span class="flex flex-col items-center justify-between h-full">
    <strong class="text-2xl">{$follows.followers}</strong>
    <p>Followers</p>
  </span>
  <span class="flex flex-col items-center justify-between h-full">
    <strong class="text-2xl">{$follows.followings}</strong>
    <p>Followings</p>
  </span>
</div>