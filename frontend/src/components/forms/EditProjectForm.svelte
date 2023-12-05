<script lang="ts">
  import type { Project } from '../../types/Project'
  import { editProject } from '@lib/projects/edit'
  import { editImage } from '@lib/projects/editImage'
  import { editLogo } from '@lib/projects/editLogo'

  export let project: Project

  const handleEditSubmit = async (event: SubmitEvent) => {
    const form = event.target as HTMLFormElement
    
    const formData = {
      title: form.p_title.value,
      description: form.p_description.value,
      url: form.p_url.value
    }

    const response = await editProject(project.id_project, formData)

    if (!response.status) {
      location.href = `http://localhost:3000/projects/${project.id_project}`
    }
  }

  const handleLogoSubmit = async (event: SubmitEvent) => {
    const form = event.target as HTMLFormElement

    event.preventDefault()

    const formData = new FormData(form)

    const file = formData.get('logo') as File

    if(file.size === 0) {
      if(confirm("¿Estás seguro de que quieres eliminar el logo de tu proyecto?")) {
        formData.append("logo", 'null')
      } else {
        return
      }
    }

    const response = await editLogo(project.id_project, formData)

    if (!response.status) {
      location.href = `http://localhost:3000/projects/${project.id_project}`
    }
  }

  const handleImageSubmit = async (event: SubmitEvent) => {
    const form = event.target as HTMLFormElement

    event.preventDefault()

    const formData = new FormData(form)

    const file = formData.get('image') as File

    if(file.size === 0) {
      if(confirm("¿Estás seguro de que quieres eliminar la imágen de tu proyecto?")) {
        formData.append("image", 'null')
      } else {
        return
      }
    }

    const response = await editImage(project.id_project, formData)

    if (!response.status) {
      location.href = `http://localhost:3000/projects/${project.id_project}`
    }
  }
</script>

<form
  class="flex flex-col items-center rounded-md p-4 w-full gap-8 backdrop-blur-md bg-[#14141466]"
  on:submit|preventDefault={handleEditSubmit}
>
  <h2 class="text-2xl text-white w-full text-left">Edit Project</h2>

  <input
    type="text"
    name="p_title"
    class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
    placeholder="title"
    value={project.title}
    required
  />

  <input
    type="text"
    name="p_url"
    class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
    placeholder="url"
    value={project.url}
    required
  />

  <textarea name="p_description" placeholder="Description" class="resize-none w-full bg-transparent text-lg px-1 border-b-2 border-white focus:outline-none" rows="5" maxlength="200">{project.description}</textarea>

  <button type="submit" class="px-3 py-1 bg-orange-500 flex self-end font-bold">
    Ingresar
  </button>
</form>

<form
  class="flex flex-col items-center rounded-md p-4 w-full gap-8 backdrop-blur-md bg-[#14141466]"
  on:submit={handleLogoSubmit}
>
  <h2 class="text-2xl text-white w-full text-left">Cambiar Logo</h2>

  <input type="file" accept="image/*" name="logo" class="w-full" />

  <button type="submit" class="px-3 py-1 bg-orange-500 flex self-end font-bold">
    Subir Logo
  </button>
</form>

<form
  class="flex flex-col items-center rounded-md p-4 w-full gap-8 backdrop-blur-md bg-[#14141466]"
  on:submit={handleImageSubmit}
>
  <h2 class="text-2xl text-white w-full text-left">Cambiar Imágen</h2>

  <input type="file" accept="image/*" name="image" class="w-full" />

  <button type="submit" class="px-3 py-1 bg-orange-500 flex self-end font-bold">
    Subir Imágen
  </button>
</form>
