<script lang="ts">
  import { getProject } from "@lib/projects/getProject";
  import type { Project } from "../../types/Project";
  import { onMount } from "svelte";
  import { edit } from "@lib/projects/edit";
  import { editImage } from "@lib/projects/editImage";
  import { editLogo } from "@lib/projects/editLogo";

  export let project: Project;

  const handleEditSubmit = async (event: SubmitEvent) => {
    const form = event.target as HTMLFormElement;

    event.preventDefault();

    const formData = {
      title: form.p_title.value,
      description: form.p_description.value,
      url: form.p_url.value,
    };
    
    console.log(formData)

    const response = await edit(project.id_project, formData);

    if (!response.status) {
      location.href = `http://localhost:3000/projects/${formData.title}`;
    }
  };

  const handleLogoSubmit = async (event: SubmitEvent) => {
    const form = event.target as HTMLFormElement;

    event.preventDefault();

    const formData = new FormData(form);

    const file = formData.get("logo") as File;

    const response = await editLogo(project.id_project, formData);

    if (!response.status) {
      location.href = `http://localhost:3000/projects/editLogo/${project.title}`;
    }
  };

  const handleImageSubmit = async (event: SubmitEvent) => {
    const form = event.target as HTMLFormElement;

    event.preventDefault();

    const formData = new FormData(form);

    const file = formData.get("image") as File;

    const response = await editImage(project.id_project, formData);

    if (!response.status) {
      location.href = `http://localhost:3000/projects/editImage/${project.title}`;
    }
  };
</script>

<form id="edit-project-form" on:submit={handleEditSubmit}>
  <h2 class="text-2xl text-white w-full text-left">Edit Profile</h2>

  <input
    type="text"
    name="p_title"
    class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
    placeholder="title"
    value={project?.title}
    required
  />
  <input
    type="text"
    name="p_url"
    class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
    placeholder="url"
    value={project?.url}
    required
  />
  <input
    type="text"
    name="p_description"
    class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
    placeholder="Description"
    value={project?.description}
  />

  <button type="submit" class="p-1 bg-orange-500 flex self-end">
    subir cambios
  </button>
</form>

<form id="edit-logo-form" on:submit={handleLogoSubmit}>
  <input
    type="file"
    name="p_logo"
    class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
    placeholder="Logo"
    required
  />

  <button type="submit" class="p-1 bg-orange-500 flex self-end">
    subir logo
  </button>
</form>
<form id="edit-image-form" on:submit={handleImageSubmit}>
  <input
    type="file"
    name="p_image"
    class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
    placeholder="Image"
    required
  />

  <button type="submit" class="p-1 bg-orange-500 flex self-end">
    subir imagen
  </button>
</form>
