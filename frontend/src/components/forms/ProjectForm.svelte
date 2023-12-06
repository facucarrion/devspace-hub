<script lang="ts">
  import { createProject } from '@lib/projects/createProject'

  const handleSubmit = async (event: SubmitEvent) => {
    event.preventDefault()

    const form = event.target as HTMLFormElement

    const formData = new FormData(form)

    const response = await createProject(formData)

    if (!response.status) {
      location.href = `http://localhost:3000/projects/${response.id_project}`
    }
  }
</script>

<form on:submit={handleSubmit} class="flex flex-col items-center rounded-md p-4 w-full gap-8 backdrop-blur-md bg-[#14141466]">
  <h2
		class="text-2xl text-white w-full text-left"
	>
		Publish a Project
	</h2>

  <input
    type="text"
    name="title"
    placeholder="Title"
    class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
    required
  />
  <input
    type="text"
    name="url"
    placeholder="Url"
    class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
    required
  />
  <span class="flex w-100 justify-between items-center gap-5">
    Logo: <input
      type="file"
      name="logo"
      class="flex-grow"  
      accept="image/*"
      required
    >
  </span>
  
  <span class="flex w-100 justify-between items-center gap-5">
    Image: <input
      type="file"
      name="image"
      class="flex-grow"  
      accept="image/*"
      required
    >
  </span>
  <textarea name="description" placeholder="Description" class="resize-none w-full bg-transparent text-lg px-1 border-b-2 border-white focus:outline-none" rows="5" maxlength="200"></textarea>

  <button type="submit" class="w-full py-2 bg-green-600 hover:opacity-80 transition-opacity">
    Create Project
  </button>
</form>