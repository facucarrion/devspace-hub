<script lang="ts">
  import ProjectCard from '@comp/ProjectCard.svelte'
  import { getProjectsByCollaborator } from '@lib/projects/getProject'

  export let user_id: string

  const projectsPromise = getProjectsByCollaborator(
    user_id
  ).then(res => res)
</script>

<h2 class="text-2xl my-4 font-bold">COLLABORATING PROJECTS</h2>

<section class="flex flex-col w-full justify-between items-center h-48 gap-4">  
  {#await projectsPromise then projects}
  {#if projects.length == 0}
    <h1>No hay proyectos</h1>
  {/if}
  {#each projects as project}
    <ProjectCard {project} />
  {/each}
  {/await}
</section>
