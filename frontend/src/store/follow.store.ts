import { writable } from 'svelte/store';

interface FollowCount {
  followers: number;
  followings: number;
}

export const follows = writable<FollowCount>({ followers: 0, followings: 0 });

export const updateFollowCounts = (newCounts: FollowCount) => {
  follows.set(newCounts);
};