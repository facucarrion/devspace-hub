<script lang="ts">
  import { createProject } from '@lib/projects/createProject'

  const handleSubmit = async (event: SubmitEvent) => {
    event.preventDefault()

    const form = event.target as HTMLFormElement

    const title = form.querySelector('input[name=title]') as HTMLInputElement
    const description = form.querySelector('textarea[name=description]') as HTMLTextAreaElement

    const formData = {
      title: title.value,
      description: description.value,
      id_user_creator: parseInt(localStorage.getItem('user_id') ?? '0')
    }

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
  />
  <textarea name="description" placeholder="Description" class="resize-none w-full bg-transparent text-lg px-1 border-b-2 border-white focus:outline-none" rows="5" maxlength="200"></textarea>

  <button type="submit" class="w-full py-2 bg-green-600 hover:opacity-80 transition-opacity">
    Create Project
  </button>
</form>