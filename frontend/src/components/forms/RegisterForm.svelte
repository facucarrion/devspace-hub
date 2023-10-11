<script lang="ts">
	import { register } from "@lib/auth/register";

	const handleSubmit = async (event: SubmitEvent) => {
		const form = event.target as HTMLFormElement;
		
		event.preventDefault();

		const formData = new FormData(form)

		const response = await register(formData);

		if(response.registerData.status === 200) {
    	location.href = 'http://localhost:3000/'
  	} else {
    	location.href = 'http://localhost:3000/auth'
  	}

		console.log(response)
	}
</script>

<form id="register-form" class="flex flex-col items-center rounded-md p-4 w-full gap-8 backdrop-blur-md bg-[#14141466]" on:submit={handleSubmit}>
	<h2
		class="text-2xl text-white w-full text-left"
	>
		Register in DevSpace HUB
	</h2>

  <input
		type="text"
		name="username" 
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Username"
		required
	/>
	<input
		type="email"
		name="email" 
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Email"
		required
	/>
	<input
		type="file"
		accept="image/*"
		name="avatar"
		class="w-full"
	/>
  <input
		type="text"
		name="display_name" 
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Display Name"
	/>
	<input
		type="password"
		name="password"
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Password"
		required
	/>
  <input
		type="password"
		name="repeat_password"
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Repeat Password"
		required
	/>

	<button type="submit" class="p-1 bg-orange-500 flex self-end">
		Ingresar
	</button>
</form>