<script lang="ts">
  import type { Project } from '../types/Project'

  export let project: Project
</script>

<div
  class="w-full flex items-center backdrop-blur-md bg-[#14141466] px-4 py-2 gap-4"
>
  <picture
    class="h-20 w-20 rounded-full border-2 border-white flex justify-center overflow-hidden"
  >
    <img
      src={project.logo || 'http://localhost:8080/img/placeholders/avatar.jpg'}
      alt={project.title}
      class="h-full"
    />
  </picture>

  <div class="flex flex-grow flex-col">
    <h2 class="text-2xl font-bold">{project.title}</h2>
    <span class="flex items-center gap-2">
      <picture
        class="h-10 w-10 aspect-square rounded-full flex justify-center overflow-hidden"
      >
        <img
          src={project.creator_avatar ||
            'http://localhost:8080/img/placeholders/avatar.jpg'}
          alt={project.creator_username}
          class="h-full"
        />
      </picture>
      <a href={`/users/${project.creator_username}`}
        >{project.creator_username}</a
      >
    </span>
  </div>
  <div>
    <a
      href={`http://localhost:3000/projects/${project.id_project}`}
      class="px-5 font-bold bg-white text-black rounded-full flex justify-center items-center"
    >
      Visit
    </a>
  </div>
</div>
