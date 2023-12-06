<script lang="ts">
  import ProjectCard from '@comp/ProjectCard.svelte'
  import { getRandomProjects } from '@lib/projects/getRandomProjects'

  const projectsPromise = getRandomProjects(5, 
    localStorage.getItem('user_id') as string ?? 0
  ).then(res => res)
</script>

<section class="flex flex-col w-full justify-between items-center h-48 gap-4">
  {#await projectsPromise then projects}
  {#each projects as project}
    <ProjectCard {project} />
  {/each}
  {/await}
</section>
