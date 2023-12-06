<script lang="ts">
  import { getUser } from "@lib/users/getUser"
  import type { User } from "../../types/User"
  import { onMount } from "svelte"
  import { editUser } from "@lib/users/editUser"
  import { editAvatar } from "@lib/users/editAvatar"
  import { editPassword } from "@lib/users/editPassword"
  import { logOut } from "@lib/auth/logOut"

  let user: User

  onMount(() => {
    getUser(
      localStorage.getItem("user_id") as string
    ).then(res => {
      user = res
    })
  })

	const handleEditSubmit = async (event: SubmitEvent) => {
		const form = event.target as HTMLFormElement
		
		event.preventDefault()

		const formData = {
      username: form.username.value,
      email: form.email.value,
      display_name: form.display_name.value,
    }

    const response = await editUser(user.id_user, formData)

		if(!response.status) {
    	location.href = `http://localhost:3000/users/${formData.username}`
  	}
	}

  const handleAvatarSubmit = async (event: SubmitEvent) => {
    const form = event.target as HTMLFormElement;

    event.preventDefault();

    const formData = new FormData(form)

    const file = formData.get('avatar') as File

    if(file.size === 0) {
      if(confirm("¿Estás seguro de que quieres eliminar tu avatar?")) {
        formData.append("avatar", 'null')
      } else {
        return
      }
    }

    const response = await editAvatar(user.id_user, formData)

    if(!response.status) {
      location.href = `http://localhost:3000/users/${user.username}`
    }
  }

  const handlePasswordSubmit = async (event: SubmitEvent) => {
    const form = event.target as HTMLFormElement;

    event.preventDefault();

    const formData = {
      last_password: form.last_password.value,
      new_password: form.new_password.value,
      repeat_new_password: form.repeat_new_password.value,
    }

    const response = await editPassword(user.id_user, formData)

    if(!response.status) {
      logOut()
    }
  }
</script>

<form
  id="register-form" class="flex flex-col items-center rounded-md p-4 w-full gap-8 backdrop-blur-md bg-[#14141466]"
  on:submit={handleEditSubmit}
>
	<h2
		class="text-2xl text-white w-full text-left"
	>
    Edit Profile
	</h2>

  <input
		type="text"
		name="username" 
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Username"
    value={user?.username}
		required
	/>

	<input
		type="email"
		name="email" 
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Email"
    value={user?.email}
		required
	/>
  
  <input
		type="text"
		name="display_name" 
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Display Name"
    value={user?.display_name}
	/>

	<button type="submit" class="p-1 bg-orange-500 flex self-end">
		Ingresar
	</button>
</form>

<form
  class="flex flex-col items-center rounded-md p-4 w-full gap-8 backdrop-blur-md bg-[#14141466]"
  on:submit={handleAvatarSubmit}
>
	<h2
		class="text-2xl text-white w-full text-left"
	>
		Cambiar Avatar
	</h2>

	<input
    type="file"
    accept="image/*"
    name="avatar"
    class="w-full"
  />

	<button type="submit" class="p-1 bg-orange-500 flex self-end">
		Cambiar
	</button>
</form>

<form
  class="flex flex-col items-center rounded-md p-4 w-full gap-8 backdrop-blur-md bg-[#14141466]"
  on:submit={handlePasswordSubmit}
>
	<h2
		class="text-2xl text-white w-full text-left"
	>
		Cambiar Contraseña
	</h2>

  <input
		type="password"
		name="last_password"
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Last Password"
		required
	/>
  <input
		type="password"
		name="new_password"
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="New Password"
		required
	/>
  <input
		type="password"
		name="repeat_new_password"
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Repeat New Password"
		required
	/>

	<button type="submit" class="p-1 bg-orange-500 flex self-end">
		Cambiar
	</button>
</form>