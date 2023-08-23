<script lang="ts">
	import { register } from "../lib/auth/register";

	const handleSubmit = (event: SubmitEvent) => {
		const form = document.getElementById("register-form");
		
		event.preventDefault();

		const username = form?.querySelector('input[name="username"]') as HTMLInputElement;
		const email = form?.querySelector('input[name="email"]') as HTMLInputElement;
		const display_name = form?.querySelector('input[name="display_name"]') as HTMLInputElement;
		const password = form?.querySelector('input[name="password"]') as HTMLInputElement;
		const repeat_password = form?.querySelector('input[name="repeat_password"]') as HTMLInputElement;

		const formData = {
			username: username.value,
			email: email.value,
			display_name: display_name.value,
			password: password.value,
			repeat_password: repeat_password.value
		}

		const response = register(formData);

		console.log(response.then(res => console.log(res)))
	}
</script>

<form id="register-form" class="flex flex-col items-center border-2 border-black rounded-md p-4 w-1/5 gap-8" on:submit={handleSubmit}>
	<h2
		class="text-2xl text-white w-full text-left"
	>
		Register in DevSpace HUB
	</h2>

  <input
		type="text"
		name="username" 
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="UserName"
	/>
	<input
		type="email"
		name="email" 
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Email"
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
	/>
  <input
		type="password"
		name="repeat_password"
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Repeat Password"
	/>

	<button type="submit" class="p-1 bg-orange-500 flex self-end">
		Ingresar
	</button>
</form>